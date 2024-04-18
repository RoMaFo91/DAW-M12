<?php 
session_start();
require_once('./../classes.php');
 
if (ComprobarSession($_SESSION['user'],$_SESSION['pass']))
{

$alm = new Traduccion(); 
$model = new TraduccionModel();
$model_gen = new GenModel(); 

if(isset($_REQUEST['action'])) 
{ switch($_REQUEST['action']) { 
		case 'actualizar': 		
			$alm->__SET('Tabla',              $_REQUEST['Tabla']);
			$alm->__SET('PrimaryKey',              $_REQUEST['PrimaryKey']);
			$alm->__SET('Campo',              $_REQUEST['Campo']);
			$alm->__SET('Parte',              $_REQUEST['Parte']);
			$alm->__SET('Codigo_Idioma',              $_REQUEST['Codigo_Idioma']);
			$alm->__SET('Texto',              $_REQUEST['Texto']);
			

 
            $model->Actualizar($alm, $_REQUEST['TablaViejo'],$_REQUEST['PrimaryKeyViejo'],$_REQUEST['CampoViejo'],$_REQUEST['ParteViejo'],$_REQUEST['Codigo_IdiomaViejo']);
            header('Location: traduccion.controller.php');
            break;
 
        case 'registrar':
			$alm->__SET('Tabla',              $_REQUEST['Tabla']);
			$alm->__SET('PrimaryKey',              $_REQUEST['PrimaryKey']);
			$alm->__SET('Campo',              $_REQUEST['Campo']);
			$alm->__SET('Parte',              $_REQUEST['Parte']);
			$alm->__SET('Codigo_Idioma',              $_REQUEST['Codigo_Idioma']);
			$alm->__SET('Texto',              $_REQUEST['Texto']);
 
            $model->Registrar($alm);
            header('Location: traduccion.controller.php');
            break;
 
        case 'eliminar':
            $model->Eliminar($_REQUEST['TablaViejo'],$_REQUEST['PrimaryKeyViejo'],$_REQUEST['CampoViejo'],$_REQUEST['ParteViejo'],$_REQUEST['Codigo_IdiomaViejo']);
            header('Location: traduccion.controller.php');
            break;
        case 'editar':
            $alm = $model->Obtener($_REQUEST['TablaViejo'],$_REQUEST['PrimaryKeyViejo'],$_REQUEST['CampoViejo'],$_REQUEST['ParteViejo'],$_REQUEST['Codigo_IdiomaViejo']);
			$alm->__SET('Estado','actualizar');
            break;
    }
}
 
?>
 
<!DOCTYPE html>
<script type="text/javascript" src="/jquery.min.js"></script>
<html lang="es">
    <head>
        <title>Mantenimiento Traduccion</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
    </head>
    <body style="padding:15px;">
 
 
<div class="pure-g">
 
<div class="pure-u-1-12">
    <h3>Traduccion       </h3>     
	 </br>
 </br>
                  <a href="./../lista.php">Volver</a>
				  </br>
				  </br>
				  	<a href="traduccion.controller.php">Nuevo</a>
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
	 <th style="display:none;">TablaViejo</th>
	<td><input type="hidden" name="TablaViejo" value="<?php echo $alm->__GET('Tabla'); ?>" style="width:100%;" /></td>
	
	<th style="display:none;">PrimaryKeyViejo</th>
	<td><input type="hidden" name="PrimaryKeyViejo" value="<?php echo $alm->__GET('PrimaryKey'); ?>" style="width:100%;" /></td>
	
	<th style="display:none;">CampoViejo</th>
	<td><input type="hidden" name="CampoViejo" value="<?php echo $alm->__GET('Campo'); ?>" style="width:100%;" /></td>
	
	<th style="display:none;">ParteViejo</th>
	<td><input type="hidden" name="ParteViejo" value="<?php echo $alm->__GET('Parte'); ?>" style="width:100%;" /></td>
	
	<th style="display:none;">Codigo_IdiomaViejo</th>
	<td><input type="hidden" name="Codigo_IdiomaViejo" value="<?php echo $alm->__GET('Codigo_Idioma'); ?>" style="width:100%;" /></td>
	 
</tr>
 
<?php
 
}

//$_REQUEST['TablaViejo'],$_REQUEST['PrimaryKeyViejo'],$_REQUEST['CampoViejo'],$_REQUEST['ParteViejo'],$_REQUEST['Codigo_IdiomaViejo']

 ?>
 

 
 <tr>
	<th style="text-align:left;">Codigo Tabla</th>
	<td>
		<div class="DivTabla">
		<select type="text" name="Tabla" value="<?php echo $alm->__GET('Tabla'); ?>" style="width:100%;" />
			<?php
				foreach($model_gen->ListarTabla() as $r): 
				?>	<option 
				<?php 
						if ($alm->__GET('Tabla')==$r->Codigo)
						{
							echo ' selected';
						}
					?>				
				value="<?php echo $r->Codigo; ?>"><?php echo $r->Codigo; ?></option> <?php
				endforeach; 
			?>
			
		</select>
		</div>
	</td>
 
</tr>


 <tr>
	<th style="text-align:left;">Codigo Campo</th>
	<td>
		<div class="DivCampo">
			<select type="text" name="Campo" value="<?php echo $alm->__GET('Campo'); ?>" style="width:100%;" />
				<?php
					foreach($model_gen->ListarCampo($alm->__GET('Tabla')) as $r): 
					?>	<option 
					<?php 
							if ($alm->__GET('Campo')==$r->Codigo)
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
					$("#DivTabla").prop('disabled', true);
					$("#DivCampo").prop('disabled', true);
					 $('.DivTabla select').change(function() {
					 $('.DivCampo select').empty();
					 $.getJSON('/Get/getCampo.php?Tabla='+$('.DivTabla select').val(),function(data){
						 $.each(data, function(i,item){
					 $('.DivCampo select').append('<option value="'+item.Field+'">'+item.Field+'</option>');
						 });
					 });
						});
					$("#DivTabla").prop('disabled', false);
					$("#DivCampo").prop('disabled', false);
					});
			</script>
		</div>
	</td>
 
</tr>
 
 
 
</table>
 
</form>
 
 
 
<table class="pure-table pure-table-horizontal">
 
<thead>
 
<tr>
 <th style="text-align:left;">Codigo Tabla</th>
 <th style="text-align:left;">Codigo Campo</th>
 
<th style="text-align:left;">Imagen</th>
 
 
<th style="text-align:left;">Registro</th>
 
 
<th></th>
 
 
<th></th>
 
                        </tr>
 
                    </thead>
 
                    <?php foreach($model->Listar() as $r): ?>
 
<tr>
 <td><?php echo $r->__GET('Tabla'); ?></td>
 
 <td><?php echo $r->__GET('Campo'); ?></td>
 
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
 

    </body>
</html>
<?php
}
?>