<?php 
if (isset($_SESSION['login_correct'])) {
if (ComprobarSession($_SESSION['user'],$_SESSION['pass'])){
if(isset($_REQUEST['action']))  {
if ($_REQUEST['model'] == 'estado') {
 switch($_REQUEST['action']) { 
		case 'actualizar': 
			$alm->__SET('Codigo_Mundo',              $_SESSION['CodMundo']);
			$alm->__SET('Codigo',              $_REQUEST['Codigo']);
            $alm->__SET('Nombre',          $_REQUEST['Nombre']);
			$alm->__SET('Descripcion',          $_REQUEST['Descripcion']);

            $model->Actualizar($alm, $_REQUEST['Codigo_viejo']);
			$code=$_REQUEST['AtrTxtValCode'];
			$valor=$_REQUEST['AtrTxtVal'];
			$i=0;
			foreach ($valor as $value_row)
			{
				$est_atri=new Estado_Atributo();
				$est_atri->__SET('Codigo_Estado',$_REQUEST['Codigo']);
				$est_atri->__SET('Codigo_Estado_Mundo',$_SESSION['CodMundo']);
				$est_atri->__SET('Codigo_Atributo_Mundo',$_SESSION['CodMundo']);
				$est_atri->__SET('Codigo_Atributo',$code[$i]);
				$est_atri->__SET('Valor',$value_row);
				
				$model_est_atri->Actualizar($est_atri);
				$i=+1;
			}
				
			
			foreach($model_est_atri->Listar($_REQUEST['Codigo'],$_SESSION['CodMundo']) as $r): 
				
			endforeach; 
			
            header('Location: index.php?model=estado&type=form');
            break;
 
        case 'registrar':
			$alm->__SET('Codigo_Mundo',          $_SESSION['CodMundo']);
			$alm->__SET('Codigo',          $_REQUEST['Codigo']);
            $alm->__SET('Nombre',          $_REQUEST['Nombre']);
			$alm->__SET('Descripcion',          $_REQUEST['Descripcion']);
            $model->Registrar($alm);
			

			$code=$_REQUEST['AtrTxtValCode'];
			$valor=$_REQUEST['AtrTxtVal'];
			$i=0;
			foreach ($valor as $value_row)
			{
				$est_atri=new Estado_Atributo();
				$est_atri->__SET('Codigo_Estado',$_REQUEST['Codigo']);
				$est_atri->__SET('Codigo_Estado_Mundo',$_SESSION['CodMundo']);
				$est_atri->__SET('Codigo_Atributo_Mundo',$_SESSION['CodMundo']);
				$est_atri->__SET('Codigo_Atributo',$code[$i]);
				$est_atri->__SET('Valor',$value_row);
				
				$model_est_atri->Registrar($est_atri);
				$i=+1;
			}
			
			
            header('Location: index.php?model=estado&type=form');
            break;
 
        case 'eliminar':
			$model_est_atri->Eliminar($_REQUEST['Codigo'],$_SESSION['CodMundo']);
            $model->Eliminar($_REQUEST['Codigo'],$_SESSION['CodMundo']);
            header('Location: index.php?model=estado&type=form');
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
    <h3>Estado       </h3>     
	 </br>
 </br>
 
<form action="../index.php?model=estado&type=form&action=<?php echo $alm->Estado =='actualizar' ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" />
					<input type="hidden" name="Codigo_Mundo" value="<?php echo $alm->__GET('Codigo_Mundo'); ?>" />
                     
	 <?php
	 if ($alm->Estado=='actualizar')
	 {
	 ?>
	 
	<input type="hidden" name="Codigo_viejo" value="<?php echo $alm->__GET('Codigo'); ?>" style="width:100%;" />
	
<?php
 
}
 ?>
<input type="hidden" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" style="width:100%;" />
Nombre<input type="text" name="Nombre" value="<?php echo $alm->__GET('Nombre'); ?>" style="width:100%;" />
Descripción<input type="text" name="Descripcion" value="<?php echo $alm->__GET('Descripcion'); ?>" style="width:100%;" />
						
				<table border="1">
					<tr>
						<td>Atributos</td>
						<td>Valor</td>
					</tr>
					<?php
				foreach($model_est_atri->Listar($_SESSION['CodMundo'],$alm->__GET('Codigo')) as $r): 
				?>	<td>
					<tr>
						<td><?php echo $r->Nombre; ?></td>
						<td>
						<input type="hidden" name="AtrTxtValCode[]" value="<?php echo $r->Codigo; ?>" style="width:100%;" />
						<input type="text" name="AtrTxtVal[]" value="<?php echo $r->Valor; ?>" style="width:100%;" />
					</td>
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
<th >Nombre</th> 
<th >Descripción</th> 
 
<th >Editar</th>
 
 
<th >Eliminar</th>
 
 
                        </tr>
 
                    </thead>
 
                    <?php foreach($model->Listar($_SESSION['CodMundo']) as $r): ?>
 
<tr>
<td><?php echo $r->__GET('Nombre'); ?></td>
<td><?php echo $r->__GET('Descripcion'); ?></td>
 
<td>
                                <a href="?model=estado&type=form&action=editar&Codigo=<?php echo $r->Codigo; ?>&Codigo_Mundo=<?php echo $r->Codigo_Mundo ?>"><img src="/icon/actualizar.png" alt="Actualizar" style="width:15%"></a>
                            </td>
 
 
<td>
                                <a href="?model=estado&type=form&action=eliminar&Codigo=<?php echo $r->Codigo; ?>&Codigo_Mundo=<?php echo $r->Codigo_Mundo ?>"><img src="/icon/eliminar.png" alt="Eliminar" style="width:15%"></a>
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