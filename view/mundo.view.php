<?php
// Comprovación del usuario este ligin
if (isset($_SESSION['login_correct'])) {
    //Comprovación del usuario es correcto
    if (ComprobarSession($_SESSION['user'], $_SESSION['pass'])) {
        //Comprovación de la si hay una acción a realizar
        if (isset($_REQUEST['action'])) {
            //Comprovación del modelo sobre el que se esta haciendo la acción
            if ($_REQUEST['model'] == 'mundo') {
                //Comprovación de que no sea tipo lista
                //El tipo lista es el menu superior de mundos
                if ($type != 'list') {
                    switch ($_REQUEST['action']) {
                            //Actualización de un registro
                        case 'actualizar':
                            $alm->__SET('Codigo',              $_REQUEST['Codigo']);
                            $alm->__SET('Nombre',          $_REQUEST['Nombre']);
                            $alm->__SET('Descripcion',        $_REQUEST['Descripcion']);

                            $model->Actualizar($alm, $_REQUEST['Codigo']);
                            header('Location: index.php?model=mundo&type=form');
                            break;
                            //Creación de un mundo nuevo
                        case 'registrar':
                            $alm->__SET('Codigo',          $_REQUEST['Codigo']);
                            $alm->__SET('Nombre',          $_REQUEST['Nombre']);
                            $alm->__SET('Descripcion',        $_REQUEST['Descripcion']);

                            $model->Registrar($alm);
                            header('Location: index.php?model=mundo&type=form');
                            break;
                            //Eliminación de un mundo 
                        case 'eliminar':
                            $model->Eliminar($_REQUEST['Codigo']);
                            header('Location: index.php?model=mundo&type=form');
                            break;
                            //Formulario en modo edición para poder actualizar
                        case 'editar':
                            $alm = $model->Obtener($_REQUEST['Codigo']);
                            $alm->__SET('Estado', 'actualizar');
                            break;
                    }
                }
            }
        }
?>

        <div class="pure-g">
            <div class="pure-u-1-12">
                <?php
                if ($type == 'both' || $type == 'form') {
                ?>
                    <h3>Mundo </h3>
                    </br>
                    </br>
                    <!-- Formulario de creación/actualización de registros -->
                    <form action="../index.php?model=mundo&type=form&action=<?php echo $alm->Estado == 'actualizar' ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                        <input type="hidden" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" style="width:100%;" />
                        Nombre<input type="text" name="Nombre" value="<?php echo $alm->__GET('Nombre'); ?>" style="width:100%;" />
                        Descripcion<textarea rows="10" id="Descripcion" name="Descripcion" style="width:100%;" /><?php echo $alm->__GET('Descripcion'); ?></textarea>
                        <button type="submit" class="pure-button pure-button-primary">Guardar</button>

                    </form>
                <?php


                }
                // Tipo comprovamos el tipo para ver si es una pantalla de listado o otro
                if ($type == 'both' || $type == 'form') {
                ?>
                    <table class="pure-table pure-table-horizontal">

                        <thead>

                            <tr>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>

                        <?php foreach ($model->Listar() as $r) : ?>

                            <tr>
                                <td><?php echo $r->__GET('Nombre'); ?></td>
                                <td><?php echo $r->__GET('Descripcion'); ?></td>
                                <td>
                                    <a href="?model=mundo&type=form&action=editar&Codigo=<?php echo $r->Codigo; ?>"><img src="/icon/actualizar.png" alt="Actualizar" style="width:15%"></a>
                                </td>
                                <td>
                                    <a href="?model=mundo&type=form&action=eliminar&Codigo=<?php echo $r->Codigo; ?>"><img src="/icon/eliminar.png" alt="Eliminar" style="width:15%"></a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </table>

                <?php
                }
                //En el caso de ser tipo lista solo pintamos la lista de los mundos disponibles
                if ($type == 'list') {
                    //Comprovamos si esta seleccionado algun mundo y lo marcamos
                    if (isset($_GET["Nom"]) && isset($_GET["Cod"])) {
                        $_SESSION['CodMundo'] = $_GET["Cod"];
                        $_SESSION['NomMundo'] = $_GET["Nom"];
                    }
                ?>


                    <?php
                    //Si el usuario tiene nivel inferior a 100 solo podra ver sus mundos
                    if ($_SESSION['level'] < 100) {
                        $lista = $model->Listar_User($_SESSION['user']);
                    }
                    //En el caso de tener level 100 o superior podra ver todos los mundos
                    else {
                    ?><li class="nav-item"><a class="nav-link" href="../index.php?model=mundo&type=form">Crear Mundo</a></li><?php
                                                                                                                                $lista = $model->Listar();
                                                                                                                            }
                                                                                                                            foreach ($lista as $r) :
                                                                                                                                if ($_SESSION['CodMundo'] == $r->__GET('Codigo')) {
                                                                                                                                ?>
                            <b>
                                <li class="nav-item"><a class="nav-link-sel" href="../index.php?Cod=<?php echo $r->__GET('Codigo'); ?>&Nom=<?php echo $r->__GET('Nombre'); ?>"><?php echo $r->__GET('Nombre'); ?></a></li>
                            </b>
                        <?php

                                                                                                                                } else {
                        ?>
                            <li class="nav-item"><a class="nav-link" href="../index.php?Cod=<?php echo $r->__GET('Codigo'); ?>&Nom=<?php echo $r->__GET('Nombre'); ?>"><?php echo $r->__GET('Nombre'); ?></a></li>
                <?php
                                                                                                                                }

                                                                                                                            endforeach;
                                                                                                                        }

                ?>


            </div>

        </div>
<?php
    }
}
?>