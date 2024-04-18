<?php 
session_start();
require_once('./../classes.php');
 
if (ComprobarSession($_SESSION['user'],$_SESSION['pass']))
{

if(isset($_REQUEST['action'])) 
{ switch($_REQUEST['action']) { 
		case 'actualizar': 
			$alm->__SET('Codigo_Mundo',              $_SESSION['CodMundo']);
			$alm->__SET('Codigo',              $_REQUEST['Codigo']);
            $alm->__SET('Nombre',          $_REQUEST['Nombre']);
			$alm->__SET('Codigo_SubClase',          $_REQUEST['Codigo_SubClase']);
			$alm->__SET('Codigo_Nivel',          $_REQUEST['Codigo_Nivel']);
 
            $model->Actualizar($alm, $_REQUEST['Codigo_viejo']);
            header('Location: habilidades.controller.php');
            break;
 
        case 'registrar':
			$alm->__SET('Codigo_Mundo',          $_SESSION['CodMundo']);
			$alm->__SET('Codigo',          $_REQUEST['Codigo']);
            $alm->__SET('Nombre',          $_REQUEST['Nombre']);
			$alm->__SET('Codigo_SubClase',          $_REQUEST['Codigo_SubClase']);
			$alm->__SET('Codigo_Nivel',          $_REQUEST['Codigo_Nivel']);
 
            $model->Registrar($alm);
            header('Location: habilidades.controller.php');
            break;
 
        case 'eliminar':
            $model->Eliminar($_REQUEST['Codigo'],$_SESSION['CodMundo']);
            header('Location: habilidades.controller.php');
            break;
        case 'editar':
            $alm = $model->Obtener($_REQUEST['Codigo'],$_SESSION['CodMundo']);
			$alm->__SET('Estado','actualizar');
            break;
    }
}
 
?>
 
 
<div class="pure-g">
 
<div class="pure-u-1-12">
    <h3>Habilidades       </h3>     
	 </br>
 </br>
                  <a href="./../lista.php">Volver</a>
				  </br>
				  </br>
				  	<a href="habilidades.controller.php">Nuevo</a>
					</br>
 
<form action="?action=<?php echo $alm->Estado =='actualizar' ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" />
					<input type="hidden" name="Codigo_Mundo" value="<?php echo $alm->__GET('Codigo_Mundo'); ?>" />
                     
 
<table style="width:500px;">
 
 
 <tr>
 
	 <?php
	 if ($alm->Estado=='actualizar')
	 {
	 ?>
	 <th style="display:none;">Viejo Codigo</th>
	<td><input type="hidden" name="Codigo_viejo" value="<?php echo $alm->__GET('Codigo'); ?>" style="width:100%;" /></td>
	 
</tr>
 
<?php
 
}
 ?>
 

 <!--
 <tr>
	<th style="text-align:left;">Codigo Mundo</th>
	<td>
		<select type="text" name="Codigo_Mundo" value="<?php echo $alm->__GET('Codigo_Mundo'); ?>" style="width:100%;" />
			<?php
				foreach($model_mundo->Listar() as $r): 
				?>	<option 
				<?php 
						if ($alm->__GET('Codigo_Mundo')==$r->Codigo)
						{
							echo ' selected';
						}
					?>				
				value="<?php echo $r->Codigo; ?>"><?php echo $r->Nombre; ?></option> <?php
				endforeach; 
			?>
			
		</select>

	</td>
 
</tr>
 -->
 
<tr>
 
 <tr>
<th style="text-align:left;">Codigo</th>
 
 
<td><input type="text" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" style="width:100%;" /></td>
 
                        </tr>
 
 
<tr>
 
<th style="text-align:left;">Nombre</th>
 
 
<td><input type="text" name="Nombre" value="<?php echo $alm->__GET('Nombre'); ?>" style="width:100%;" /></td>
 
</tr>
 <tr>
   
	<th style="text-align:left;">Codigo Nivel</th>
	<td>
		<div class="DivNivel">
		<select type="text" name="Codigo_Nivel" value="<?php echo $alm->__GET('Codigo_Nivel'); ?>" style="width:100%;" />
			<?php
					foreach($model_nivel->ListarNivelMundo($_SESSION['CodMundo']) as $r): 
				?>	<option
					<?php 
						if ($alm->__GET('Codigo_Nivel')==$r->Codigo)
						{
							echo ' selected';
						}
					?>
				value="<?php echo $r->Codigo; ?>"><?php echo $r->Codigo; ?></option> <?php
				endforeach; 
				?>
		</select>
		<script type="text/javascript">
				$(document).ready(function() {
				$("#DivMundo").prop('disabled', true);
				$("#DivNivel").prop('disabled', true);
				 $('.DivMundo select').change(function() {
				 $('.DivNivel select').empty();
				 $.getJSON('/Get/getNivel.php?codigo_mundo='+$('.DivMundo select').val(),function(data){
					 $.each(data, function(i,item){
				 $('.DivNivel select').append('<option value="'+item.Codigo+'">'+item.Codigo+'</option>');
					 });
				 });
					});
				$("#DivMundo").prop('disabled', false);
				$("#DivNivel").prop('disabled', false);
				});
			</script>
			</div>
	</td>
 </tr>
     <tr>
	<th style="text-align:left;">Codigo SubClase</th>
	<td>
		<div class="DivSubClase">
		<select type="text" name="Codigo_SubClase" value="<?php echo $alm->__GET('Codigo_SubClase'); ?>" style="width:100%;" />
		<?php
				foreach($model_subclase->ListarSubClaseMundo($_SESSION['CodMundo']) as $r): 
				?>	<option
					<?php 
						if ($alm->__GET('Codigo_SubClase')==$r->Codigo)
						{
							echo ' selected';
						}
					?>
				value="<?php echo $r->Codigo; ?>"><?php echo $r->Nombre; ?></option> <?php
				endforeach; 
			?>
		</select>
		<script type="text/javascript">
				$(document).ready(function() {
				$("#DivMundo").prop('disabled', true);
				$("#DivSubClase").prop('disabled', true);
				 $('.DivMundo select').change(function() {
				 $('.DivSubClase select').empty();
				 $.getJSON('/Get/getSubClase.php?codigo_mundo='+$('.DivMundo select').val(),function(data){
					 $.each(data, function(i,item){
				 $('.DivSubClase select').append('<option value="'+item.Codigo+'">'+item.Nombre+'</option>');
					 });
				 });
					});
				$("#DivMundo").prop('disabled', false);
				$("#DivSubClase").prop('disabled', false);
				});
			</script>
		<div>
	</td>
	
 </tr>
 
<tr>
 
<td colspan="2">
                                <button type="submit" class="pure-button pure-button-primary">Guardar</button>
                            </td>
 
                        </tr>
 
                    </table>
 
                </form>
 
 
 
<table class="pure-table pure-table-horizontal">
 
<thead>
 
<tr>
 <!--<th style="text-align:left;">Codigo Mundo</th>-->
 <th style="text-align:left;">Codigo</th>
 
<th style="text-align:left;">Nombre</th> 
 
 <th style="text-align:left;">Codigo Nivel</th> 
 
 <th style="text-align:left;">Codigo SubClase</th> 
 
<th style="text-align:left;">Imagen</th>
 
 
<th style="text-align:left;">Registro</th>
 
 
<th></th>
 
 
<th></th>
 
                        </tr>
 
                    </thead>
 
                    <?php foreach($model->Listar($_SESSION['CodMundo']) as $r): ?>
 
<tr>
 <!--<td><?php echo $r->__GET('Codigo_Mundo'); ?></td>-->
 
 <td><?php echo $r->__GET('Codigo'); ?></td>
 
<td><?php echo $r->__GET('Nombre'); ?></td>
 
  <td><?php echo $r->__GET('Codigo_Nivel'); ?></td>
 
<td><?php echo $r->__GET('Codigo_SubClase'); ?></td>
 
<td>
                                <a href="?action=editar&Codigo=<?php echo $r->Codigo; ?>&Codigo_Mundo=<?php echo $r->Codigo_Mundo ?>">Editar</a>
                            </td>
 
 
<td>
                                <a href="?action=eliminar&Codigo=<?php echo $r->Codigo; ?>&Codigo_Mundo=<?php echo $r->Codigo_Mundo ?>">Eliminar</a>
                            </td>
 
                        </tr>
 
                    <?php endforeach; ?>
                </table>
 
      

            </div>
 
        </div>

<?php
}
?>