<?php
//Llamada al modelo
// require($_SERVER['DOCUMENT_ROOT']."/classes.php");
require($_SERVER['DOCUMENT_ROOT']."/model/habilidades.model.php");
// require($_SERVER['DOCUMENT_ROOT']."/model/mundo.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/nivel.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/subclase.model.php");
$alm = new Habilidades(); 
$model_mundo = new MundoModel();
$model = new HabilidadesModel(); 
$model_nivel = new NivelModel();
$model_subclase = new SubClaseModel();
 
//Llamada a la vista
require($_SERVER['DOCUMENT_ROOT']."/view/habilidades.view.php");

?>
