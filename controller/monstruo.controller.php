<?php
//Llamada al modelo vinculados
require($_SERVER['DOCUMENT_ROOT']."/model/monstruo.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/clase.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/subclase.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/tipomonstruo.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/nivel.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/caracteristicas.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/atributos.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/monstruoatributos.model.php");
require($_SERVER['DOCUMENT_ROOT']."/model/monstruocaracteristicas.model.php");

// Creamos instancia de los modelos que se necesitan para la vista
$alm = new Monstruo(); 
$model_mundo = new MundoModel();
$model_subclase = new SubClaseModel();
$model_tipomons = new TipoMonstruoModel();
$model_nivel = new NivelModel();
$model_caracte = new CaracteristicasModel();
$model_atri = new AtributosModel();

$model_mons_carac = new Monstruo_CaracteristicasModel();
$model_mons_atri = new Monstruo_AtributosModel();


$model = new MonstruoModel(); 
 
//Llamada a la vista
require($_SERVER['DOCUMENT_ROOT']."/view/monstruo.view.php");

?>
