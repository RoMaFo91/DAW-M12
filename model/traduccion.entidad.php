<?php class Traduccion {
 
 private $Tabla;
 private $PrimaryKey;
 private $Campo;
 private $Parte;
 private $Texto;
 private $Codigo_Idioma;
 
 public function __GET($k){ return $this->$k; }
    public function __SET($k, $v){ return $this->$k = $v; }
}
 
?>