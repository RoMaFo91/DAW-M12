<?php
//Llamada al modelo
// require($_SERVER['DOCUMENT_ROOT']."/classes.php");
require($_SERVER['DOCUMENT_ROOT']."/model/dados.model.php");
// require($_SERVER['DOCUMENT_ROOT']."/model/mundo.model.php");
$alm = new Dados();
$model_mundo = new MundoModel();
$model = new DadosModel();
 
//Llamada a la vista
require($_SERVER['DOCUMENT_ROOT']."/view/dados.view.php");

?>
