<?php
//Llamada al modelo

require($_SERVER['DOCUMENT_ROOT']."/model/userg.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/userg.mundo.model.php");


// Creamos instancia de los modelos que se necesitan para la vista
$alm = new Userg(); 
$model_userg_mundo = new Userg_MundoModel(); 
$model_mundo = new MundoModel();
$model = new UsergModel(); 

//Llamada a la vista
require($_SERVER['DOCUMENT_ROOT']."/view/userg.view.php");

?>
