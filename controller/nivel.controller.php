<?php
//Llamada al modelo
require($_SERVER['DOCUMENT_ROOT']."/model/nivel.model.php");
$alm = new Nivel(); 
$model = new NivelModel(); 
$model_mundo = new MundoModel(); 
 
//Llamada a la vista
require($_SERVER['DOCUMENT_ROOT']."/view/nivel.view.php");

?>
