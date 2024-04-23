<?php
//Clase que representa la tabla de monstruos/caracteristica y sus campos
//esta tabla es la relación entra las dos tablas de N a M
class Monstruo_Caracteristicas {
 
    private $Codigo_Monstruo;
    private $Codigo_Monstruo_Mundo;
    private $Codigo_Caracteristicas_Mundo;
    private $Codigo_Caracteristicas;
    private $Valor;
    private $Estado;
    
    public function __GET($k){ return $this->$k; }
       public function __SET($k, $v){ return $this->$k = $v; }
   }

   //Clase que contendra todos los metodos para la gestión de la tabla
class Monstruo_CaracteristicasModel { 
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
 
    //Metodo que devuelve todos las caracteristicas de un monstruo concreto y de un mundo concreto
    public function Listar($Codigo_Mundo,$Codigo_Monstruo)
    {
        try
        {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM Caracteristicas T0 LEFT JOIN Monstruo_Caracteristicas T1 on T0.Codigo_Mundo=T1.Codigo_Caracteristicas_Mundo and T0.Codigo=T1.Codigo_Caracteristicas and T1.Codigo_Monstruo=? and T1.Codigo_Monstruo_Mundo=? WHERE T0.Codigo_Mundo=?");
            $stm->execute(array($Codigo_Monstruo,$Codigo_Mundo,$Codigo_Mundo));
 
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Monstruo_Caracteristicas();
				
				$alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);
                $alm->__SET('Codigo', $r->Codigo);
				$alm->__SET('Nombre', $r->Nombre);
				
				$alm->__SET('Codigo_Caracteristicas', $r->Codigo_Caracteristicas);
				$alm->__SET('Codigo_Caracteristicas_Mundo', $r->Codigo_Caracteristicas_Mundo);
				$alm->__SET('Codigo_Monstruo', $r->Codigo_Monstruo);
				$alm->__SET('Codigo_Monstruo_Mundo', $r->Codigo_Monstruo_Mundo);
				
				$alm->__SET('Valor', $r->Valor);
 
                $result[] = $alm;
            }
 
            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

	//Metodo que comprueva la existencia de un monstruo y una caracteristica concreta
	public function ComprovarExiste(Monstruo_Caracteristicas $data)
	{
	 try
        {
            $stm = $this->pdo
                      ->prepare("SELECT count(*) as 'cantidad' FROM Monstruo_Caracteristicas WHERE Codigo_Monstruo = ? and Codigo_Monstruo_Mundo = ? and Codigo_Caracteristicas=? and Codigo_Caracteristicas_Mundo=?");
                       
 
            $stm->execute(array(
					$data->__GET('Codigo_Monstruo'), 
					$data->__GET('Codigo_Monstruo_Mundo'), 
					$data->__GET('Codigo_Caracteristicas'), 
					$data->__GET('Codigo_Caracteristicas_Mundo')));
            $r = $stm->fetch(PDO::FETCH_OBJ);
			if ($r->cantidad>0)
			{
				return true;
			}
			else
			{
				return false;
			}
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
	}
 
    //Metodo para la eliminación de un registro de la tabla
    public function Eliminar($Codigo,$Codigo_Mundo)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("DELETE FROM Monstruo_Caracteristicas WHERE Codigo_Monstruo = ? and Codigo_Monstruo_Mundo = ?");                   
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    //Metodo para a la actualización de un registro concreto de la tabla
    public function Actualizar(Monstruo_Caracteristicas $data)
    {
        try
        {
			if ($this->ComprovarExiste($data))
			{
            $sql = "UPDATE Monstruo_Caracteristicas SET 
						Valor			= ?
                    WHERE Codigo_Monstruo = ? and Codigo_Monstruo_Mundo=? and Codigo_Caracteristicas=? and Codigo_Caracteristicas_Mundo=?";
 
            $this->pdo->prepare($sql)
                 ->execute(
                array(
					$data->__GET('Valor'), 
					$data->__GET('Codigo_Monstruo'), 
					$data->__GET('Codigo_Monstruo_Mundo'), 
					$data->__GET('Codigo_Caracteristicas'), 
					$data->__GET('Codigo_Caracteristicas_Mundo')
                    )
                );
			}
			else
			{
				$this->Registrar($data);
			}
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    //Metodo para la creación de un registro en la tabla
    public function Registrar(Monstruo_Caracteristicas $data)
    {
        try
        {
        $sql = "INSERT INTO Monstruo_Caracteristicas (Codigo_Monstruo,	Codigo_Monstruo_Mundo,	Codigo_Caracteristicas_Mundo,	Codigo_Caracteristicas ,Valor) 
                VALUES (?, ?, ?, ?, ?)";
 
        $this->pdo->prepare($sql)
             ->execute(
            array(
				$data->__GET('Codigo_Monstruo'), 
				$data->__GET('Codigo_Monstruo_Mundo'), 
				$data->__GET('Codigo_Caracteristicas_Mundo'),
				$data->__GET('Codigo_Caracteristicas'),
				$data->__GET('Valor'),
                )
            );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
	
	
	
}
?>