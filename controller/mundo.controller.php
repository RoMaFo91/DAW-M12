<?php
//Llamada al modelo


require_once($_SERVER['DOCUMENT_ROOT']."/model/mundo.model.php");

// Creamos instancia de los modelos que se necesitan para la vista
$alm = new Mundo(); 
$model = new MundoModel(); 
//Llamada a la vista
require($_SERVER['DOCUMENT_ROOT']."/view/mundo.view.php");




?>
