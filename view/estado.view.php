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
 
            $model->Actualizar($alm, $_REQUEST['Codigo_viejo']);
			
			
			foreach($model_est_atri->Listar($_REQUEST['Codigo'],$_SESSION['CodMundo']) as $r): 
				$est_atri=new Estado_Atributo();
				$est_atri->__SET('Codigo_Estado',$_REQUEST['Codigo']);
				$est_atri->__SET('Codigo_Estado_Mundo',$_SESSION['CodMundo']);
				$est_atri->__SET('Codigo_Atributo_Mundo',$_SESSION['CodMundo']);
				$est_atri->__SET('Codigo_Atributo',$r->Codigo);
				$est_atri->__SET('Valor',$_REQUEST['AtrTxtVal'.$r->Codigo]);
				
				$model_est_atri->Actualizar($est_atri);
			endforeach; 
			
            header('Location: estado.controller.php.php');
            break;
 
        case 'registrar':
			$alm->__SET('Codigo_Mundo',          $_SESSION['CodMundo']);
			$alm->__SET('Codigo',          $_REQUEST['Codigo']);
            $alm->__SET('Nombre',          $_REQUEST['Nombre']);
 
            $model->Registrar($alm);
			
			
			foreach($model_est_atri->Listar($_REQUEST['Codigo'],$_SESSION['CodMundo']) as $r): 
				$est_atri=new Estado_Atributo();
				$est_atri->__SET('Codigo_Estado',$_REQUEST['Codigo']);
				$est_atri->__SET('Codigo_Estado_Mundo',$_SESSION['CodMundo']);
				$est_atri->__SET('Codigo_Atributo_Mundo',$_SESSION['CodMundo']);
				$est_atri->__SET('Codigo_Atributo',$r->Codigo);
				$est_atri->__SET('Valor',$_REQUEST['AtrTxtVal'.$r->Codigo]);
				
				$model_est_atri->Registrar($est_atri);
			endforeach; 
			
            header('Location: estado.controller.php.php');
            break;
 
        case 'eliminar':
			$model_est_atri->Eliminar($_REQUEST['Codigo'],$_SESSION['CodMundo']);
            $model->Eliminar($_REQUEST['Codigo'],$_SESSION['CodMundo']);
            header('Location: estado.controller.php.php');
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
    <h3>Estado       </h3>     
	 </br>
 </br>
                  <a href="./../lista.php">Volver</a>
				  </br>
				  </br>
				  	<a href="estado.controller.php.php">Nuevo</a>
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
 
 

 
                    </table>
 
				
				<table border="1">
					<tr>
						<td>Atributos</td>
						<td></td>
					</tr>
					<?php
				foreach($model_est_atri->Listar($_SESSION['CodMundo'],$alm->__GET('Codigo')) as $r): 
				?>	<td>
					<tr>
						<td><?php echo $r->Nombre; ?></td>
						<td><input type="text" name="AtrTxtVal<?php echo $r->Codigo; ?>" value="<?php echo $r->Valor; ?>" style="width:100%;" /></td>
					</tr>
					<?php
				endforeach; 
				?>
				
 
				</table>
		
 <tr>
 
<td colspan="2">
                                <button type="submit" class="pure-button pure-button-primary">Guardar</button>
                            </td>
 
                        </tr>
                </form>
 
 
 
<table class="pure-table pure-table-horizontal">
 
<thead>
 
<tr>
<!-- <th style="text-align:left;">Codigo Mundo</th>-->
 <th style="text-align:left;">Codigo</th>
 
<th style="text-align:left;">Nombre</th> 
 
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