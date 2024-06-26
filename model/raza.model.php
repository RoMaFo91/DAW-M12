<?php
//Clase que es una representación de la tabla de raza y sus campos

class Raza {
 
    private $Codigo_Mundo;
    private $Codigo;
    private $Nombre;
    private $Tipo;
    private $Estado;
    
    public function name()
    {
        return $this->Nombre;
    }

    public function __GET($k){ return $this->$k; }
       public function __SET($k, $v){ return $this->$k = $v; }
   }

      // Clase que contendra todos los metodos para la gestión de la tabla
class RazaModel { 
		private $pdo; 
		//Constructor de la clase
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
 
    //Metodo que devuelve un listado de todos las razas de un mundo concreto
    public function Listar($CodMundo)
    {
        try
        {
            $result = array();
 
            $stm = $this->pdo->prepare("SELECT * FROM Raza WHERE Codigo_Mundo=?");
            $stm->execute(array($CodMundo));
 
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Raza();
 
                $alm->__SET('Codigo', $r->Codigo);
				$alm->__SET('Nombre', $r->Nombre);
				$alm->__SET('Tipo', $r->Tipo);
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
	
    //Metodo que devuelve un listado de todos las razas de un mundo concreto
	 public function ListarRazaMundo($Codigo_Mundo)
    {
        try
        {
            $result = array();
		
			$stm = $this->pdo->prepare("SELECT * FROM Raza WHERE Codigo_Mundo=?");
			 $stm->execute(array($Codigo_Mundo));
           
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Raza();
 
                $alm->__SET('Codigo', $r->Codigo);
				$alm->__SET('Nombre', $r->Nombre);
				$alm->__SET('Tipo', $r->Tipo);
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

 //Metodo que obtiene una raza concreto de un mundo concreto
    public function Obtener($Codigo,$Codigo_Mundo)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM Raza WHERE Codigo = ? and Codigo_Mundo = ?");
                       
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
            $r = $stm->fetch(PDO::FETCH_OBJ);
 
            $alm = new Raza();
 
            $alm->__SET('Codigo', $r->Codigo);
			$alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);
			$alm->__SET('Nombre', $r->Nombre);
			$alm->__SET('Tipo', $r->Tipo);
 
 
            return $alm;
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
        //Metodo para eliminar una raza concreto de un mundo concreto
    public function Eliminar($Codigo,$Codigo_Mundo)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("DELETE FROM Raza WHERE Codigo = ? and Codigo_Mundo = ?");                   
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
        //Metodo para actualizar un registro de la tabla
    public function Actualizar(Raza $data,$codigo_viejo)
    {
        try
        {
            $sql = "UPDATE Raza SET 
						Codigo			= ?,
						Codigo_Mundo = ?,
						Nombre = ?,
						Tipo= ?
                    WHERE Codigo = ? AND Codigo_Mundo = ?";
 
            $this->pdo->prepare($sql)
                 ->execute(
                array(
					$data->__GET('Codigo'), 
					$data->__GET('Codigo_Mundo'), 
					$data->__GET('Nombre'), 
					$data->__GET('Tipo'), 
                    $codigo_viejo,
                    $data->__GET('Codigo_Mundo'), 
                    )
                );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
        //Metodo para crear un registro de la tabla
    public function Registrar(Raza $data)
    {
        try
        {
        $sql = "INSERT INTO Raza (Codigo_Mundo,Codigo,Nombre,Tipo) 
                VALUES (?,?, ?,?)";
 
        $this->pdo->prepare($sql)
             ->execute(
            array(
				$data->__GET('Codigo_Mundo'), 
				createGUID(), 
				$data->__GET('Nombre'),
				$data->__GET('Tipo'),
                )
            );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
	
	
	
}
?>