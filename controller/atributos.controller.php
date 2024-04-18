<?php
//Llamada al modelo
require($_SERVER['DOCUMENT_ROOT']."/classes.php");
require($_SERVER['DOCUMENT_ROOT']."/model/atributos.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/mundo.model.php");
$alm = new Atributos(); 
$model_mundo = new MundoModel();
$model = new AtributosModel(); 
 
//Llamada a la vista
require($_SERVER['DOCUMENT_ROOT']."/view/atributos.view.php");

?>
