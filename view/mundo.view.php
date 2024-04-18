<?php
if(session_status() == PHP_SESSION_ACTIVE)
// require_once('./../classes.php');
{
if (ComprobarSession($_SESSION['user'], $_SESSION['pass'])) {

    if (isset($_REQUEST['action'])) {
        switch ($_REQUEST['action']) {
            case 'actualizar':
                $alm->__SET('Codigo',              $_REQUEST['Codigo']);
                $alm->__SET('Nombre',          $_REQUEST['Nombre']);
                $alm->__SET('Descripcion',        $_REQUEST['Descripcion']);

                $model->Actualizar($alm, $_REQUEST['Codigo_viejo']);
                header('Location: mundo.controller.php');
                break;

            case 'registrar':
                $alm->__SET('Codigo',          $_REQUEST['Codigo']);
                $alm->__SET('Nombre',          $_REQUEST['Nombre']);
                $alm->__SET('Descripcion',        $_REQUEST['Descripcion']);

                $model->Registrar($alm);
                header('Location: mundo.controller.php');
                break;

            case 'eliminar':
                $model->Eliminar($_REQUEST['Codigo']);
                header('Location: mundo.controller.php');
                break;
            case 'editar':
                $alm = $model->Obtener($_REQUEST['Codigo']);
                $alm->__SET('Estado', 'actualizar');
                break;
        }
    }
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <title>Mantenimiento mundo</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body style="padding:15px;">
        <div class="pure-g">
            <div class="pure-u-1-12">
            <?php
                if ($type=='both' || $type=='form')
                {
?>
<h3>Mundo </h3>
                </br>
                </br>
                <a href="./../index.php">Volver</a>
                </br>
                </br>
                <a href="mundo.controller.php">Nuevo</a>
                </br>
                <form action="?action=<?php echo $alm->Estado == 'actualizar' ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" />
                    <table style="width:500px;">
                        <tr>
                            <?php
                            if ($alm->Estado == 'actualizar') {
                            ?>
                                <th style="display:none;">Viejo Codigo</th>
                                <td><input type="hidden" name="Codigo_viejo" value="<?php echo $alm->__GET('Codigo'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                        <?php
                            }
                        ?>
                        <th style="text-align:left;">Codigo</th>
                        <td><input type="text" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Nombre</th>
                            <td><input type="text" name="Nombre" value="<?php echo $alm->__GET('Nombre'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>

                            <th style="text-align:left;">Descripcion</th>


                            <td><textarea rows="10" id="Descripcion" name="Descripcion" style="width:100%;" /><?php echo $alm->__GET('Descripcion'); ?></textarea></td>

                        </tr>


                        <tr>

                            <td colspan="2">
                                <button type="submit" class="pure-button pure-button-primary">Guardar</button>
                            </td>

                        </tr>

                    </table>

                </form>
<?php


                }
                if ($type=='both' || $type=='form')
                {
            ?>
                <table class="pure-table pure-table-horizontal">

                    <thead>

                        <tr>
                            <th style="text-align:left;">Codigo</th>

                            <th style="text-align:left;">Nombre</th>


                            <th style="text-align:left;">Descripcion</th>


                            <th style="text-align:left;">Imagen</th>


                            <th style="text-align:left;">Registro</th>
                            <th>Entrar</th>


                            <th></th>


                            <th></th>

                        </tr>

                    </thead>

                    <?php foreach ($model->Listar() as $r) : ?>

                        <tr>
                            <td><?php echo $r->__GET('Codigo'); ?></td>

                            <td><?php echo $r->__GET('Nombre'); ?></td>


                            <td><?php echo $r->__GET('Descripcion'); ?></td>



                            <td>
                                <a href="?action=editar&Codigo=<?php echo $r->Codigo; ?>">Editar</a>
                            </td>


                            <td>
                                <a href="?action=eliminar&Codigo=<?php echo $r->Codigo; ?>">Eliminar</a>
                            </td>
                            <td><a href="../lista.php?Cod=<?php echo $r->__GET('Codigo'); ?>&Nom=<?php echo $r->__GET('Nombre'); ?>"><?php echo $r->__GET('Codigo'); ?> - <?php echo $r->__GET('Nombre'); ?></a></td>
                        </tr>

                    <?php endforeach; ?>
                </table>

            <?php
            }

            if ($type=='list')
            {
                ?>
                <li class="nav-item"><a class="nav-link" href="../index.php?model=mundo&type=form">Crear Mundo</a></li> 
                <?php
                 foreach ($model->Listar() as $r) : 
                   ?>
                   
                   <li class="nav-item"><a class="nav-link" href="../lista.php?Cod=<?php echo $r->__GET('Codigo'); ?>&Nom=<?php echo $r->__GET('Nombre'); ?>"><?php echo $r->__GET('Codigo'); ?> - <?php echo $r->__GET('Nombre'); ?></a></li>
                   <?php
                 endforeach;
            }

            ?>


            </div>

        </div>


    </body>

    </html>
<?php
}
}
?>