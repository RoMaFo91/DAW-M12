
<?php
// Comprobación de si el usuario a realizado login
if (isset($_SESSION['login_correct'])) {
    //Comprovación del usuario si es correcto
    if (ComprobarSession($_SESSION['user'], $_SESSION['pass'])) {
        //Comprovación de la acción que se esta realizando en el caso de estar utilizando el formulario
        
        if (isset($_REQUEST['action']))
        {
            if ($_REQUEST['model'] == 'userg') { {
                    switch ($_REQUEST['action']) {
                        // Actualizar registro
                        case 'actualizar':
                            $alm->__SET('Codigo_Mundo',              $_SESSION['CodMundo']);
                            $alm->__SET('Codigo',              $_REQUEST['Codigo']);
                            $alm->__SET('Nombre',          $_REQUEST['Nombre']);
                            $alm->__SET('Passwrod',          $_REQUEST['Passwrod']);
                            $alm->__SET('email',          $_REQUEST['email']);

                            //Obtenemos de la tabla los valores necesarios para los mundos del usuario
                            $table=$_REQUEST['tabla'];
                            $i=0;
                            //Por cada registro lo guardamos en la tabla
                            while ($i<count($table))
                            {
                                $code_mundo_base=$table[$i][0];
                                
                                $code_mundo=$table[$i][1];
                                
                                $value_row__=$table[$i][2];
                                
                            
                                //Comprobamos si esta marcado a si o no
                                if ($value_row__=="Y")
                                {
                                    // Si no tiene código es que no existe en la tabla por lo
                                    //tanto se tiene que crear
                                    if ($code_mundo=='')
                                    {
                                        
                                        $userg_mundo=new Userg_Mundo();
                                        $userg_mundo->__SET('Codigo_Userg',$_REQUEST['Codigo']);
                                        $userg_mundo->__SET('Codigo_Mundo',$code_mundo_base);
                                        
                                        $model_userg_mundo->Registrar($userg_mundo);
                                    }
                                    
                                }
                                else
                                {
                                    //Si esta marcado que no comprobamos si el valor ya existia
                                    //en el caso de que exista lo eliminamos
                                    if ($code_mundo!='')
                                    {
                                        $model_userg_mundo->Eliminar($_REQUEST['Codigo'],$code_mundo);
                                    }
                                }
                                
                                $i=$i+1;
                            }
                            //Llamamos al modelo para actualizar el registro
                            $model->Actualizar($alm, $_REQUEST['Codigo']);
                            if ($_SESSION['level'] >= 100) {
                                header('Location: index.php?model=userg&type=form');
                            } else {
                                header('Location: index.php?model=userg&type=form&action=editar&Codigo=' . $_SESSION['user'] . '&Codigo_Mundo=' . $_SESSION['CodMundo'] . '');
                            }

                            break;

                        case 'registrar':
                            //Para crear nuevos registros
                            $alm->__SET('Codigo_Mundo',          $_SESSION['CodMundo']);
                            $alm->__SET('Codigo',          $_REQUEST['Codigo']);
                            $alm->__SET('Nombre',          $_REQUEST['Nombre']);
                            $alm->__SET('Passwrod',          $_REQUEST['Passwrod']);
                            $alm->__SET('email',          $_REQUEST['email']);

                            //Registramos el registro antes de cargar las tablas auxiliares
                            //ya que si no fallaria
                            $model->Registrar($alm);

                            $table=$_REQUEST['tabla'];
                            $i=0;
                            //Por cada registro lo guardamos en la tabla
                            while ($i<count($table))
                            {
                                $code_mundo_base=$table[$i][0];
                                
                                $code_mundo=$table[$i][1];
                                
                                $value_row__=$table[$i][2];
                                
                            
                                //Comprobamos si esta marcado a si o no
                                if ($value_row__=="Y")
                                {
                                    // Si no tiene código es que no existe en la tabla por lo
                                    //tanto se tiene que crear
                                    if ($code_mundo=='')
                                    {
                                        
                                        $userg_mundo=new Userg_Mundo();
                                        $userg_mundo->__SET('Codigo_Userg',$_REQUEST['Codigo']);
                                        $userg_mundo->__SET('Codigo_Mundo',$code_mundo_base);
                                        
                                        $model_userg_mundo->Registrar($userg_mundo);
                                    }
                                    
                                }
                                else
                                {
                                    //Si esta marcado que no comprobamos si el valor ya existia
                                    //en el caso de que exista lo eliminamos
                                    if ($code_mundo!='')
                                    {
                                        $model_userg_mundo->Eliminar($_REQUEST['Codigo'],$code_mundo);
                                    }
                                }
                                
                                $i=$i+1;
                            }
                            //Llamamos al modelo para actualizar el registro
                            $model->Actualizar($alm, $_REQUEST['Codigo']);
                            if ($_SESSION['level'] >= 100) {
                                //header('Location: index.php?model=userg&type=form');
                            } else {
                               // header('Location: index.php?model=userg&type=form&action=editar&Codigo=' . $_SESSION['user'] . '&Codigo_Mundo=' . $_SESSION['CodMundo'] . '');
                            }


                            
                            header('Location: index.php?model=userg&type=form');
                            break;

                        case 'eliminar':
                            //Elimina el registro que se ha marcado para eliminar
                            $model_userg_mundo->Eliminar_user($_REQUEST['Codigo']);
                            $model->Eliminar($_REQUEST['Codigo'], $_SESSION['CodMundo']);
                            header('Location: index.php?model=userg&type=form');
                            break;
                        case 'editar':
                            //Pone el formulario modo editar
                            $alm = $model->Obtener($_REQUEST['Codigo'], $_SESSION['CodMundo']);
                            $alm->__SET('Estado', 'actualizar');
                            break;
                    }
                }
            }
        }

?>

        <div class="pure-g">

            <div class="pure-u-1-12">
                <h3>Usuario </h3>
                </br>
                </br>
<!-- Formulario para el registro y edición -->
                <form action="../index.php?model=userg&type=form&action=<?php echo $alm->Estado == 'actualizar' ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="Codigo_Mundo" value="<?php echo $alm->__GET('Codigo_Mundo'); ?>" />
                    Codigo<input type="text" name="Codigo" value="<?php echo $alm->__GET('Codigo'); ?>" style="width:100%;" />
                    Nombre<input type="text" name="Nombre" value="<?php echo $alm->__GET('Nombre'); ?>" style="width:100%;" />
                    Password<input type="text" name="Passwrod" value="" style="width:100%;" />
                    email<input type="text" id="email" name="email" value="<?php echo $alm->__GET('email'); ?>" style="width:100%;" />
                    <?php 
                    if ($_SESSION['level'] >= 100) {
                        ?>
                    <div style="width:500px; padding:3px;">
                        <div style="width:245px;  float:left;">
                            <table border="1">
                                <tr>
                                    <td>Mundos</td>
                                    <td></td>
                                </tr>
                                <?php
                                $i=0;
                                foreach ($model_mundo->Listar() as $r) :
                                    $check_it_mundo='';
                                    $check_it = "N";
                                    foreach ($model_userg_mundo->Listar($alm->__GET('Codigo'), $alm->__GET('Codigo_Mundo')) as $w) :
                                        if ($w->Codigo_Mundo == $r->Codigo) {
                                            $check_it_mundo=$w->Codigo_Mundo;
                                            $check_it = "Y";
                                        }
                                    endforeach;
                                    
                                ?> 
                                        <tr>
                                            <td><?php echo $r->Nombre; ?></td>
                                            <td>
                                                <input type="hidden" name="tabla[<?php echo $i; ?>][0]" value="<?php echo $r->Codigo; ?>" style="width:100%;" />
                                                <input type="hidden" name="tabla[<?php echo $i; ?>][1]" value="<?php echo $check_it_mundo; ?>" style="width:100%;" />
                                                <select type="text" name="tabla[<?php echo $i; ?>][2]" value="<?php echo $check_it; ?>" style="width:100%;" >
                                                    <option value="Y" <?php if ($check_it=='Y') {echo "selected";} ?>>Si</option>
                                                    <option value="N"<?php if ($check_it=='N') {echo "selected";} ?>>No</option>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php
                                    $i=$i+1;
                                endforeach;
                                    ?>

                            </table>
                        </div>

                    </div>
                    <?php 
                    }
                        ?>
                    <br /> <br /> <button type="submit" class="pure-button pure-button-primary" onclick="return validateEmail()">Guardar</button>
                </form>


                <?php
                //Comprobamos el nivel de autorización del usuario para
                //dejar visualizar la tabla de usuarios o no
                if ($_SESSION['level'] >= 100) {
                ?>
                    <table class="pure-table pure-table-horizontal">

                        <thead>

                            <tr>
                                <th>Codigo</th>
                                <th>Nombre</th>

                                <th>Editar</th>


                                <th>Eliminar</th>


                            </tr>

                        </thead>

                        <?php foreach ($model->Listar($_SESSION['CodMundo']) as $r) : ?>

                            <tr>
                                <td><?php echo $r->__GET('Codigo'); ?></td>
                                <td><?php echo $r->__GET('Nombre'); ?></td>


                                <td>
                                    <a href="?model=userg&type=form&action=editar&Codigo=<?php echo $r->Codigo; ?>&Codigo_Mundo=<?php echo $r->Codigo_Mundo ?>"><img src="/icon/actualizar.png" alt="Actualizar" style="width:15%"></a>
                                </td>


                                <td>
                                    <a href="?model=userg&type=form&action=eliminar&Codigo=<?php echo $r->Codigo; ?>&Codigo_Mundo=<?php echo $r->Codigo_Mundo ?>"><img src="/icon/eliminar.png" alt="Eliminar" style="width:15%"></a>
                                </td>

                            </tr>

                        <?php endforeach; ?>
                    </table>

                <?php
                }
                ?>



            </div>

        </div>

<?php
    }
}
?>