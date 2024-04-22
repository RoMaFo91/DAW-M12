<?php
//Clase que representa la tabla de lugar

class Lugar {
 
    private $Codigo_Mundo;
    private $Codigo;
    private $Nombre;
    private $obj_Codigo_Pais;
    private $Codigo_Pais;
    private $Codigo_Pais_Mundo;
    private $Estado;
    
    public function name()
    {
        return $this->obj_Codigo_Pais->Nombre .' '. $this->Nombre;
    }


    public function __GET($k){ return $this->$k; }
       public function __SET($k, $v){ return $this->$k = $v; }
   }

   //Clase que tendra todos los metodos de gestión de la tabla de lugar
class LugarModel { 
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
 
    //Metodo que devuelve todos los lugares de un mundo
    public function Listar($CodMundo)
    {
        try
        {
            $result = array();
 
            $stm = $this->pdo->prepare("SELECT * FROM Lugar WHERE Codigo_Mundo=?");
            $stm->execute(array($CodMundo));
 
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Lugar();
 
                $alm->__SET('Codigo', $r->Codigo);
				$alm->__SET('Nombre', $r->Nombre);
				$alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);
                $alm->__SET('obj_Codigo_Pais', (new PaisModel())->Obtener($r->Codigo_Pais,$r->Codigo_Pais_Mundo));
				$alm->__SET('Codigo_Pais', $r->Codigo_Pais);
				$alm->__SET('Codigo_Pais_Mundo', $r->Codigo_Pais_Mundo);
 
                $result[] = $alm;
            }
 
            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
	
    //Metodo para obtener una lista de lugares de un mundo concreto
	public function ListarLugarMundo($codigo)
    {
        try
        {
            $result = array();

		
				$stm = $this->pdo->prepare("SELECT * FROM Lugar WHERE Codigo_Mundo = ?");
				 $stm->execute(array($codigo));
			
 
 
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Lugar();
 
                $alm->__SET('Codigo', $r->Codigo);
				$alm->__SET('Nombre', $r->Nombre);
				$alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);
                $alm->__SET('obj_Codigo_Pais', (new PaisModel())->Obtener($r->Codigo_Pais,$r->Codigo_Pais_Mundo));
				$alm->__SET('Codigo_Pais', $r->Codigo_Pais);
				$alm->__SET('Codigo_Pais_Mundo', $r->Codigo_Pais_Mundo);
 
                $result[] = $alm;
            }
 
            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
 
    //Metodo para obtener un lugar concreto de un mundo concreto
    public function Obtener($Codigo,$Codigo_Mundo)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM Lugar WHERE Codigo = ? and Codigo_Mundo = ?");
                       
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
            $r = $stm->fetch(PDO::FETCH_OBJ);
 
            $alm = new Lugar();
 
            $alm->__SET('Codigo', $r->Codigo);
			$alm->__SET('Nombre', $r->Nombre);
            $alm->__SET('obj_Codigo_Pais', (new PaisModel())->Obtener($r->Codigo_Pais,$r->Codigo_Pais_Mundo));
            $alm->__SET('Codigo_Pais', $r->Codigo_Pais);
            $alm->__SET('Codigo_Pais_Mundo', $r->Codigo_Pais_Mundo);
			$alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);
 
 
            return $alm;
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    //Metodo para eliminación de un lugar concreto
    public function Eliminar($Codigo,$Codigo_Mundo)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("DELETE FROM Lugar WHERE Codigo = ? and Codigo_Mundo = ?");                   
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    //Metodo para la actualización de un lugar concreto
    public function Actualizar(Lugar $data,$codigo_viejo,$codigo_viejo_mundo)
    {
        try
        {
            $sql = "UPDATE Lugar SET 
						Codigo			= ?,
						Nombre = ?,
						Codigo_Mundo = ?,
						Codigo_Pais = ?,
						Codigo_Pais_Mundo=?
                    WHERE Codigo = ? and Codigo_Mundo=?";
			echo "1";
			echo $data->__GET('Codigo_Pais');
			echo "2";
			echo $data->__GET('Codigo_Pais_Mundo');
			echo "3";
			
            $this->pdo->prepare($sql)
                 ->execute(
                array(
					$data->__GET('Codigo'), 
					$data->__GET('Nombre'), 
					$data->__GET('Codigo_Mundo'), 
					$data->__GET('Codigo_Pais'), 
					$data->__GET('Codigo_Pais_Mundo'), 
                    $codigo_viejo,
					$codigo_viejo_mundo,
                    )
                );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    //Metodo para crear un lugar concreto
    public function Registrar(Lugar $data)
    {
        try
        {
        $sql = "INSERT INTO Lugar (Codigo_Mundo,Codigo,Nombre,Codigo_Pais,Codigo_Pais_Mundo) 
                VALUES (?,?, ?,?,?)";
 
        $this->pdo->prepare($sql)
             ->execute(
            array(
				$data->__GET('Codigo_Mundo'), 
				createGUID(), 
				$data->__GET('Nombre'), 
				$data->__GET('Codigo_Pais'), 
				$data->__GET('Codigo_Pais_Mundo'), 
                )
            );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
}
?>