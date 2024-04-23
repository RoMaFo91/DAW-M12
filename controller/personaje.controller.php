<?php
//Llamada al modelo vinculados
require($_SERVER['DOCUMENT_ROOT']."/model/personaje.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/clase.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/subclase.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/raza.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/nivel.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/caracteristicas.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/atributos.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/userg.model.php");

// Creamos instancia de los modelos que se necesitan para la vista

$alm = new Personaje(); 
$model_mundo = new MundoModel();
$model_subclase = new SubClaseModel();
$model_userg = new UsergModel();
$model_raza = new RazaModel();
$model_nivel = new NivelModel();
$model_caracte = new CaracteristicasModel();
$model_atri = new AtributosModel();

$model = new PersonajeModel(); 
 
//Llamada a la vista
require($_SERVER['DOCUMENT_ROOT']."/view/personaje.view.php");

?>
