<?php
//Comprovamos si ha realizado login
if (isset($_SESSION['login_correct'])) {
    //Comprobamos que el usuario que ha hecho login es correcto
    if (ComprobarSession($_SESSION['user'], $_SESSION['pass'])) {
        //Comprovamos que tiene una acción a realizar
        if (isset($_REQUEST['action'])) {
            //Comprovamos el modelo que llega a index.php para saber si es el registro correcto
            if ($_REQUEST['model'] == 'pais') {
                switch ($_REQUEST['action']) {
                        //Para actualizar un registro
                    case 'actualizar':
                        $alm->__SET('Codigo_Mundo',              $_SESSION['CodMundo']);
                        $alm->__SET('Codigo',              $_REQUEST['Codigo']);
                        $alm->__SET('Nombre',              $_REQUEST['Nombre']);

                        $model->Actualizar($alm, $_REQUEST['Codigo']);
                        header('Location: index.php?model=pais&type=form');
                        break;
                        //Para crear un registro
                    case 'registrar':
                        $alm->__SET('Codigo_Mundo',          $_SESSION['CodMundo']);
                        $alm->__SET('Codigo',          $_REQUEST['Codigo']);
                        $alm->__SET('Nombre',              $_REQUEST['Nombre']);
                        $alm->__SET('ValMin',          $_REQUEST['ValMin']);
                        $alm->__SET('ValMax',          $_REQUEST['ValMax']);

                        $model->Registrar($alm);
                        header('Location: index.php?model=pais&type=form');
                        break;
                        //Para eliminar un registros
                    case 'eliminar':
                        $model->Eliminar($_REQUEST['Codigo'], $_SESSION['CodMundo']);
                        header('Location: index.php?model=pais&type=form');
                        break;
                        //Para poner el formulario en modo edición
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
                <h3>Pais </h3>
                </br>
                <!-- Formulario para la creación/edición del pais -->
                <form action="../index.php?model=pais&type=form&action=<?php echo $alm->Estado == 'actualizar' ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">

                    <input type="hidden" name="Codigo_Mundo" value="<?php echo $alm->__GET('Codigo_Mundo'); ?>" />


                    <input type="hidden" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" style="width:100%;" />
                    Nombre<input type="text" name="Nombre" value="<?php echo $alm->__GET('Nombre'); ?>" style="width:100%;" />
                    <button type="submit" class="pure-button pure-button-primary">Guardar</button>
                </form>
                <!-- Creamos una tabla con los pais disponibles para editar -->
                <table class="pure-table pure-table-horizontal">

                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>

                    </thead>

                    <?php
                    //Cargamos todos los paises del mundo que esta selecionado
                    foreach ($model->Listar($_SESSION['CodMundo']) as $r) : ?>

                        <tr>
                            <td><?php echo $r->__GET('Nombre'); ?></td>

                            <td>
                                <a href="?model=pais&type=form&action=editar&Codigo=<?php echo $r->Codigo; ?>&Codigo_Mundo=<?php echo $r->Codigo_Mundo ?>"><img src="/icon/actualizar.png" alt="Actualizar" style="width:15%"></a>
                            </td>


                            <td>
                                <a href="?model=pais&type=form&action=eliminar&Codigo=<?php echo $r->Codigo; ?>&Codigo_Mundo=<?php echo $r->Codigo_Mundo ?>"><img src="/icon/eliminar.png" alt="Eliminar" style="width:15%"></a>
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