<?php
//Llamada al modelo

require($_SERVER['DOCUMENT_ROOT']."/model/pais.model.php");

// Creamos instancia de los modelos que se necesitan para la vista
$alm = new Pais();
$model_mundo = new MundoModel();
$model = new PaisModel();
 
//Llamada a la vista
require($_SERVER['DOCUMENT_ROOT']."/view/pais.view.php");

?>
