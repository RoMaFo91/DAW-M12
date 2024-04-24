<?php
//Comprovación de si el usuario a realizado login
if (isset($_SESSION['login_correct'])) {
	//Comprovación del usuario y password es correcto
	if (ComprobarSession($_SESSION['user'], $_SESSION['pass'])) {
		//Comprovación de si es una acción de formulario
		if (isset($_REQUEST['action'])) {
			if ($_REQUEST['model'] == 'lugar') { {
					switch ($_REQUEST['action']) {
							//Apartado para actualizar un lugar
						case 'actualizar':
							$alm->__SET('Codigo_Mundo',              $_SESSION['CodMundo']);
							$alm->__SET('Codigo',              $_REQUEST['Codigo']);
							$alm->__SET('Nombre',          $_REQUEST['Nombre']);
							$alm->__SET('Codigo_Pais',          $_REQUEST['Codigo_Pais']);
							$alm->__SET('Codigo_Pais_Mundo',          $_SESSION['CodMundo']);

							$model->Actualizar($alm, $_REQUEST['Codigo'], $_SESSION['CodMundo']);
							header('Location: index.php?model=lugar&type=form');
							break;
							//Apartado para crear un lugar
						case 'registrar':
							$alm->__SET('Codigo_Mundo',          $_SESSION['CodMundo']);
							$alm->__SET('Codigo',          $_REQUEST['Codigo']);
							$alm->__SET('Nombre',          $_REQUEST['Nombre']);
							$alm->__SET('Codigo_Pais',          $_REQUEST['Codigo_Pais']);
							$alm->__SET('Codigo_Pais_Mundo',          $_SESSION['CodMundo']);

							$model->Registrar($alm);
							header('Location: index.php?model=lugar&type=form');
							break;
							//Apartado para eliminar un lugar
						case 'eliminar':
							$model->Eliminar($_REQUEST['Codigo'], $_SESSION['CodMundo']);
							header('Location: index.php?model=lugar&type=form');
							break;
							//Apartado para poner el formulario en modo edición
						case 'editar':
							$alm = $model->Obtener($_REQUEST['Codigo'], $_SESSION['CodMundo']);
							$alm->__SET('Estado', 'actualizar');
							break;
					}
				}
			}
		}

?>


		<div class="pure-g">

			<div class="pure-u-1-12">
				<h3>Lugar </h3>
				</br>
				</br>
				<!-- Formulario para crear y editar los registros -->
				<form action="../index.php?model=lugar&type=form&action=<?php echo $alm->Estado == 'actualizar' ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
					<input type="hidden" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" />
					<input type="hidden" name="Codigo_Mundo" value="<?php echo $alm->__GET('Codigo_Mundo'); ?>" />
					Pais<div class="lugarCodigo_Pais">
						<select name="Codigo_Pais">
							<?php
							foreach ($model_pais->ListarPaisMundo($_SESSION['CodMundo']) as $r) :
							?> <option <?php
								if ($alm->__GET('Codigo_Pais') == $r->Codigo) {
									echo ' selected';
								}
							?> value="<?php echo $r->Codigo; ?>"><?php echo $r->Nombre; ?></option> <?php
																						endforeach;
																							?>
						</select>
					</div>
					<input type="hidden" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" style="width:100%;" />
					Nombre
					<input type="text" name="Nombre" value="<?php echo $alm->__GET('Nombre'); ?>" style="width:100%;" />

					<br /><br /><button type="submit" class="pure-button pure-button-primary">Guardar</button>
				</form>


				<!-- Tabla de todos los elementos del modelo -->																			
				<table class="pure-table pure-table-horizontal">

					<thead>

						<tr>
							<th>Pais</th>
							<th>Nombre</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<?php foreach ($model->Listar($_SESSION['CodMundo']) as $r) : ?>
						<tr>
							<td><?php echo $r->__GET('obj_Codigo_Pais')->name(); ?></td>
							<td><?php echo $r->__GET('Nombre'); ?></td>
							<td>
								<a href="?model=lugar&type=form&action=editar&Codigo=<?php echo $r->Codigo; ?>&Codigo_Mundo=<?php echo $r->Codigo_Mundo ?>"><img src="/icon/actualizar.png" alt="Actualizar" style="width:15%"></a>
							</td>
							<td>
								<a href="?model=lugar&type=form&action=eliminar&Codigo=<?php echo $r->Codigo; ?>&Codigo_Mundo=<?php echo $r->Codigo_Mundo ?>"><img src="/icon/eliminar.png" alt="Eliminar" style="width:15%"></a>
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