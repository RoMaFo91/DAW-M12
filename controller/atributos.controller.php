<?php
//Llamada al modelo
require($_SERVER['DOCUMENT_ROOT']."/model/atributos.model.php");

// Creamos instancia de los modelos que se necesitan para la vista
$alm = new Atributos(); 
$model_mundo = new MundoModel();
$model = new AtributosModel(); 
 
//Llamada a la vista del modelo
require($_SERVER['DOCUMENT_ROOT']."/view/atributos.view.php");


?>
