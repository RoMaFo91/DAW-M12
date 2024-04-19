<?php 
if (isset($_SESSION['login_correct'])) {
if (ComprobarSession($_SESSION['user'],$_SESSION['pass']))
{
if(isset($_REQUEST['action'])) 
if ($_REQUEST['model'] == 'subclase') {
{ switch($_REQUEST['action']) { 
		case 'actualizar': 
			$alm->__SET('Codigo_Mundo',              $_SESSION['CodMundo']);
			$alm->__SET('Codigo',              $_REQUEST['Codigo']);
            $alm->__SET('Nombre',          $_REQUEST['Nombre']);
			$alm->__SET('Codigo_Clase',          $_REQUEST['Codigo_Clase']);
			$alm->__SET('Codigo_Clase_Mundo',          $_SESSION['CodMundo']);
 
            $model->Actualizar($alm, $_REQUEST['Codigo_viejo'],$_REQUEST['Codigo_viejo_mundo']);
            header('Location: index.php?model=subclase&type=form');
            break;
 
        case 'registrar':
			$alm->__SET('Codigo_Mundo',          $_SESSION['CodMundo']);
			$alm->__SET('Codigo',          $_REQUEST['Codigo']);
            $alm->__SET('Nombre',          $_REQUEST['Nombre']);
			$alm->__SET('Codigo_Clase',          $_REQUEST['Codigo_Clase']);
			$alm->__SET('Codigo_Clase_Mundo',          $_SESSION['CodMundo']);
 
            $model->Registrar($alm);
            header('Location: index.php?model=subclase&type=form');
            break;
 
        case 'eliminar':
            $model->Eliminar($_REQUEST['Codigo'],$_SESSION['CodMundo']);
            header('Location: index.php?model=subclase&type=form');
            break;
        case 'editar':
            $alm = $model->Obtener($_REQUEST['Codigo'],$_SESSION['CodMundo']);
			$alm->__SET('Estado','actualizar');
            break;
    }
}
}
 
?>
 
 
<div class="pure-g">
 
<div class="pure-u-1-12">
    <h3>SubClase        </h3>     
	 </br>
 </br>
 
<form action="../index.php?model=subclase&type=form&action=<?php echo $alm->Estado =='actualizar' ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" />
					<input type="hidden" name="Codigo_Mundo" value="<?php echo $alm->__GET('Codigo_Mundo'); ?>" />
                     
 

	 <?php
	 if ($alm->Estado=='actualizar')
	 {
	 ?>

<input type="hidden" name="Codigo_viejo" value="<?php echo $alm->__GET('Codigo'); ?>" style="width:100%;" />
<input type="hidden" name="Codigo_viejo_mundo" value="<?php echo $alm->__GET('Codigo_Mundo'); ?>" style="width:100%;" />
	
 
<?php
 
}
 ?>
 Codigo Clase
		<div  class="SubClaseCodigo_Clase">
		<select name="Codigo_Clase">
				<?php
				
				foreach($model_clase->ListarClaseMundo($_SESSION['CodMundo']) as $r): 
				?>	<option
					<?php 
						if ($alm->__GET('Codigo_Clase')==$r->Codigo)
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
				$("#SubClaseCodigo_Mundo").prop('disabled', true);
				$("#SubClaseCodigo_Clase").prop('disabled', true);
				 $('.SubClaseCodigo_Mundo select').change(function() {
				 $('.SubClaseCodigo_Clase select').empty();
				 $.getJSON('/Get/getClase.php?codigo_mundo='+$('.SubClaseCodigo_Mundo select').val(),function(data){
					 $.each(data, function(i,item){
				 $('.SubClaseCodigo_Clase select').append('<option value="'+item.Codigo+'">'+item.Nombre+'</option>');
					 });
				 });
					});
				$("#SubClaseCodigo_Mundo").prop('disabled', false);
				$("#SubClaseCodigo_Clase").prop('disabled', false);
				});
			</script>
		</div>
	Codigo
	<input type="text" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" style="width:100%;" />
Nombre
	<input type="text" name="Nombre" value="<?php echo $alm->__GET('Nombre'); ?>" style="width:100%;" />

                                <br/><br/><button type="submit" class="pure-button pure-button-primary">Guardar</button>
 
                </form>
 
 
 
<table class="pure-table pure-table-horizontal">
 
<thead>
 
<tr>
<!--	<th >Codigo Mundo</th>-->
	<th >Codigo Clase</th>
	<th >Codigo</th>
	<th >Nombre</th> 
	<th >Editar</th>
	<th >Eliminar</th>

</tr>
</thead>
 
                    <?php foreach($model->Listar($_SESSION['CodMundo']) as $r): ?>
 
<tr>
<td><?php echo $r->__GET('obj_Codigo_Clase')->name(); ?></td>
<td><?php echo $r->__GET('Codigo'); ?></td>
<td><?php echo $r->__GET('Nombre'); ?></td>
<td>
                                <a href="?model=subclase&type=form&action=editar&Codigo=<?php echo $r->Codigo; ?>&Codigo_Mundo=<?php echo $r->Codigo_Mundo ?>"><img src="/icon/actualizar.png" alt="Actualizar" style="width:15%"></a>
                            </td>
 
 
<td>
                                <a href="?model=subclase&type=form&action=eliminar&Codigo=<?php echo $r->Codigo; ?>&Codigo_Mundo=<?php echo $r->Codigo_Mundo ?>"><img src="/icon/eliminar.png" alt="Eliminar" style="width:15%"></a>
                            </td>
 
                        </tr>
 
                    <?php endforeach; ?>
                </table>
 
      

            </div>
 
        </div>

<?php
}
}
?>