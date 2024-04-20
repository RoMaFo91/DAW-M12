<?php
//require('./../conf_bd.php');
//require_once('./../classes.php');

class Nivel {
 
    private $Codigo_Mundo;
    private $Codigo;
    private $Exp_ini;
    private $Exp_fin;
    private $Estado;
   
    public function name()
    {
        return $this->Codigo;
    }

    public function __GET($k){ return $this->$k; }
       public function __SET($k, $v){ return $this->$k = $v; }
   }
    

class NivelModel { 
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
 
            $stm = $this->pdo->prepare("SELECT * FROM Nivel WHERE Codigo_Mundo=?");
            $stm->execute(array($CodMundo));
 
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Nivel();
 
                $alm->__SET('Codigo', $r->Codigo);
				$alm->__SET('Exp_ini', $r->Exp_ini);
				$alm->__SET('Exp_fin', $r->Exp_fin);
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
	
	public function ListarNivelMundo($codigo)
    {
        try
        {
            $result = array();
				$stm = $this->pdo->prepare("SELECT * FROM Nivel WHERE Codigo_Mundo = ?");
				 $stm->execute(array($codigo));
 
 
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new SubClase();
 
                $alm->__SET('Codigo', $r->Codigo);
 
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
                      ->prepare("SELECT * FROM Nivel WHERE Codigo = ? and Codigo_Mundo = ?");
                       
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
            $r = $stm->fetch(PDO::FETCH_OBJ);
 
            $alm = new Nivel();
 
            $alm->__SET('Codigo', $r->Codigo);
			$alm->__SET('Exp_ini', $r->Exp_ini);
			$alm->__SET('Exp_fin', $r->Exp_fin);
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
                      ->prepare("DELETE FROM Nivel WHERE Codigo = ? and Codigo_Mundo = ?");                   
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Actualizar(Nivel $data,$codigo_viejo)
    {
        try
        {
            $sql = "UPDATE Nivel SET 
						Codigo			= ?,
						Exp_ini = ?,
						Exp_fin = ?,
						Codigo_Mundo = ?
                    WHERE Codigo = ?";
 
            $this->pdo->prepare($sql)
                 ->execute(
                array(
					$data->__GET('Codigo'), 
					$data->__GET('Exp_ini'), 
					$data->__GET('Exp_fin'), 						
					$data->__GET('Codigo_Mundo'), 
                    $codigo_viejo
                    )
                );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Registrar(Nivel $data)
    {
        try
        {
			
        $sql = "INSERT INTO Nivel (Codigo_Mundo,Codigo,Exp_ini,Exp_fin) 
                VALUES (?,?,?,?)";
 
        $this->pdo->prepare($sql)
             ->execute(
            array(
				$data->__GET('Codigo_Mundo'), 
				$data->__GET('Codigo'), 
				$data->__GET('Exp_ini'),
				$data->__GET('Exp_fin'),
                )
            );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
}
?>