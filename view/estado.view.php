<?php
//Comprovación del login sea correcto
if (isset($_SESSION['login_correct'])) {
	//Comprovamos que el usuario y el password son correcto
	if (ComprobarSession($_SESSION['user'], $_SESSION['pass'])) {
		//VAlidación si hay una acción de formulario
		if (isset($_REQUEST['action'])) {
			//Comprovación de si el model que se esta gestionando es el correcto para la vista
			if ($_REQUEST['model'] == 'estado') {
				switch ($_REQUEST['action']) {
						//Acción de actualización
					case 'actualizar':
						$alm->__SET('Codigo_Mundo',              $_SESSION['CodMundo']);
						$alm->__SET('Codigo',              $_REQUEST['Codigo']);
						$alm->__SET('Nombre',          $_REQUEST['Nombre']);
						$alm->__SET('Descripcion',          $_REQUEST['Descripcion']);

						$model->Actualizar($alm, $_REQUEST['Codigo_viejo']);

						header('Location: index.php?model=estado&type=form');
						break;
						//Acción de creación de registro
					case 'registrar':
						$alm->__SET('Codigo_Mundo',          $_SESSION['CodMundo']);
						$alm->__SET('Codigo',          $_REQUEST['Codigo']);
						$alm->__SET('Nombre',          $_REQUEST['Nombre']);
						$alm->__SET('Descripcion',          $_REQUEST['Descripcion']);
						$model->Registrar($alm);

						header('Location: index.php?model=estado&type=form');
						break;
						//Acción de eliminación de registro
					case 'eliminar':
						$model_est_atri->Eliminar($_REQUEST['Codigo'], $_SESSION['CodMundo']);
						$model->Eliminar($_REQUEST['Codigo'], $_SESSION['CodMundo']);
						header('Location: index.php?model=estado&type=form');
						break;
						//Acción para editar el formulario
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
				<h3>Estado </h3>
				</br>
				</br>
				<!-- Formulario de creación/actualización de registros -->
				<form action="../index.php?model=estado&type=form&action=<?php echo $alm->Estado == 'actualizar' ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
					<input type="hidden" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" />
					<input type="hidden" name="Codigo_Mundo" value="<?php echo $alm->__GET('Codigo_Mundo'); ?>" />

					<?php
					if ($alm->Estado == 'actualizar') {
					?>

						<input type="hidden" name="Codigo_viejo" value="<?php echo $alm->__GET('Codigo'); ?>" style="width:100%;" />

					<?php

					}
					?>
					<input type="hidden" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" style="width:100%;" />
					Nombre<input type="text" name="Nombre" value="<?php echo $alm->__GET('Nombre'); ?>" style="width:100%;" />
					Descripción<input type="text" name="Descripcion" value="<?php echo $alm->__GET('Descripcion'); ?>" style="width:100%;" />

					<tr>

						<td colspan="2">
							<button type="submit" class="pure-button pure-button-primary">Guardar</button>
						</td>

					</tr>
				</form>


<!-- Tabla de los registros disponibles para eliminar o editar -->
				<table class="pure-table pure-table-horizontal">

					<thead>

						<tr>
							<th>Nombre</th>
							<th>Descripción</th>

							<th>Editar</th>


							<th>Eliminar</th>


						</tr>

					</thead>

					<?php foreach ($model->Listar($_SESSION['CodMundo']) as $r) : ?>

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