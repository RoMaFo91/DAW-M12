<?php
//Llamada al modelo

require($_SERVER['DOCUMENT_ROOT']."/model/dados.model.php");

// Creamos instancia de los modelos que se necesitan para la vista
$alm = new Dados();
$model_mundo = new MundoModel();
$model = new DadosModel();
 
//Llamada a la vista
require($_SERVER['DOCUMENT_ROOT']."/view/dados.view.php");

?>
