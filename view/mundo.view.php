<?php
if (isset($_SESSION['login_correct'])) {
    if (ComprobarSession($_SESSION['user'], $_SESSION['pass'])) {

        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['model'] == 'mundo') {
                switch ($_REQUEST['action']) {
                    case 'actualizar':
                        $alm->__SET('Codigo',              $_REQUEST['Codigo']);
                        $alm->__SET('Nombre',          $_REQUEST['Nombre']);
                        $alm->__SET('Descripcion',        $_REQUEST['Descripcion']);

                        $model->Actualizar($alm, $_REQUEST['Codigo_viejo']);
                        header('Location: index.php?model=mundo&type=form');
                        break;

                    case 'registrar':
                        $alm->__SET('Codigo',          $_REQUEST['Codigo']);
                        $alm->__SET('Nombre',          $_REQUEST['Nombre']);
                        $alm->__SET('Descripcion',        $_REQUEST['Descripcion']);

                        $model->Registrar($alm);
                        header('Location: index.php?model=mundo&type=form');
                        break;

                    case 'eliminar':
                        $model->Eliminar($_REQUEST['Codigo']);
                        header('Location: index.php?model=mundo&type=form');
                        break;
                    case 'editar':
                        $alm = $model->Obtener($_REQUEST['Codigo']);
                        $alm->__SET('Estado', 'actualizar');
                        break;
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

                    <form action="../index.php?model=mundo&type=form&action=<?php echo $alm->Estado == 'actualizar' ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                        <input type="hidden" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" />
                       
                                <?php
                                if ($alm->Estado == 'actualizar') {
                                ?>

                                    <input type="hidden" name="Codigo_viejo" value="<?php echo $alm->__GET('Codigo'); ?>" style="width:100%;" />
                         
                            <?php
                                }
                            ?>
                            Codigo<input type="text" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" style="width:100%;" />
                            Nombre<input type="text" name="Nombre" value="<?php echo $alm->__GET('Nombre'); ?>" style="width:100%;" />
                            Descripcion<textarea rows="10" id="Descripcion" name="Descripcion" style="width:100%;" /><?php echo $alm->__GET('Descripcion'); ?></textarea>
                                    <button type="submit" class="pure-button pure-button-primary">Guardar</button>

                    </form>
                <?php


                }
                if ($type == 'both' || $type == 'form') {
                ?>
                    <table class="pure-table pure-table-horizontal">

                        <thead>

                            <tr>
                                <th >Codigo</th>
                                <th >Nombre</th>
                                <th >Descripcion</th>
                                <th >Editar</th>
                                <th >Eliminar</th>
                            </tr>
                        </thead>

                        <?php foreach ($model->Listar() as $r) : ?>

                            <tr>
                                <td><?php echo $r->__GET('Codigo'); ?></td>
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

                if ($type == 'list') {
                    if (isset($_GET["Nom"]) && isset($_GET["Cod"]))
                    {
                        $_SESSION['CodMundo']=$_GET["Cod"];
                        $_SESSION['NomMundo']=$_GET["Nom"];
                    }
                ?>
                
                    <li class="nav-item"><a class="nav-link" href="../index.php?model=mundo&type=form">Crear Mundo</a></li>
                    <?php
                    foreach ($model->Listar() as $r) :
                            if ($_SESSION['CodMundo'] == $r->__GET('Codigo')) {
                    ?>
                                <b>
                                    <li class="nav-item"><a class="nav-link-sel" href="../index.php?Cod=<?php echo $r->__GET('Codigo'); ?>&Nom=<?php echo $r->__GET('Nombre'); ?>"><?php echo $r->__GET('Codigo'); ?> - <?php echo $r->__GET('Nombre'); ?></a></li>
                                </b>
                            <?php
                            
                        } else {
                            ?>
                            <li class="nav-item"><a class="nav-link" href="../index.php?Cod=<?php echo $r->__GET('Codigo'); ?>&Nom=<?php echo $r->__GET('Nombre'); ?>"><?php echo $r->__GET('Codigo'); ?> - <?php echo $r->__GET('Nombre'); ?></a></li>
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