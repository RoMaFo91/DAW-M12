<?php
if (isset($_SESSION['login_correct'])) {

    if (ComprobarSession($_SESSION['user'], $_SESSION['pass'])) {
        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['model'] == 'dados') {
                switch ($_REQUEST['action']) {
                    case 'actualizar':
                        $alm->__SET('Codigo_Mundo',              $_SESSION['CodMundo']);
                        $alm->__SET('Codigo',              $_REQUEST['Codigo']);
                        $alm->__SET('ValMin',          $_REQUEST['ValMin']);
                        $alm->__SET('ValMax',          $_REQUEST['ValMax']);

                        $model->Actualizar($alm, $_REQUEST['Codigo_viejo']);
                        header('Location: index.php?model=dados&type=form');
                        break;

                    case 'registrar':
                        $alm->__SET('Codigo_Mundo',          $_SESSION['CodMundo']);
                        $alm->__SET('Codigo',          $_REQUEST['Codigo']);
                        $alm->__SET('ValMin',          $_REQUEST['ValMin']);
                        $alm->__SET('ValMax',          $_REQUEST['ValMax']);

                        $model->Registrar($alm);
                        header('Location: index.php?model=dados&type=form');
                        break;

                    case 'eliminar':
                        $model->Eliminar($_REQUEST['Codigo'], $_SESSION['CodMundo']);
                        header('Location: index.php?model=dados&type=form');
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
                <h3>Dados </h3>
                </br>

                <form action="../index.php?model=dados&type=form&action=<?php echo $alm->Estado == 'actualizar' ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <!-- <form action="?action=<?php echo $alm->Estado == 'actualizar' ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;"> -->
                    <input type="hidden" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" />
                    <input type="hidden" name="Codigo_Mundo" value="<?php echo $alm->__GET('Codigo_Mundo'); ?>" />







                    <?php
                    if ($alm->Estado == 'actualizar') {
                    ?>

                        <input type="hidden" name="Codigo_viejo" value="<?php echo $alm->__GET('Codigo'); ?>" style="width:100%;" />



                    <?php

                    }
                    ?>


                    <!--
 <tr>
	<th >Codigo Mundo</th>
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


                    Codigo


                    <input type="text" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" style="width:100%;" <?php if ($alm->Estado == 'actualizar') {
                                                                                                                            echo 'readonly';
                                                                                                                        } ?> />






                    ValMin


                    <input type="text" name="ValMin" value="<?php echo $alm->__GET('ValMin'); ?>" style="width:100%;" />



                    ValMax


                    <input type="text" name="ValMax" value="<?php echo $alm->__GET('ValMax'); ?>" style="width:100%;" />






                    <button type="submit" class="pure-button pure-button-primary">Guardar</button>






                </form>



                <table class="pure-table pure-table-horizontal">

                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>ValMin</th>
                            <th>ValMax</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>

                    </thead>

                    <?php foreach ($model->Listar($_SESSION['CodMundo']) as $r) : ?>

                        <tr>
                            <!--<td><?php echo $r->__GET('Codigo_Mundo'); ?></td>  -->

                            <td><?php echo $r->__GET('Codigo'); ?></td>

                            <td><?php echo $r->__GET('ValMin'); ?></td>
                            <td><?php echo $r->__GET('ValMax'); ?></td>

                            <td>
                                <a href="?model=dados&type=form&action=editar&Codigo=<?php echo $r->Codigo; ?>&Codigo_Mundo=<?php echo $r->Codigo_Mundo ?>"><img src="/icon/actualizar.png" alt="Actualizar" style="width:15%"></a>
                            </td>


                            <td>
                                <a href="?model=dados&type=form&action=eliminar&Codigo=<?php echo $r->Codigo; ?>&Codigo_Mundo=<?php echo $r->Codigo_Mundo ?>"><img src="/icon/eliminar.png" alt="Eliminar" style="width:15%"></a>
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