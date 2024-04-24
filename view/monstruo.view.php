<?php
//Comprobamos si el usuario esta login
if (isset($_SESSION['login_correct'])) {
	//Comprovamos si el usuario y el password son correcto
	if (ComprobarSession($_SESSION['user'], $_SESSION['pass'])) {
		//Comprovamos si hay una acción de formulario
		if (isset($_REQUEST['action']))
			//Comprovamos si el model que esta realizando la acción es el correcto
			if ($_REQUEST['model'] == 'monstruo') { {
					switch ($_REQUEST['action']) {
							//Acción de actualizar un registro
						case 'actualizar':
							$alm->__SET('Codigo_Mundo',              $_SESSION['CodMundo']);
							$alm->__SET('Codigo',              $_REQUEST['Codigo']);
							$alm->__SET('Nombre',          $_REQUEST['Nombre']);

							$alm->__SET('Sexo',          $_REQUEST['Sexo']);
							if ($_REQUEST['ESPNJ'] == '') {
								$alm->__SET('ESPNJ',          'N');
							} else {
								$alm->__SET('ESPNJ',          'Y');
							}

							$alm->__SET('Codigo_Nivel',          $_REQUEST['Codigo_Nivel']);
							$alm->__SET('Codigo_Nivel_Mundo',          $_SESSION['CodMundo']);

							$alm->__SET('Codigo_SubClase',          $_REQUEST['Codigo_SubClase']);
							$alm->__SET('Codigo_SubClase_Mundo',          $_SESSION['CodMundo']);

							$alm->__SET('Codigo_Tipo_Mons',          $_REQUEST['Codigo_Tipo_Mons']);
							$alm->__SET('Codigo_Tipo_Mons_Mundo',          $_SESSION['CodMundo']);

							$model->Actualizar($alm, $_REQUEST['Codigo']);

							header('Location: index.php?model=monstruo&type=form');
							break;
							//Acción de creación de registro
						case 'registrar':

							$alm->__SET('Codigo_Mundo',          $_SESSION['CodMundo']);
							$alm->__SET('Codigo',          $_REQUEST['Codigo']);
							$alm->__SET('Nombre',          $_REQUEST['Nombre']);
							$alm->__SET('Sexo',          $_REQUEST['Sexo']);
							if ($_REQUEST['ESPNJ'] == '') {
								$alm->__SET('ESPNJ',          'N');
							} else {
								$alm->__SET('ESPNJ',          'Y');
							}
							$alm->__SET('Codigo_Nivel',          $_REQUEST['Codigo_Nivel']);
							$alm->__SET('Codigo_Nivel_Mundo',          $_SESSION['CodMundo']);

							$alm->__SET('Codigo_SubClase',          $_REQUEST['Codigo_SubClase']);
							$alm->__SET('Codigo_SubClase_Mundo',          $_SESSION['CodMundo']);

							$alm->__SET('Codigo_Tipo_Mons',          $_REQUEST['Codigo_Tipo_Mons']);
							$alm->__SET('Codigo_Tipo_Mons_Mundo',          $_SESSION['CodMundo']);

							$model->Registrar($alm);



							header('Location: index.php?model=monstruo&type=form');
							break;
							//Acción de eliminación de un registro
						case 'eliminar':
							$model_mons_carac->Eliminar($_REQUEST['Codigo'], $_SESSION['CodMundo']);
							$model_mons_atri->Eliminar($_REQUEST['Codigo'], $_SESSION['CodMundo']);
							$model->Eliminar($_REQUEST['Codigo'], $_SESSION['CodMundo']);
							header('Location: monstruo.controller.php');
							break;
							//Acción de edición de un registro
						case 'editar':
							$alm = $model->Obtener($_REQUEST['Codigo'], $_SESSION['CodMundo']);
							$alm->__SET('Estado', 'actualizar');
							break;
					}
				}
			}
?>

		<div class="pure-g">

			<div class="pure-u-1-12">
				<h3>Monstruo </h3>
				</br>
				<!--  Formulario para creación y actualización de registros -->
				<form action="../index.php?model=monstruo&type=form&action=<?php echo $alm->Estado == 'actualizar' ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
					<input type="hidden" name="Codigo_Mundo" value="<?php echo $_SESSION['CodMundo']; ?>" />
					<input type="hidden" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" style="width:100%;" />
					Nombre<input type="text" name="Nombre" value="<?php echo $alm->__GET('Nombre'); ?>" style="width:100%;" />
					Sexo
					<select type="text" name="Sexo" style="width:100%;" />
					<option <?php if ($alm->__GET('Sexo') == 'M') {
								echo 'selected';
							} ?> value="M">Masculino</option>
					<option <?php if ($alm->__GET('Sexo') == 'F') {
								echo 'selected';
							} ?> value="F">Femenino</option>
					</select>
					ESPNJ<input type="checkbox" name="ESPNJ" value="Y" style="width:100%;" <?php if ($alm->__GET('ESPNJ') == 'Y') {
																								echo 'checked';
																							} ?> />
					Nivel
					<div class="DivNivel">
						<select type="text" name="Codigo_Nivel" value="<?php echo $alm->__GET('Codigo_Nivel'); ?>" style="width:100%;" />
						<?php
						foreach ($model_nivel->ListarNivelMundo($_SESSION['CodMundo']) as $r) :
						?> <option <?php
									if ($alm->__GET('Codigo_Nivel') == $r->Codigo) {
										echo ' selected';
									}
									?> value="<?php echo $r->Codigo; ?>"><?php echo $r->Codigo; ?></option> <?php
																										endforeach;
																											?>
						</select>
					</div>
					SubClase
					<div class="DivSubClase">
						<select type="text" name="Codigo_SubClase" value="<?php echo $alm->__GET('Codigo_SubClase'); ?>" style="width:100%;" />
						<?php
						foreach ($model_subclase->ListarSubClaseMundo($_SESSION['CodMundo']) as $r) :
						?> <option <?php
									if ($alm->__GET('Codigo_SubClase') == $r->Codigo) {
										echo ' selected';
									}
									?> value="<?php echo $r->Codigo; ?>"><?php echo $r->obj_Codigo_Clase->Nombre . ' ' . $r->Nombre; ?></option> <?php
																																				endforeach;
																																					?>
						</select>
						<div>
							Tipo Monstruo
							<div class="DivTipoMonstruo">
								<select type="text" name="Codigo_Tipo_Mons" value="<?php echo $alm->__GET('Codigo_Tipo_Mons'); ?>" style="width:100%;" />
								<?php
								foreach ($model_tipomons->ListarTipoMonsMundo($_SESSION['CodMundo']) as $r) :
								?> <option <?php
											if ($alm->__GET('Codigo_Tipo_Mons') == $r->Codigo) {
												echo ' selected';
											}
											?> value="<?php echo $r->Codigo; ?>"><?php echo $r->Descripcion; ?></option> <?php
																														endforeach;
																															?>
								</select>


								<br><br><br>

								<button type="submit" class="pure-button pure-button-primary">Guardar</button>
								<br><br>
				</form>


				<!-- Tabla de todos los elementos del modelo -->
				<table class="pure-table pure-table-horizontal">

					<thead>
						<tr>
							<th>Nombre</th>
							<th>Sexo</th>
							<th>ESPNJ</th>
							<th>Codigo_Nivel</th>
							<th>Codigo_SubClase</th>
							<th>Codigo_Tipo_Mons</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
					</thead>

					<?php foreach ($model->Listar($_SESSION['CodMundo']) as $r) : ?>
						<tr>
							<td><?php echo $r->__GET('Nombre'); ?></td>
							<td><?php echo $r->__GET('Sexo'); ?></td>
							<td><?php echo $r->__GET('ESPNJ'); ?></td>
							<td><?php echo $r->__GET('obj_Codigo_Nivel')->name(); ?></td>
							<td><?php echo $r->__GET('obj_Codigo_SubClase')->name(); ?></td>
							<td><?php echo $r->__GET('obj_Codigo_Tipo_Mons')->name(); ?></td>
							<td>
								<a href="?model=monstruo&type=form&action=editar&Codigo=<?php echo $r->Codigo; ?>&Codigo_Mundo=<?php echo $r->Codigo_Mundo ?>"><img src="/icon/actualizar.png" alt="Actualizar" style="width:15%"></a>
							</td>


							<td>
								<a href="?model=monstruo&type=form&action=eliminar&Codigo=<?php echo $r->Codigo; ?>&Codigo_Mundo=<?php echo $r->Codigo_Mundo ?>"><img src="/icon/eliminar.png" alt="Eliminar" style="width:15%"></a>
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