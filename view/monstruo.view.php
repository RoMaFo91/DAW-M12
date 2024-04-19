<?php
if (isset($_SESSION['login_correct'])) {
	if (ComprobarSession($_SESSION['user'], $_SESSION['pass'])) {
		if (isset($_REQUEST['action']))
			if ($_REQUEST['model'] == 'monstruo') { {
					switch ($_REQUEST['action']) {
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

							$model->Actualizar($alm, $_REQUEST['Codigo_viejo']);

							foreach ($model_mons_carac->Listar($_SESSION['CodMundo'], $_REQUEST['Codigo']) as $r) :
								$mons_car = new Monstruo_Caracteristicas();
								$mons_car->__SET('Codigo_Monstruo', $_REQUEST['Codigo']);
								$mons_car->__SET('Codigo_Monstruo_Mundo', $_SESSION['CodMundo']);
								$mons_car->__SET('Codigo_Caracteristicas_Mundo', $_SESSION['CodMundo']);
								$mons_car->__SET('Codigo_Caracteristicas', $r->Codigo);
								$mons_car->__SET('Valor', $_REQUEST['CarTxtVal' . $r->Codigo]);

								$model_mons_carac->Actualizar($mons_car);
							endforeach;

							foreach ($model_mons_atri->Listar($_SESSION['CodMundo'], $_REQUEST['Codigo']) as $r) :
								$model_atri = new Monstruo_Atributos();
								$model_atri->__SET('Codigo_Monstruo', $_REQUEST['Codigo']);
								$model_atri->__SET('Codigo_Monstruo_Mundo', $_SESSION['CodMundo']);
								$model_atri->__SET('Codigo_Atributo_Mundo', $_SESSION['CodMundo']);
								$model_atri->__SET('Codigo_Atributo', $r->Codigo);
								$model_atri->__SET('Valor', $_REQUEST['AtrTxtVal' . $r->Codigo]);

								$model_mons_atri->Actualizar($model_atri);
							endforeach;

							header('Location: index.php?model=monstruo&type=form');
							break;

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

							foreach ($model_mons_carac->Listar($_SESSION['CodMundo'], $_REQUEST['Codigo']) as $r) :
								$mons_car = new Monstruo_Caracteristicas();
								$mons_car->__SET('Codigo_Monstruo', $_REQUEST['Codigo']);
								$mons_car->__SET('Codigo_Monstruo_Mundo', $_SESSION['CodMundo']);
								$mons_car->__SET('Codigo_Caracteristicas_Mundo', $_SESSION['CodMundo']);
								$mons_car->__SET('Codigo_Caracteristicas', $r->Codigo);
								$mons_car->__SET('Valor', $_REQUEST['CarTxtVal' . $r->Codigo]);

								$model_mons_carac->Registrar($mons_car);
							endforeach;

							foreach ($model_mons_atri->Listar($_SESSION['CodMundo'], $_REQUEST['Codigo']) as $r) :
								$model_atri = new Monstruo_Atributos();
								$model_atri->__SET('Codigo_Monstruo', $_REQUEST['Codigo']);
								$model_atri->__SET('Codigo_Monstruo_Mundo', $_SESSION['CodMundo']);
								$model_atri->__SET('Codigo_Atributo_Mundo', $_SESSION['CodMundo']);
								$model_atri->__SET('Codigo_Atributo', $r->Codigo);
								$model_atri->__SET('Valor', $_REQUEST['AtrTxtVal' . $r->Codigo]);

								$model_mons_atri->Registrar($model_atri);
							endforeach;

							header('Location: index.php?model=monstruo&type=form');
							break;

						case 'eliminar':
							$model_mons_carac->Eliminar($_REQUEST['Codigo'], $_SESSION['CodMundo']);
							$model_mons_atri->Eliminar($_REQUEST['Codigo'], $_SESSION['CodMundo']);
							$model->Eliminar($_REQUEST['Codigo'], $_SESSION['CodMundo']);
							header('Location: monstruo.controller.php');
							break;
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

				<form action="../index.php?model=monstruo&type=form&action=<?php echo $alm->Estado == 'actualizar' ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
					<input type="hidden" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" />
					<input type="hidden" name="Codigo_Mundo" value="<?php echo $_SESSION['CodMundo']; ?>" />



					<?php
					if ($alm->Estado == 'actualizar') {
					?>

						<input type="hidden" name="Codigo_viejo" value="<?php echo $alm->__GET('Codigo'); ?>" style="width:100%;" />

					<?php

					}
					?>

					Codigo<input type="text" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" style="width:100%;" />
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
					Codigo Nivel
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
						<script type="text/javascript">
							$(document).ready(function() {
								$("#DivMundo").prop('disabled', true);
								$("#DivNivel").prop('disabled', true);
								$('.DivMundo select').change(function() {
									$('.DivNivel select').empty();
									$.getJSON('/Get/getNivel.php?codigo_mundo=' + $('.DivMundo select').val(), function(data) {
										$.each(data, function(i, item) {
											$('.DivNivel select').append('<option value="' + item.Codigo + '">' + item.Codigo + '</option>');
										});
									});
								});
								$("#DivMundo").prop('disabled', false);
								$("#DivNivel").prop('disabled', false);
							});
						</script>
					</div>
					Codigo SubClase
					<div class="DivSubClase">
						<select type="text" name="Codigo_SubClase" value="<?php echo $alm->__GET('Codigo_SubClase'); ?>" style="width:100%;" />
						<?php
						foreach ($model_subclase->ListarSubClaseMundo($_SESSION['CodMundo']) as $r) :
						?> <option <?php
							if ($alm->__GET('Codigo_SubClase') == $r->Codigo) {
								echo ' selected';
							}
							?> value="<?php echo $r->Codigo; ?>"><?php echo $r->Nombre; ?></option> <?php
																						endforeach;
																							?>
						</select>
						<script type="text/javascript">
							$(document).ready(function() {
								$("#DivMundo").prop('disabled', true);
								$("#DivSubClase").prop('disabled', true);
								$('.DivMundo select').change(function() {
									$('.DivSubClase select').empty();
									$.getJSON('/Get/getSubClase.php?codigo_mundo=' + $('.DivMundo select').val(), function(data) {
										$.each(data, function(i, item) {
											$('.DivSubClase select').append('<option value="' + item.Codigo + '">' + item.Nombre + '</option>');
										});
									});
								});
								$("#DivMundo").prop('disabled', false);
								$("#DivSubClase").prop('disabled', false);
							});
						</script>
						<div>
							Codigo Tipo Monstruo
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
								<script type="text/javascript">
									$(document).ready(function() {
										$("#DivMundo").prop('disabled', true);
										$("#DivTipoMonstruo").prop('disabled', true);
										$('.DivMundo select').change(function() {
											$('.DivTipoMonstruo select').empty();
											$.getJSON('/Get/getTipoMonstruo.php?codigo_mundo=' + $('.DivMundo select').val(), function(data) {
												$.each(data, function(i, item) {
													$('.DivTipoMonstruo select').append('<option value="' + item.Codigo + '">' + item.Descripcion + '</option>');
												});
											});
										});
										$("#DivMundo").prop('disabled', false);
										$("#DivTipoMonstruo").prop('disabled', false);
									});
								</script>
								<div>

									<br>
									<br>
									<br>
									<div style="width:500px; padding:3px;">
										<div style="width:245px;  float:left;">
											<table border="1">
												<tr>
													<td>Caracteristicas</td>
													<td></td>
												</tr>
												<?php
												foreach ($model_mons_carac->Listar($_SESSION['CodMundo'], $alm->__GET('Codigo')) as $r) :
												?> <td>
														<tr>
															<td><?php echo $r->Nombre; ?></td>
															<td><input type="text" name="CarTxtVal<?php echo $r->Codigo; ?>" value="<?php echo $r->Valor; ?>" style="width:100%;" /></td>
														</tr>
													<?php
												endforeach;
													?>

											</table>
										</div>

										<div style="width:245px;  float:right;">
											<table border="1">
												<tr>
													<td>Atributos</td>
													<td></td>
												</tr>
												<?php
												foreach ($model_mons_atri->Listar($_SESSION['CodMundo'], $alm->__GET('Codigo')) as $r) :
												?> <td>
														<tr>
															<td><?php echo $r->Nombre; ?></td>
															<td><input type="text" name="AtrTxtVal<?php echo $r->Codigo; ?>" value="<?php echo $r->Valor; ?>" style="width:100%;" /></td>
														</tr>
													<?php
												endforeach;
													?>


											</table>
										</div>
									</div>
									<br><br><br>
									<td colspan="2">
										<button type="submit" class="pure-button pure-button-primary">Guardar</button>
									</td>
				</form>



				<table class="pure-table pure-table-horizontal">

					<thead>

						<tr>
							<!--<th >Codigo Mundo</th>-->
							<th>Codigo</th>

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
							<!--<td><?php echo $r->__GET('Codigo_Mundo'); ?></td>-->

							<td><?php echo $r->__GET('Codigo'); ?></td>

							<td><?php echo $r->__GET('Nombre'); ?></td>

							<td><?php echo $r->__GET('Sexo'); ?></td>

							<td><?php echo $r->__GET('ESPNJ'); ?></td>

							<td><?php echo $r->__GET('Codigo_Nivel'); ?></td>

							<td><?php echo $r->__GET('Codigo_SubClase'); ?></td>

							<td><?php echo $r->__GET('Codigo_Tipo_Mons'); ?></td>


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