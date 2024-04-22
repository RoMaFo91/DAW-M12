<?php
//Llamada al modelo
require($_SERVER['DOCUMENT_ROOT']."/model/nivel.model.php");

// Creamos instancia de los modelos que se necesitan para la vista
$alm = new Nivel(); 
$model = new NivelModel(); 
$model_mundo = new MundoModel(); 
 
//Llamada a la vista
require($_SERVER['DOCUMENT_ROOT']."/view/nivel.view.php");

?>
