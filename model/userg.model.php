<?php
//require('./../conf_bd.php');
//require_once('./../classes.php');

class Userg {
 
    private $Codigo_Mundo;
    private $Codigo;
    private $Nombre;
    private $Passwrod;
    private $email;
    private $confirmacion;
    private $Security_Level;
    private $Estado;
    
    public function name()
    {
        return $this->Nombre;
    }


    public function __GET($k){ return $this->$k; }
       public function __SET($k, $v){ return $this->$k = $v; }
   }

class UsergModel { 
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
 //ListarTipoMonsMundo
	 public function ListarUsergMundo($codigo)
    {
        try
        {
           $result = array();

				$stm = $this->pdo->prepare("SELECT * FROM Userg WHERE Codigo_Mundo = ?");
				 $stm->execute(array($codigo));
 
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Userg();
 
                $alm->__SET('Codigo', $r->Codigo);
                $alm->__SET('Nombre', $r->Nombre);
                $alm->__SET('Passwrod', $r->Passwrod);
                $alm->__SET('email', $r->email);
                $alm->__SET('confirmacion', $r->confirmacion);
                $alm->__SET('Security_Level', $r->Security_Level);
                
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
 
    public function Listar()
    {
        try
        {
            $result = array();
 
            $stm = $this->pdo->prepare("SELECT * FROM Userg");
            $stm->execute(array());
 
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Userg();
 
                $alm->__SET('Codigo', $r->Codigo);
                $alm->__SET('Nombre', $r->Nombre);
                $alm->__SET('Passwrod', $r->Passwrod);
                $alm->__SET('email', $r->email);
                $alm->__SET('confirmacion', $r->confirmacion);
                $alm->__SET('Security_Level', $r->Security_Level);
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
 
    public function Lista_User($Codigo)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM Userg WHERE Codigo = ?");
                       
 
            $stm->execute(array($Codigo));
            $r = $stm->fetch(PDO::FETCH_OBJ);
 
            $alm = new Userg();
 
            $alm->__SET('Codigo', $r->Codigo);
            $alm->__SET('Nombre', $r->Nombre);
            $alm->__SET('Passwrod', $r->Passwrod);
            $alm->__SET('email', $r->email);
            $alm->__SET('confirmacion', $r->confirmacion);
            $alm->__SET('Security_Level', $r->Security_Level);
            $alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);
            $result[] = $alm;
 
            return $result;
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
    public function Obtener($Codigo)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM Userg WHERE Codigo = ?");
                       
 
            $stm->execute(array($Codigo));
            $r = $stm->fetch(PDO::FETCH_OBJ);
 
            $alm = new Userg();
 
            $alm->__SET('Codigo', $r->Codigo);
            $alm->__SET('Nombre', $r->Nombre);
            $alm->__SET('Passwrod', $r->Passwrod);
            $alm->__SET('email', $r->email);
            $alm->__SET('confirmacion', $r->confirmacion);
            $alm->__SET('Security_Level', $r->Security_Level);
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
                      ->prepare("DELETE FROM Userg WHERE Codigo = ? and Codigo_Mundo = ?");                   
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Actualizar(Userg $data,$codigo_viejo)
    {
        try
        {
            $cadena=$data->__GET('Passwrod') ;
            if ($cadena!="")
            {
                $texto_codificado=crypt($cadena,'$2017=(rmf)(dps)$(06-10)/(01-04-2024)$');

                $sql = "UPDATE Userg SET 
                            Codigo			= ?,
                            Nombre           = ?, 
                            Passwrod=?,
                            email=?,
                            Codigo_Mundo = ?
                        WHERE Codigo = ?";
     
                $this->pdo->prepare($sql)
                     ->execute(
                    array(
                        $data->__GET('Codigo'), 
                        $data->__GET('Nombre'), 
                        $texto_codificado, 
                        $data->__GET('email'), 
                        $data->__GET('Codigo_Mundo'), 
                        $codigo_viejo,
                        )
                    );
            }
            else
            {

            $sql = "UPDATE Userg SET 
						Codigo			= ?,
                        Nombre           = ?, 
                        email=?,
						Codigo_Mundo = ?
                    WHERE Codigo = ?";
 
            $this->pdo->prepare($sql)
                 ->execute(
                array(
					$data->__GET('Codigo'), 
                    $data->__GET('Nombre'), 
                    $data->__GET('email'), 
					$data->__GET('Codigo_Mundo'), 
                    $codigo_viejo,
                    )
                );
            }
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Registrar(Userg $data)
    {
        $cadena=$data->__GET('Passwrod') ;
        $texto_codificado=crypt($cadena,'$2017=(rmf)(dps)$(06-10)/(01-04-2024)$');
        try
        {
        $sql = "INSERT INTO Userg (Codigo_Mundo,Codigo,Nombre,Passwrod,email) 
                VALUES (?,?, ?,?,?)";
 
        $this->pdo->prepare($sql)
             ->execute(
            array(
				$data->__GET('Codigo_Mundo'), 
				$data->__GET('Codigo'), 
                $data->__GET('Nombre'), 
                $texto_codificado,
                $data->__GET('email'), 
                )
            );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
}
?>