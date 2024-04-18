<?php 
class Tabla {
 
 private $Codigo; 
 
 public function __GET($k){ return $this->$k; }
    public function __SET($k, $v){ return $this->$k = $v; }
}

class Campo {
 
 private $Codigo; 
 
 public function __GET($k){ return $this->$k; }
    public function __SET($k, $v){ return $this->$k = $v; }
}

class PrimaryKey {
 
 private $Codigo; 
 
 public function __GET($k){ return $this->$k; }
    public function __SET($k, $v){ return $this->$k = $v; }
}
 
?>