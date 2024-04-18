<?php
//require('./../conf_bd.php');
//require_once('./../classes.php');
class Dados {
 
    private $Codigo_Mundo;
    private $Codigo;
    private $ValMin;
    private $ValMax;
    private $Estado;
    
    public function __GET($k){ return $this->$k; }
       public function __SET($k, $v){ return $this->$k = $v; }
   }

class DadosModel { 
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
 
            $stm = $this->pdo->prepare("SELECT * FROM Dados WHERE Codigo_Mundo=?");
            $stm->execute(array($CodMundo));
 
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Dados();
 
                $alm->__SET('Codigo', $r->Codigo);
				$alm->__SET('ValMin', $r->ValMin);
				$alm->__SET('ValMax', $r->ValMax);
				$alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);
 
                $result[] = $alm;
            }
 
            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
	
	 public function ListarDadosMundo($Codigo_Mundo)
    {
        try
        {
            $result = array();
		if (is_null($Codigo_Mundo))
		{
			$stm = $this->pdo->prepare(" SELECT * FROM Dados WHERE Codigo_Mundo = ( SELECT Codigo 	FROM Mundo	LIMIT 1 ) ");
			$stm->execute();
		}
		else
		{
			$stm = $this->pdo->prepare("SELECT * FROM Dados WHERE Codigo_Mundo=?");
			 $stm->execute(array($Codigo_Mundo));
		}
           
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Dados();
 
                $alm->__SET('Codigo', $r->Codigo);
				$alm->__SET('ValMin', $r->ValMin);
				$alm->__SET('ValMax', $r->ValMax);
				$alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);
 
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
                      ->prepare("SELECT * FROM Dados WHERE Codigo = ? and Codigo_Mundo = ?");
                       
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
            $r = $stm->fetch(PDO::FETCH_OBJ);
 
            $alm = new Dados();
 
            $alm->__SET('Codigo', $r->Codigo);
			$alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);
			$alm->__SET('ValMin', $r->ValMin);
			$alm->__SET('ValMax', $r->ValMax);
 
 
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
                      ->prepare("DELETE FROM Dados WHERE Codigo = ? and Codigo_Mundo = ?");                   
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Actualizar(Dados $data,$codigo_viejo)
    {
        try
        {
            $sql = "UPDATE Dados SET 
						Codigo			= ?,
						Codigo_Mundo = ?,
						ValMin = ?,
						ValMax = ?
                    WHERE Codigo = ? AND Codigo_Mundo = ?";
 
            $this->pdo->prepare($sql)
                 ->execute(
                array(
					$data->__GET('Codigo'), 
					$data->__GET('Codigo_Mundo'), 
					$data->__GET('ValMin'),
					$data->__GET('ValMax'), 
                    $codigo_viejo,
                    $data->__GET('Codigo_Mundo')
                    )
                );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Registrar(Dados $data)
    {
        try
        {
        $sql = "INSERT INTO Dados (Codigo_Mundo,Codigo,ValMin,ValMax) 
                VALUES (?,?, ?,?)";
 
        $this->pdo->prepare($sql)
             ->execute(
            array(
				$data->__GET('Codigo_Mundo'), 
				$data->__GET('Codigo'), 
				$data->__GET('ValMin'),
				$data->__GET('ValMax'),
                )
            );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
	
	
	
}
?>