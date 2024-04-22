<?php
if (isset($_SESSION['login_correct'])) {
	if (ComprobarSession($_SESSION['user'], $_SESSION['pass'])) {
		if (isset($_REQUEST['action']))
			if ($_REQUEST['model'] == 'personaje') { {
					switch ($_REQUEST['action']) {
						case 'actualizar':
							$alm->__SET('Codigo_Mundo',              $_SESSION['CodMundo']);
							$alm->__SET('Codigo',              $_REQUEST['Codigo']);
							$alm->__SET('Nombre',          $_REQUEST['Nombre']);

							$alm->__SET('Sexo',          $_REQUEST['Sexo']);
							
							$alm->__SET('Codigo_Nivel',          $_REQUEST['Codigo_Nivel']);
							$alm->__SET('Codigo_Nivel_Mundo',          $_SESSION['CodMundo']);

							$alm->__SET('Codigo_SubClase',          $_REQUEST['Codigo_SubClase']);
							$alm->__SET('Codigo_SubClase_Mundo',          $_SESSION['CodMundo']);

							$alm->__SET('Codigo_Raza',          $_REQUEST['Codigo_Raza']);
							$alm->__SET('Codigo_Raza_Mundo',          $_SESSION['CodMundo']);

							$alm->__SET('Codigo_Userg',    $_REQUEST['Codigo_Userg']);
							$model->Actualizar($alm);

							header('Location: index.php?model=personaje&type=form');
							break;

						case 'registrar':

							$alm->__SET('Codigo_Mundo',              $_SESSION['CodMundo']);
							$alm->__SET('Codigo',              $_REQUEST['Codigo']);
							$alm->__SET('Nombre',          $_REQUEST['Nombre']);

							$alm->__SET('Sexo',          $_REQUEST['Sexo']);
							
							$alm->__SET('Codigo_Nivel',          $_REQUEST['Codigo_Nivel']);
							$alm->__SET('Codigo_Nivel_Mundo',          $_SESSION['CodMundo']);

							$alm->__SET('Codigo_SubClase',          $_REQUEST['Codigo_SubClase']);
							$alm->__SET('Codigo_SubClase_Mundo',          $_SESSION['CodMundo']);

							$alm->__SET('Codigo_Raza',          $_REQUEST['Codigo_Raza']);
							$alm->__SET('Codigo_Raza_Mundo',          $_SESSION['CodMundo']);

							$alm->__SET('Codigo_Userg',    $_REQUEST['Codigo_Userg']);

							$model->Registrar($alm);


							header('Location: index.php?model=personaje&type=form');
							break;

						case 'eliminar':
							$model->Eliminar($_REQUEST['Codigo'], $_SESSION['CodMundo']);
							header('Location: index.php?model=personaje&type=form');
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
				<h3>Personaje </h3>
				</br>

				<form action="../index.php?model=personaje&type=form&action=<?php echo $alm->Estado == 'actualizar' ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
					<input type="hidden" name="Codigo_Mundo" value="<?php echo $_SESSION['CodMundo']; ?>" />

					Codigo Usuario
					<div class="DivUsuario">
						<select type="text" name="Codigo_Userg" value="<?php echo $alm->__GET('Codigo_Userg'); ?>" style="width:100%;" />
						<?php
						if ($_SESSION['level']<50)
						{
							$lista=$model_userg->Lista_User($_SESSION['user']);
						}
						else
						{
							$lista=$model_userg->Listar();
						}
						foreach ($lista as $r) :
						?> <option <?php
							if ($alm->__GET('Codigo_Userg') == $r->Codigo) {
								echo ' selected';
							}
							?> value="<?php echo $r->Codigo; ?>"><?php echo $r->Codigo; ?></option> <?php
																						endforeach;
																							?>
						</select>
					</div>
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
							?> value="<?php echo $r->Codigo; ?>"><?php echo $r->obj_Codigo_Clase->Nombre .' '. $r->Nombre; ?></option> <?php
																						endforeach;
																							?>
						</select>
						
						<div>
							Codigo Tipo personaje
							<div class="DivTipopersonaje">
								<select type="text" name="Codigo_Raza" value="<?php echo $alm->__GET('Codigo_Raza'); ?>" style="width:100%;" />
								<?php
								foreach ($model_raza->ListarRazaMundo($_SESSION['CodMundo']) as $r) :
								?> <option <?php
									if ($alm->__GET('Codigo_Raza') == $r->Codigo) {
										echo ' selected';
									}
							?> value="<?php echo $r->Codigo; ?>"><?php echo $r->name(); ?></option> <?php
																								endforeach;
																									?>
								</select>
								<div>


									<br>
				
										<button type="submit" class="pure-button pure-button-primary">Guardar</button>
										<br><br>
				</form>



				<table class="pure-table pure-table-horizontal">

					<thead>

						<tr>
							<!--<th >Codigo Mundo</th>-->
							<th>Usuario</th>
							<th>Nombre</th>

							<th>Sexo</th>

							<th>Nivel</th>

							<th>SubClase</th>

							<th>Raza</th>

							<th>Editar</th>


							<th>Eliminar</th>

						</tr>

					</thead>

					<?php 
					if ($_SESSION['level']<50) 
					{
						$list=$model->Listar_User($_SESSION['CodMundo'],$_SESSION['user']);
					}
					else
					{
						$list=$model->Listar($_SESSION['CodMundo']);
					}
					foreach ($list as $r) : ?>

						<tr>
						<td><?php echo $r->__GET('Codigo_Userg'); ?></td>
							<td><?php echo $r->__GET('Nombre'); ?></td>

							<td><?php echo $r->__GET('Sexo'); ?></td>

							<td><?php echo $r->__GET('obj_Codigo_Nivel')->name(); ?></td>

							<td><?php echo $r->__GET('obj_Codigo_SubClase')->name(); ?></td>

							<td><?php echo $r->__GET('obj_Codigo_Raza')->name(); ?></td>


							<td>
								<a href="?model=personaje&type=form&action=editar&Codigo=<?php echo $r->Codigo; ?>&Codigo_Mundo=<?php echo $r->Codigo_Mundo ?>"><img src="/icon/actualizar.png" alt="Actualizar" style="width:15%"></a>
							</td>


							<td>
								<a href="?model=personaje&type=form&action=eliminar&Codigo=<?php echo $r->Codigo; ?>&Codigo_Mundo=<?php echo $r->Codigo_Mundo ?>"><img src="/icon/eliminar.png" alt="Eliminar" style="width:15%"></a>
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