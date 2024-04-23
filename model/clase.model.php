<?php
//Clase que es una representanción de la tabla de la base de datos
class Clase {
 
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

      //Clase que contendra todos los metodos para la gestión de la tabla
class ClaseModel { 
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
 
    // Metodo que devuelve un listado de todas las clases de un mundo concreto
    public function Listar($CodMundo)
    {
        try
        {
            $result = array();
 
            $stm = $this->pdo->prepare("SELECT * FROM Clase WHERE Codigo_Mundo=?");
            $stm->execute(array($CodMundo));
 
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Clase();
 
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
	
    // Metodo que devuelve un listado de todas las clases de un mundo concreto
	 public function ListarClaseMundo($Codigo_Mundo)
    {
        try
        {
            $result = array();
		
			$stm = $this->pdo->prepare("SELECT * FROM Clase WHERE Codigo_Mundo=?");
			 $stm->execute(array($Codigo_Mundo));
		
           
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Clase();
 
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
 
    // Metodo que devuelve una clase concreta donde pasamos por parametro el código de la clase
    // y el código de mundo
    public function Obtener($Codigo,$Codigo_Mundo)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM Clase WHERE Codigo = ? and Codigo_Mundo = ?");
                       
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
            $r = $stm->fetch(PDO::FETCH_OBJ);
 
            $alm = new Clase();
 
            $alm->__SET('Codigo', $r->Codigo);
			$alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);
			$alm->__SET('Nombre', $r->Nombre);
 
 
            return $alm;
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    // Metodo que elimina una clase concreta donde pasamos por parametro el código de la clase
    // y el código de mundo
    public function Eliminar($Codigo,$Codigo_Mundo)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("DELETE FROM Clase WHERE Codigo = ? and Codigo_Mundo = ?");                   
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    // Metodo para actualizar una clase donde pasamos el $data es el contenido de los datos a actualizar
    public function Actualizar(Clase $data,$codigo_viejo)
    {
        try
        {
            $sql = "UPDATE Clase SET 
						Codigo			= ?,
						Codigo_Mundo = ?,
						Nombre = ?
                    WHERE Codigo = ?";
 
            $this->pdo->prepare($sql)
                 ->execute(
                array(
					$data->__GET('Codigo'), 
					$data->__GET('Codigo_Mundo'), 
					$data->__GET('Nombre'), 
                    $codigo_viejo
                    )
                );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    //Metodo para la creación de un elemento de tipo clase
    public function Registrar(Clase $data)
    {
        try
        {
        $sql = "INSERT INTO Clase (Codigo_Mundo,Codigo,Nombre) 
                VALUES (?,?, ?)";
 
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