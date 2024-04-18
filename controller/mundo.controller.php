<?php
//Llamada al modelo
// require($_SERVER['DOCUMENT_ROOT']."/classes.php");

require_once($_SERVER['DOCUMENT_ROOT']."/model/mundo.model.php");
$alm = new Mundo(); 
$model = new MundoModel(); 
//Llamada a la vista
require($_SERVER['DOCUMENT_ROOT']."/view/mundo.view.php");




?>
