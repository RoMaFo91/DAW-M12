<?php
//Llamada al modelo

require($_SERVER['DOCUMENT_ROOT']."/model/raza.model.php");

// Creamos instancia de los modelos que se necesitan para la vista

$alm = new Raza();
$model_mundo = new MundoModel();
$model = new RazaModel();
 
//Llamada a la vista
require($_SERVER['DOCUMENT_ROOT']."/view/raza.view.php");

?>
