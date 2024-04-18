<?php
//Llamada al modelo
require($_SERVER['DOCUMENT_ROOT']."/classes.php");
require($_SERVER['DOCUMENT_ROOT']."/model/caracteristicas.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/mundo.model.php");
$alm = new Caracteristicas(); 
$model_mundo = new MundoModel();
$model = new CaracteristicasModel(); 
 
//Llamada a la vista
require($_SERVER['DOCUMENT_ROOT']."/view/caracteristicas.view.php");

?>
