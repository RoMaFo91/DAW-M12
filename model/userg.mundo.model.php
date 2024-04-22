<?php
//require('./../conf_bd.php');
//require_once('./../classes.php');

class Userg_Mundo {
 
    private $Codigo_Mundo;
    private $Codigo_Userg;
    
    public function __GET($k){ return $this->$k; }
       public function __SET($k, $v){ return $this->$k = $v; }
   }

class Userg_MundoModel { 
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
	 public function Listar($codigo_userg)
    {
        try
        {
           $result = array();

				$stm = $this->pdo->prepare("SELECT * FROM Userg_Mundo WHERE Codigo_Userg = ?");
				 $stm->execute(array($codigo_userg));
 
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Userg_Mundo();
 
                $alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);
                $alm->__SET('Codigo_Userg', $r->Codigo_Userg);
 
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
                      ->prepare("SELECT * FROM Userg_Mundo WHERE Codigo = ?");
                       
 
            $stm->execute(array($Codigo));
            $r = $stm->fetch(PDO::FETCH_OBJ);
 
            $alm = new Userg_Mundo();
 
            $alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);
            $alm->__SET('Codigo_Userg', $r->Codigo_Userg);
 
            return $alm;
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Eliminar($Codigo_Userg,$Codigo_Mundo)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("DELETE FROM Userg_Mundo WHERE Codigo_Userg = ? and Codigo_Mundo = ?");                   
 
            $stm->execute(array($Codigo_Userg,$Codigo_Mundo));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
    public function Eliminar_user($Codigo_Userg)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("DELETE FROM Userg_Mundo WHERE Codigo_Userg = ?" );                   
 
            $stm->execute(array($Codigo_Userg));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Actualizar(Userg_Mundo $data,$codigo_viejo)
    {
        try
        {
            $sql = "UPDATE Userg_Mundo SET 
						Codigo_Userg			= ?,
                        Codigo_Mundo			= ?
                    WHERE Codigo_Userg = ? AND Codigo_Mundo = ? ";
 
            $this->pdo->prepare($sql)
                 ->execute(
                array(
					$data->__GET('Codigo_Userg'), 
					$data->__GET('Codigo_Mundo'), 
                    $codigo_viejo,
                    $data->__GET('Codigo_Mundo')
                    )
                );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Registrar(Userg_Mundo $data)
    {
        try
        {
        $sql = "INSERT INTO Userg_Mundo (Codigo_Userg,Codigo_Mundo) 
                VALUES (?,?)";
 
        $this->pdo->prepare($sql)
             ->execute(
            array(
				$data->__GET('Codigo_Userg'), 
                $data->__GET('Codigo_Mundo'), 
                )
            );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
}
?>