<?php
//Llamada al modelo

require($_SERVER['DOCUMENT_ROOT']."/model/estado.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/atributos.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/estadoatributos.model.php");

// Creamos instancia de los modelos que se necesitan para la vista
$alm = new Estado(); 
$model_mundo = new MundoModel();
$model = new EstadoModel(); 
$model_atri = new AtributosModel();
$model_est_atri = new Estado_AtributoModel();
 
//Llamada a la vista
require($_SERVER['DOCUMENT_ROOT']."/view/estado.view.php");

?>
