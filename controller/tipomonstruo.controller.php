<?php
//Llamada al modelo
require($_SERVER['DOCUMENT_ROOT']."/model/tipomonstruo.model.php");

// Creamos instancia de los modelos que se necesitan para la vista

$alm = new TipoMonstruo(); 
$model_mundo = new MundoModel();
$model = new TipoMonstruoModel(); 

//Llamada a la vista
require($_SERVER['DOCUMENT_ROOT']."/view/tipomonstruo.view.php");

?>
