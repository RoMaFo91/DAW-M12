<?php
//Clase para la gestión de la tabla estado/atributo, 
//esta tabla es la conexión entre estado y atributo a nivel relacional
class Estado_Atributo {
 
    private $Codigo_Estado;
    private $Codigo_Estado_Mundo;
    private $Codigo_Atributo_Mundo;
    private $Codigo_Atributo;
    private $Valor;
    private $Estado;
    
    public function name()
    {
        return $this->Nombre;
    }
    
    public function __GET($k){ return $this->$k; }
       public function __SET($k, $v){ return $this->$k = $v; }
   }
    

   //Clase que contiene todos los metodos para la gestión de la tabla
class Estado_AtributoModel { 
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
 
    //Metodo que devuelve un listado de todos los atributos de un estado concreto y un mundo concreto
    public function Listar($Codigo_Mundo,$Codigo_Estado)
    {
        try
        {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM Atributos T0 LEFT JOIN Estado_Atributo T1 on T0.Codigo_Mundo=T1.Codigo_Atributo_Mundo and T0.Codigo=T1.Codigo_Atributo and T1.Codigo_Estado=? and T1.Codigo_Estado_Mundo=? WHERE T0.Codigo_Mundo=?");
            $stm->execute(array($Codigo_Estado,$Codigo_Mundo,$Codigo_Mundo));
 
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Estado_Atributo();
				
				$alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);
                $alm->__SET('Codigo', $r->Codigo);
				$alm->__SET('Nombre', $r->Nombre);
				
				$alm->__SET('Codigo_Atributo', $r->Codigo_Atributo);
				$alm->__SET('Codigo_Atributo_Mundo', $r->Codigo_Atributo_Mundo);
				$alm->__SET('Codigo_Estado', $r->Codigo_Estado);
				$alm->__SET('Codigo_Estado_Mundo', $r->Codigo_Estado_Mundo);
				
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
	

//Metodo para comprovar si existe un estado/atributo concreto
	public function ComprovarExiste(Estado_Atributo $data)
	{
	 try
        {
            $stm = $this->pdo
                      ->prepare("SELECT count(*) as 'cantidad' FROM Estado_Atributo WHERE Codigo_Estado = ? and Codigo_Estado_Mundo = ? and Codigo_Atributo=? and Codigo_Atributo_Mundo=?");
                       
 
            $stm->execute(array(
					$data->__GET('Codigo_Estado'), 
					$data->__GET('Codigo_Estado_Mundo'), 
					$data->__GET('Codigo_Atributo'), 
					$data->__GET('Codigo_Atributo_Mundo')));
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
 
    //Metodo para eliminar un registro concreto
    public function Eliminar($Codigo,$Codigo_Mundo)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("DELETE FROM Estado_Atributo WHERE Codigo_Estado = ? and Codigo_Estado_Mundo = ?");                   
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    //Metodo para actualizar un registro concreto de la tabla de estado atributo
    public function Actualizar(Estado_Atributo $data)
    {
        try
        {
			if ($this->ComprovarExiste($data))
			{
            $sql = "UPDATE Estado_Atributo SET 
						Valor			= ?
                    WHERE Codigo_Estado = ? and Codigo_Estado_Mundo=? and Codigo_Atributo=? and Codigo_Atributo_Mundo=?";
 
            $this->pdo->prepare($sql)
                 ->execute(
                array(
					$data->__GET('Valor'), 
					$data->__GET('Codigo_Estado'), 
					$data->__GET('Codigo_Estado_Mundo'), 
					$data->__GET('Codigo_Atributo'), 
					$data->__GET('Codigo_Atributo_Mundo')
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
 
    //Metodo para crear un registro en la tabla de estado atributo
    public function Registrar(Estado_Atributo $data)
    {
        try
        {
        $sql = "INSERT INTO Estado_Atributo (Codigo_Estado,	Codigo_Estado_Mundo,	Codigo_Atributo_Mundo,	Codigo_Atributo ,Valor) 
                VALUES (?, ?, ?, ?, ?)";
 
        $this->pdo->prepare($sql)
             ->execute(
            array(
				$data->__GET('Codigo_Estado'), 
				$data->__GET('Codigo_Estado_Mundo'), 
				$data->__GET('Codigo_Atributo_Mundo'),
				$data->__GET('Codigo_Atributo'),
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