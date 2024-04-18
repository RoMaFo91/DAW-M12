<?php class Atributos {
 
 private $Codigo_Mundo;
 private $Codigo;
 private $Nombre;
 private $Descripcion;
 private $Estado;
 
 public function __GET($k){ return $this->$k; }
    public function __SET($k, $v){ return $this->$k = $v; }
}
 
?>