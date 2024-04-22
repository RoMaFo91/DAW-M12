<?php
//Llamada al modelo

require($_SERVER['DOCUMENT_ROOT']."/model/subclase.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/clase.model.php");

// Creamos instancia de los modelos que se necesitan para la vista
$alm = new SubClase(); 
$model_mundo = new MundoModel();
$model_clase = new ClaseModel();
$model = new SubClaseModel(); 

//Llamada a la vista
require($_SERVER['DOCUMENT_ROOT']."/view/subclase.view.php");

?>
