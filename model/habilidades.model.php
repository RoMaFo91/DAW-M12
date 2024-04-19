<?php
//require('./../conf_bd.php');
//require_once('./../classes.php');
class Habilidades {
 
    private $Codigo_Mundo;
    private $Codigo;
    private $Nombre;
    private $Codigo_SubClase;
    private $Codigo_Nivel;
    private $obj_Codigo_SubClase;
    private $obj_Codigo_Nivel;
    private $Estado;
    
    public function name()
    {
        return $this->Nombre;
    }

    public function __GET($k){ return $this->$k; }
       public function __SET($k, $v){ return $this->$k = $v; }
   }
    

class HabilidadesModel { 
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
 
            $stm = $this->pdo->prepare("SELECT * FROM Habilidades WHERE Codigo_Mundo=?");
            $stm->execute(array($CodMundo));
 
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Habilidades();
 
                $alm->__SET('Codigo', $r->Codigo);
				$alm->__SET('Nombre', $r->Nombre);
				$alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);
				
                
                $alm->__SET('Codigo_SubClase_Mundo', $r->Codigo_Mundo);
                $alm->__SET('Codigo_SubClase', $r->Codigo_SubClase);
                $alm->__SET('obj_Codigo_SubClase', (new SubClaseModel())->Obtener($r->Codigo_SubClase,$r->Codigo_Mundo));
                    
                $alm->__SET('Codigo_Nivel_Mundo', $r->Codigo_Mundo);
                $alm->__SET('Codigo_Nivel', $r->Codigo_Nivel);
                $alm->__SET('obj_Codigo_Nivel', (new NivelModel())->Obtener($r->Codigo_Nivel,$r->Codigo_Mundo));
                    
				              
				
                $result[] = $alm;
            }
 
            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
	
	 public function ListarHabilidadesMundo($Codigo_Mundo)
    {
        try
        {
            $result = array();
		if (is_null($Codigo_Mundo))
		{
			$stm = $this->pdo->prepare(" SELECT * FROM Habilidades WHERE Codigo_Mundo = ( SELECT Codigo 	FROM Mundo	LIMIT 1 ) ");
			$stm->execute();
		}
		else
		{
			$stm = $this->pdo->prepare("SELECT * FROM Habilidades WHERE Codigo_Mundo=?");
			 $stm->execute(array($Codigo_Mundo));
		}
           
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Habilidades();
 
                $alm->__SET('Codigo', $r->Codigo);
				$alm->__SET('Nombre', $r->Nombre);
				$alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);
				
                $alm->__SET('Codigo_SubClase_Mundo', $r->Codigo_Mundo);
                $alm->__SET('Codigo_SubClase', $r->Codigo_SubClase);
                $alm->__SET('obj_Codigo_SubClase', (new SubClaseModel())->Obtener($r->Codigo_SubClase,$r->Codigo_Mundo));
                    
                $alm->__SET('Codigo_Nivel_Mundo', $r->Codigo_Mundo);
                $alm->__SET('Codigo_Nivel', $r->Codigo_Nivel);
                $alm->__SET('obj_Codigo_Nivel', (new NivelModel())->Obtener($r->Codigo_Nivel,$r->Codigo_Mundo));
                    

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
                      ->prepare("SELECT * FROM Habilidades WHERE Codigo = ? and Codigo_Mundo = ?");
                       
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
            $r = $stm->fetch(PDO::FETCH_OBJ);
 
            $alm = new Habilidades();
 
            $alm->__SET('Codigo', $r->Codigo);
			$alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);
			$alm->__SET('Nombre', $r->Nombre);
			
			$alm->__SET('Codigo_SubClase_Mundo', $r->Codigo_Mundo);
			$alm->__SET('Codigo_SubClase', $r->Codigo_SubClase);
            $alm->__SET('obj_Codigo_SubClase', (new SubClaseModel())->Obtener($r->Codigo_SubClase,$r->Codigo_Mundo));
				
			$alm->__SET('Codigo_Nivel_Mundo', $r->Codigo_Mundo);
			$alm->__SET('Codigo_Nivel', $r->Codigo_Nivel);
            $alm->__SET('obj_Codigo_Nivel', (new NivelModel())->Obtener($r->Codigo_Nivel,$r->Codigo_Mundo));
				 
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
                      ->prepare("DELETE FROM Habilidades WHERE Codigo = ? and Codigo_Mundo = ?");                   
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Actualizar(Habilidades $data,$codigo_viejo)
    {
		
        try
        {
            $sql = "UPDATE Habilidades SET 
						Codigo			= ?,
						Codigo_Mundo = ?,
						Nombre = ?,
						Codigo_SubClase_Mundo = ?,
						Codigo_SubClase = ?,
						Codigo_Nivel_Mundo = ?,
						Codigo_Nivel = ?
                    WHERE Codigo = ?";
 
            $this->pdo->prepare($sql)
                 ->execute(
                array(
					$data->__GET('Codigo'), 
					$data->__GET('Codigo_Mundo'), 
					$data->__GET('Nombre'), 
					$data->__GET('Codigo_Mundo'), 
					$data->__GET('Codigo_SubClase'), 
					$data->__GET('Codigo_Mundo'), 
					$data->__GET('Codigo_Nivel'), 
                    $codigo_viejo
                    )
                );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Registrar(Habilidades $data)
    {
        try
        {
        $sql = "INSERT INTO Habilidades (Codigo_Mundo,Codigo,Nombre,Codigo_SubClase_Mundo,Codigo_SubClase,Codigo_Nivel_Mundo,Codigo_Nivel) 
                VALUES (?,?, ?,?,?,?,?)";
 
        $this->pdo->prepare($sql)
             ->execute(
            array(
				$data->__GET('Codigo_Mundo'), 
				$data->__GET('Codigo'), 
				$data->__GET('Nombre'),
				$data->__GET('Codigo_Mundo'), 
				$data->__GET('Codigo_SubClase'), 
				$data->__GET('Codigo_Mundo'), 
				$data->__GET('Codigo_Nivel'), 
                )
            );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
	
	
	
}
?>