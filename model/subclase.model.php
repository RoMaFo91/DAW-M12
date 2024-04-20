<?php
//require('./../conf_bd.php');
//require_once('./../classes.php');

class SubClase {
 
    private $Codigo_Mundo;
    private $Codigo;
    private $Nombre;
    private $Codigo_Clase;
    private $Codigo_Clase_Mundo;
    private $Estado;
    
    public function name()
    {
        return $this->Nombre;
    }


    public function __GET($k){ return $this->$k; }
       public function __SET($k, $v){ return $this->$k = $v; }
   }

class SubClaseModel { 
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
 
    public function Listar($CodMundo)
    {
        try
        {
            $result = array();
 
            $stm = $this->pdo->prepare("SELECT * FROM SubClase WHERE Codigo_Mundo=?");
            $stm->execute(array($CodMundo));
 
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new SubClase();
 
                $alm->__SET('Codigo', $r->Codigo);
				$alm->__SET('Nombre', $r->Nombre);
				$alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);
                $alm->__SET('obj_Codigo_Clase', (new ClaseModel())->Obtener($r->Codigo_Clase,$r->Codigo_Clase_Mundo));
				$alm->__SET('Codigo_Clase', $r->Codigo_Clase);
				$alm->__SET('Codigo_Clase_Mundo', $r->Codigo_Clase_Mundo);
 
                $result[] = $alm;
            }
 
            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
	
	public function ListarSubClaseMundo($codigo)
    {
        try
        {
            $result = array();

		
				$stm = $this->pdo->prepare("SELECT * FROM SubClase WHERE Codigo_Mundo = ?");
				 $stm->execute(array($codigo));
			
 
 
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new SubClase();
 
                $alm->__SET('Codigo', $r->Codigo);
				$alm->__SET('Nombre', $r->Nombre);
				$alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);
                $alm->__SET('obj_Codigo_Clase', (new ClaseModel())->Obtener($r->Codigo_Clase,$r->Codigo_Clase_Mundo));
				$alm->__SET('Codigo_Clase', $r->Codigo_Clase);
				$alm->__SET('Codigo_Clase_Mundo', $r->Codigo_Clase_Mundo);
 
                $result[] = $alm;
            }
 
            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
 
    public function Obtener($Codigo,$Codigo_Mundo)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM SubClase WHERE Codigo = ? and Codigo_Mundo = ?");
                       
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
            $r = $stm->fetch(PDO::FETCH_OBJ);
 
            $alm = new SubClase();
 
            $alm->__SET('Codigo', $r->Codigo);
			$alm->__SET('Nombre', $r->Nombre);
            $alm->__SET('obj_Codigo_Clase', (new ClaseModel())->Obtener($r->Codigo_Clase,$r->Codigo_Clase_Mundo));
            $alm->__SET('Codigo_Clase', $r->Codigo_Clase);
            $alm->__SET('Codigo_Clase_Mundo', $r->Codigo_Clase_Mundo);
			$alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);
 
 
            return $alm;
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Eliminar($Codigo,$Codigo_Mundo)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("DELETE FROM SubClase WHERE Codigo = ? and Codigo_Mundo = ?");                   
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Actualizar(SubClase $data,$codigo_viejo,$codigo_viejo_mundo)
    {
        try
        {
            $sql = "UPDATE SubClase SET 
						Codigo			= ?,
						Nombre = ?,
						Codigo_Mundo = ?,
						Codigo_Clase = ?,
						Codigo_Clase_Mundo=?
                    WHERE Codigo = ? and Codigo_Mundo=?";
			echo "1";
			echo $data->__GET('Codigo_Clase');
			echo "2";
			echo $data->__GET('Codigo_Clase_Mundo');
			echo "3";
			
            $this->pdo->prepare($sql)
                 ->execute(
                array(
					$data->__GET('Codigo'), 
					$data->__GET('Nombre'), 
					$data->__GET('Codigo_Mundo'), 
					$data->__GET('Codigo_Clase'), 
					$data->__GET('Codigo_Clase_Mundo'), 
                    $codigo_viejo,
					$codigo_viejo_mundo,
                    )
                );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Registrar(SubClase $data)
    {
        try
        {
        $sql = "INSERT INTO SubClase (Codigo_Mundo,Codigo,Nombre,Codigo_Clase,Codigo_Clase_Mundo) 
                VALUES (?,?, ?,?,?)";
 
        $this->pdo->prepare($sql)
             ->execute(
            array(
				$data->__GET('Codigo_Mundo'), 
				createGUID(), 
				$data->__GET('Nombre'), 
				$data->__GET('Codigo_Clase'), 
				$data->__GET('Codigo_Clase_Mundo'), 
                )
            );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
}
?>