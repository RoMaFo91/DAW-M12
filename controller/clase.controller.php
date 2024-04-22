<?php
//Llamada al modelo

require($_SERVER['DOCUMENT_ROOT']."/model/clase.model.php");

// Creamos instancia de los modelos que se necesitan para la vista
$alm = new Clase(); 
$model_mundo = new MundoModel();
$model = new ClaseModel(); 
 
//Llamada a la vista
require($_SERVER['DOCUMENT_ROOT']."/view/clase.view.php");

?>
