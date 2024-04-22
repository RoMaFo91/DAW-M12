<?php
//Llamada al modelo

require($_SERVER['DOCUMENT_ROOT']."/model/lugar.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/pais.model.php");

// Creamos instancia de los modelos que se necesitan para la vista
$alm = new Lugar(); 
$model_mundo = new MundoModel();
$model_pais = new PaisModel();
$model = new LugarModel(); 

//Llamada a la vista
require($_SERVER['DOCUMENT_ROOT']."/view/lugar.view.php");

?>
