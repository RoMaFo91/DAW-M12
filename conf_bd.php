<?php 
class Conf_BD {
 private $UserBD;
 private $PassBD;
 private $BD;
 private $Server;
 
 public function __CONSTRUCT() { 
 //'mysql:host=localhost;dbname=id3949160_rfg_v1', 'id3949160_rfg_v1','roger'
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