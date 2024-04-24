<?php
//Comprobamos si el usuario esta login
if (isset($_SESSION['login_correct'])) {
    //Comprovamos si el usuario y el password son correcto
    if (ComprobarSession($_SESSION['user'], $_SESSION['pass'])) {
        //Comprovamos si hay una acción de formulario
        if (isset($_REQUEST['action']))
            //Comprovamos si el model que esta realizando la acción es el correcto
            if ($_REQUEST['model'] == 'clase') { {
                    switch ($_REQUEST['action']) {
                            //Acción de actualizar un registro
                        case 'actualizar':
                            $alm->__SET('Codigo_Mundo',              $_SESSION['CodMundo']);
                            $alm->__SET('Codigo',              $_REQUEST['Codigo']);
                            $alm->__SET('Nombre',          $_REQUEST['Nombre']);

                            $model->Actualizar($alm, $_REQUEST['Codigo']);
                            header('Location: index.php?model=clase&type=form');
                            break;
                            //Acción de creación de registro
                        case 'registrar':
                            $alm->__SET('Codigo_Mundo',          $_SESSION['CodMundo']);
                            $alm->__SET('Codigo',          $_REQUEST['Codigo']);
                            $alm->__SET('Nombre',          $_REQUEST['Nombre']);

                            $model->Registrar($alm);
                            header('Location: index.php?model=clase&type=form');
                            break;
                            //Acción de eliminación de un registro
                        case 'eliminar':
                            $model->Eliminar($_REQUEST['Codigo'], $_SESSION['CodMundo']);
                            header('Location: index.php?model=clase&type=form');
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
                <h3>Clase </h3>
                </br>
                </br>
                <!--  Formulario para creación y actualización de registros -->
                <form action="../index.php?model=clase&type=form&action=<?php echo $alm->Estado == 'actualizar' ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" />
                    <input type="hidden" name="Codigo_Mundo" value="<?php echo $alm->__GET('Codigo_Mundo'); ?>" />



                    <input type="hidden" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" style="width:100%;" />
                    Nombre<input type="text" name="Nombre" value="<?php echo $alm->__GET('Nombre'); ?>" style="width:100%;" />
                    <br /><br /><button type="submit" class="pure-button pure-button-primary">Guardar</button>


                </form>


                <!-- Tabla de todos los elementos del modelo -->
                <table class="pure-table pure-table-horizontal">

                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <?php foreach ($model->Listar($_SESSION['CodMundo']) as $r) : ?>

                        <tr>

                            <td><?php echo $r->__GET('Nombre'); ?></td>


                            <td>
                                <a href="?model=clase&type=form&action=editar&Codigo=<?php echo $r->Codigo; ?>&Codigo_Mundo=<?php echo $r->Codigo_Mundo ?>"><img src="/icon/actualizar.png" alt="Actualizar" style="width:15%"></a>
                            </td>


                            <td>
                                <a href="?model=clase&type=form&action=eliminar&Codigo=<?php echo $r->Codigo; ?>&Codigo_Mundo=<?php echo $r->Codigo_Mundo ?>"><img src="/icon/eliminar.png" alt="Eliminar" style="width:15%"></a>
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