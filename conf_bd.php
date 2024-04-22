<?php 
//Clase que representa una conexión a una base de datos MySQL
//En esta clase es donde esta guardado todo lo relacionado con la conexión
//Base de datos, usuario, password, servidor
//tambien tiene los metodos Get para obtener los valores que son utilizados en toda la aplicación
class Conf_BD {
 private $UserBD;
 private $PassBD;
 private $BD;
 private $Server;
 
 public function __CONSTRUCT() { 
	$this->UserBD ='project' ;
	$this->PassBD ='1234' ;
	$this->BD ='project_v1' ;
	$this->Server ='localhost' ;
 }
 public function GetUser()
 {
	return $this->UserBD;
 }
 
 public function GetPass()
 {
	return $this->PassBD;
 }
 
 public function GetBD()
 {
	return $this->BD;
 }
 
  public function GetServer()
 {
	return $this->Server;
 }
 
}
 
?>