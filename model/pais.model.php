<?php
//Clase para la representación de la tabla de paises
class Pais {
 
    private $Codigo_Mundo;
    private $Codigo;
    private $Nombre;
    private $Estado;
    
    public function name()
    {
        return $this->Nombre;
    }

    public function __GET($k){ return $this->$k; }
       public function __SET($k, $v){ return $this->$k = $v; }
   }

   // Clase que contendra todos los metodos necesarios para la gestión de la tabla
class PaisModel { 
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
 
    //Metodo para obtener todos los paises de un mundo concreto
    public function Listar($CodMundo)
    {
        try
        {
            $result = array();
 
            $stm = $this->pdo->prepare("SELECT * FROM Pais WHERE Codigo_Mundo=?");
            $stm->execute(array($CodMundo));
 
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Pais();
 
                $alm->__SET('Codigo', $r->Codigo);
                $alm->__SET('Nombre', $r->Nombre);
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
	
    //Metodo de devuelve la lista de todos los paises de un mundo concreto
	 public function ListarPaisMundo($Codigo_Mundo)
    {
        try
        {
            $result = array();
		if (is_null($Codigo_Mundo))
		{
			$stm = $this->pdo->prepare(" SELECT * FROM Pais WHERE Codigo_Mundo = ( SELECT Codigo 	FROM Mundo	LIMIT 1 ) ");
			$stm->execute();
		}
		else
		{
			$stm = $this->pdo->prepare("SELECT * FROM Pais WHERE Codigo_Mundo=?");
			 $stm->execute(array($Codigo_Mundo));
		}
           
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Pais();
 
                $alm->__SET('Codigo', $r->Codigo);
                $alm->__SET('Nombre', $r->Nombre);
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
 
    //Metodo que devuelve un pais concreto facilitando un códog y un mundo
    public function Obtener($Codigo,$Codigo_Mundo)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM Pais WHERE Codigo = ? and Codigo_Mundo = ?");
                       
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
            $r = $stm->fetch(PDO::FETCH_OBJ);
 
            $alm = new Pais();
 
            $alm->__SET('Codigo', $r->Codigo);
            $alm->__SET('Nombre', $r->Nombre);
			$alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);
 
 
            return $alm;
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    //Metodo para eliminar un pais de un mundo concreto
    public function Eliminar($Codigo,$Codigo_Mundo)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("DELETE FROM Pais WHERE Codigo = ? and Codigo_Mundo = ?");                   
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
//Metodo para actualizar un pais concreto
    public function Actualizar(Pais $data,$codigo_viejo)
    {
        try
        {
            $sql = "UPDATE Pais SET 
                        Nombre  = ?
                    WHERE Codigo = ? AND Codigo_Mundo = ?";
 
            $this->pdo->prepare($sql)
                 ->execute(
                array(
                    $data->__GET('Nombre'), 
                    $data->__GET('Codigo'),
                    $data->__GET('Codigo_Mundo')
                    )
                );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    //Metodo para crear un pais de un mundo concreto
    public function Registrar(Pais $data)
    {
        try
        {
        $sql = "INSERT INTO Pais (Codigo_Mundo,Codigo,Nombre) 
                VALUES (?,?,?)";
 
        $this->pdo->prepare($sql)
             ->execute(
            array(
				$data->__GET('Codigo_Mundo'), 
				createGUID(), 
                $data->__GET('Nombre'), 
                )
            );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
	
	
	
}
?>