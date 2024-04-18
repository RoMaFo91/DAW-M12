<?php
//Llamada al modelo
require($_SERVER['DOCUMENT_ROOT']."/classes.php");
require($_SERVER['DOCUMENT_ROOT']."/model/raza.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/mundo.model.php");

$alm = new Raza();
$model_mundo = new MundoModel();
$model = new RazaModel();
 
//Llamada a la vista
require($_SERVER['DOCUMENT_ROOT']."/view/raza.view.php");

?>
