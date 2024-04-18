<?php
session_start();
// require_once('./../classes.php');

if (ComprobarSession($_SESSION['user'], $_SESSION['pass'])) {

    if (isset($_REQUEST['action'])) {
        switch ($_REQUEST['action']) {
            case 'actualizar':
                $alm->__SET('Codigo_Mundo',              $_SESSION['CodMundo']);
                $alm->__SET('Codigo',              $_REQUEST['Codigo']);
                $alm->__SET('ValMin',          $_REQUEST['ValMin']);
                $alm->__SET('ValMax',          $_REQUEST['ValMax']);

                $model->Actualizar($alm, $_REQUEST['Codigo_viejo']);
                header('Location: dados.controller.php');
                break;

            case 'registrar':
                $alm->__SET('Codigo_Mundo',          $_SESSION['CodMundo']);
                $alm->__SET('Codigo',          $_REQUEST['Codigo']);
                $alm->__SET('ValMin',          $_REQUEST['ValMin']);
                $alm->__SET('ValMax',          $_REQUEST['ValMax']);

                $model->Registrar($alm);
                header('Location: dados.controller.php');
                break;

            case 'eliminar':
                $model->Eliminar($_REQUEST['Codigo'], $_SESSION['CodMundo']);
                header('Location: dados.controller.php');
                break;
            case 'editar':
                $alm = $model->Obtener($_REQUEST['Codigo'], $_SESSION['CodMundo']);
                $alm->__SET('Estado', 'actualizar');
                break;
        }
    }

?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <title>Mantenimiento Dados</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
    </head>

    <body style="padding:15px;">


        <div class="pure-g">

            <div class="pure-u-1-12">
                <h3>Dados </h3>
                </br>
                </br>
                <a href="./../lista.php">Volver</a>
                </br>
                </br>
                <a href="dados.controller.php">Nuevo</a>
                </br>

                <form action="?action=<?php echo $alm->Estado == 'actualizar' ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" />
                    <input type="hidden" name="Codigo_Mundo" value="<?php echo $alm->__GET('Codigo_Mundo'); ?>" />


                    <table style="width:500px;">


                        <tr>

                            <?php
                            if ($alm->Estado == 'actualizar') {
                            ?>
                                <th style="display:none;">Viejo Codigo</th>
                                <td><input type="hidden" name="Codigo_viejo" value="<?php echo $alm->__GET('Codigo'); ?>" style="width:100%;" /></td>

                        </tr>

                    <?php

                            }
                    ?>


                    <!--
 <tr>
	<th style="text-align:left;">Codigo Mundo</th>
	<td>
		<select type="text" name="Codigo_Mundo" value="<?php echo $alm->__GET('Codigo_Mundo'); ?>" style="width:100%;" />
			<?php
            foreach ($model_mundo->Listar() as $r) :
            ?>	<option 
				<?php
                if ($alm->__GET('Codigo_Mundo') == $r->Codigo) {
                    echo ' selected';
                }
                ?>				
				value="<?php echo $r->Codigo; ?>"><?php echo $r->Nombre; ?></option> <?php
                                                                                    endforeach;
                                                                                        ?>
			
		</select>

	</td>
 
</tr>
 -->

                    <tr>

                    <tr>
                        <th style="text-align:left;">Codigo</th>


                        <td><input type="text" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" style="width:100%;" <?php if ($alm->Estado == 'actualizar') {
                                                                                                        echo 'readonly';
                                                                                                    } ?>  /></td>

                    </tr>


                    <tr>

                        <th style="text-align:left;">ValMin</th>


                        <td><input type="text" name="ValMin" value="<?php echo $alm->__GET('ValMin'); ?>" style="width:100%;" /></td>

                    </tr>
                    <tr>

                        <th style="text-align:left;">ValMax</th>


                        <td><input type="text" name="ValMax" value="<?php echo $alm->__GET('ValMax'); ?>" style="width:100%;" /></td>

                    </tr>

                    <tr>

                        <td colspan="2">
                            <button type="submit" class="pure-button pure-button-primary">Guardar</button>
                        </td>

                    </tr>

                    </table>

                </form>



                <table class="pure-table pure-table-horizontal">

                    <thead>

                        <tr>
                            <!-- <th style="text-align:left;">Codigo Mundo</th> -->
                            <th style="text-align:left;">Codigo</th>

                            <th style="text-align:left;">ValMin</th>
                            <th style="text-align:left;">ValMax</th>
                            <th style="text-align:left;">Imagen</th>


                            <th style="text-align:left;">Registro</th>


                            <th></th>


                            <th></th>

                        </tr>

                    </thead>

                    <?php foreach ($model->Listar($_SESSION['CodMundo']) as $r) : ?>

                        <tr>
                            <!--<td><?php echo $r->__GET('Codigo_Mundo'); ?></td>  -->

                            <td><?php echo $r->__GET('Codigo'); ?></td>

                            <td><?php echo $r->__GET('ValMin'); ?></td>
                            <td><?php echo $r->__GET('ValMax'); ?></td>

                            <td>
                                <a href="?action=editar&Codigo=<?php echo $r->Codigo; ?>&Codigo_Mundo=<?php echo $r->Codigo_Mundo ?>">Editar</a>
                            </td>


                            <td>
                                <a href="?action=eliminar&Codigo=<?php echo $r->Codigo; ?>&Codigo_Mundo=<?php echo $r->Codigo_Mundo ?>">Eliminar</a>
                            </td>

                        </tr>

                    <?php endforeach; ?>
                </table>



            </div>

        </div>


    </body>

    </html>
<?php
}
?>