<?php
//require('./../conf_bd.php');
//require_once('./../classes.php');

class Mundo {
 
    private $Codigo;
    private $Nombre;
    private $Descripcion;
    private $Estado;
    
    public function name()
    {
        return $this->Nombre;
    }

    public function __GET($k){ return $this->$k; }
       public function __SET($k, $v){ return $this->$k = $v; }
   }

class MundoModel { 
		private $pdo; 
		
	public function __CONSTRUCT() { 
	$conf = new Conf_BD();
	try { 
	$this->pdo = new PDO('mysql:host='.$conf->GetServer().';dbname='.$conf->GetBD(), $conf->GetUser(), $conf->GetPass());
	//$this->pdo = new PDO('mysql:host=localhost;dbname=id3949160_rfg_v1', 'id3949160_rfg_v1','roger');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);              
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
 
    public function Listar()
    {
        try
        {
            $result = array();
 
            $stm = $this->pdo->prepare("SELECT * FROM Mundo");
            $stm->execute();
 
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Mundo();
 
                $alm->__SET('Codigo', $r->Codigo);
                $alm->__SET('Nombre', $r->Nombre);
                $alm->__SET('Descripcion', $r->Descripcion);
 
                $result[] = $alm;
            }
 
            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
 
    public function Obtener($Codigo)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM Mundo WHERE Codigo = ?");
                       
 
            $stm->execute(array($Codigo));
            $r = $stm->fetch(PDO::FETCH_OBJ);
 
            $alm = new Mundo();
 
            $alm->__SET('Codigo', $r->Codigo);
            $alm->__SET('Nombre', $r->Nombre);
            $alm->__SET('Descripcion', $r->Descripcion);
 
            return $alm;
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Eliminar($Codigo)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("DELETE FROM Mundo WHERE Codigo = ?");                   
 
            $stm->execute(array($Codigo));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Actualizar(Mundo $data,$codigo_viejo)
    {
        try
        {
            $sql = "UPDATE Mundo SET 
						Codigo			= ?,
                        Nombre           = ?, 
                        Descripcion      = ?
                    WHERE Codigo = ?";
 
            $this->pdo->prepare($sql)
                 ->execute(
                array(
					$data->__GET('Codigo'), 
                    $data->__GET('Nombre'), 
                    $data->__GET('Descripcion'), 
                    $codigo_viejo
                    )
                );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Registrar(Mundo $data)
    {
        try
        {
        $sql = "INSERT INTO Mundo (Codigo,Nombre,Descripcion) 
                VALUES (?, ?, ?)";
 
        $this->pdo->prepare($sql)
             ->execute(
            array(
				$data->__GET('Codigo'), 
                $data->__GET('Nombre'), 
                $data->__GET('Descripcion'), 
                )
            );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
	
	

}
?>