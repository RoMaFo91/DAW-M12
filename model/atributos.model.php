<?php


//Clase que es una representanción de la tabla de la base de datos
class Atributos {
 
    private $Codigo_Mundo;
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

//Clase que contendra todos los metodos para la gestión de la tabla
class AtributosModel { 
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
 
    // Metodo que devuelve un listado de todos los atributos de un mundo concreto
    public function Listar($CodigoMundo)
    {
        try
        {
            $result = array();
 
            $stm = $this->pdo->prepare("SELECT * FROM Atributos WHERE Codigo_Mundo=?");
            $stm->execute(array($CodigoMundo));
 
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Atributos();
 
                $alm->__SET('Codigo', $r->Codigo);
				$alm->__SET('Nombre', $r->Nombre);
				$alm->__SET('Descripcion', $r->Descripcion);
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
	
    // Metodo que devuelve un listado de todos los atributos de un mundo concreto
	 public function ListarAtributosMundo($Codigo_Mundo)
    {
        try
        {
            $result = array();
		if (is_null($Codigo_Mundo))
		{
			$stm = $this->pdo->prepare(" SELECT * FROM Atributos WHERE Codigo_Mundo = ( SELECT Codigo 	FROM Mundo	LIMIT 1 ) ");
			$stm->execute();
		}
		else
		{
			$stm = $this->pdo->prepare("SELECT * FROM Atributos WHERE Codigo_Mundo=?");
			 $stm->execute(array($Codigo_Mundo));
		}
           
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Atributos();
 
                $alm->__SET('Codigo', $r->Codigo);
				$alm->__SET('Nombre', $r->Nombre);
				$alm->__SET('Descripcion', $r->Descripcion);
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
 
    // Metodo que devuelve un atributo filtrado por código de un mundo concreto
    public function Obtener($Codigo,$Codigo_Mundo)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM Atributos WHERE Codigo = ? and Codigo_Mundo = ?");
                       
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
            $r = $stm->fetch(PDO::FETCH_OBJ);
 
            $alm = new Atributos();
 
            $alm->__SET('Codigo', $r->Codigo);
			$alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);
			$alm->__SET('Nombre', $r->Nombre);
			$alm->__SET('Descripcion', $r->Descripcion);
 
 
            return $alm;
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    //Metodo para eliminar un atributo de un mundo concreto
    public function Eliminar($Codigo,$Codigo_Mundo)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("DELETE FROM Atributos WHERE Codigo = ? and Codigo_Mundo = ?");                   
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    //Metodo para actualizar un atributo concreto de un mundo concreto
    // Los parametros es un representación del objeto a actualizar
    public function Actualizar(Atributos $data,$codigo_viejo)
    {
        try
        {
            $sql = "UPDATE Atributos SET 
						Codigo			= ?,
						Codigo_Mundo = ?,
						Nombre = ?,
						Descripcion = ?
                    WHERE Codigo = ? AND Codigo_Mundo = ?";
 
            $this->pdo->prepare($sql)
                 ->execute(
                array(
					$data->__GET('Codigo'), 
					$data->__GET('Codigo_Mundo'), 
					$data->__GET('Nombre'), 
					$data->__GET('Descripcion'), 
                    $codigo_viejo,
                    $data->__GET('Codigo_Mundo')
                    )
                );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    //Metodo para crear un atributo en un mundo concreto
    public function Registrar(Atributos $data)
    {
        try
        {
        $sql = "INSERT INTO Atributos (Codigo_Mundo,Codigo,Nombre,Descripcion) 
                VALUES (?,?, ?,?)";
 
        $this->pdo->prepare($sql)
             ->execute(
            array(
				$data->__GET('Codigo_Mundo'), 
				createGUID(), 
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