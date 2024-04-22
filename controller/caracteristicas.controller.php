<?php
//Llamada al modelo

require($_SERVER['DOCUMENT_ROOT']."/model/caracteristicas.model.php");

// Creamos instancia de los modelos que se necesitan para la vista
$alm = new Caracteristicas(); 
$model_mundo = new MundoModel();
$model = new CaracteristicasModel(); 
 
//Llamada a la vista
require($_SERVER['DOCUMENT_ROOT']."/view/caracteristicas.view.php");

?>
