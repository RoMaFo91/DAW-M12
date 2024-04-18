<?php
//Llamada al modelo
// require($_SERVER['DOCUMENT_ROOT']."/classes.php");
require($_SERVER['DOCUMENT_ROOT']."/model/clase.model.php");
// require($_SERVER['DOCUMENT_ROOT']."/model/mundo.model.php");
$alm = new Clase(); 
$model_mundo = new MundoModel();
$model = new ClaseModel(); 
 
//Llamada a la vista
require($_SERVER['DOCUMENT_ROOT']."/view/clase.view.php");

?>
