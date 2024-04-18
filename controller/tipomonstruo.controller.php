<?php
//Llamada al modelo
require($_SERVER['DOCUMENT_ROOT']."/classes.php");
require($_SERVER['DOCUMENT_ROOT']."/model/tipomonstruo.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/mundo.model.php");

$alm = new TipoMonstruo(); 
$model_mundo = new MundoModel();
$model = new TipoMonstruoModel(); 

//Llamada a la vista
require($_SERVER['DOCUMENT_ROOT']."/view/tipomonstruo.view.php");

?>
