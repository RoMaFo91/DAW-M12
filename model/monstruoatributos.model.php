<?php
//require('./../conf_bd.php');
//require_once('./../classes.php');
class Monstruo_Atributos {
 
    private $Codigo_Monstruo;
    private $Codigo_Monstruo_Mundo;
    private $Codigo_Atributo_Mundo;
    private $Codigo_Atributo;
    private $Valor;
    private $Estado;
    
    public function __GET($k){ return $this->$k; }
       public function __SET($k, $v){ return $this->$k = $v; }
   }
   
class Monstruo_AtributosModel { 
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
 
    public function Listar($Codigo_Mundo,$Codigo_Monstruo)
    {
        try
        {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM Atributos T0 LEFT JOIN Monstruo_Atributos T1 on T0.Codigo_Mundo=T1.Codigo_Atributo_Mundo and T0.Codigo=T1.Codigo_Atributo and T1.Codigo_Monstruo=? and T1.Codigo_Monstruo_Mundo=? WHERE T0.Codigo_Mundo=?");
            $stm->execute(array($Codigo_Monstruo,$Codigo_Mundo,$Codigo_Mundo));
 
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Monstruo_Atributos();
				
				$alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);
                $alm->__SET('Codigo', $r->Codigo);
				$alm->__SET('Nombre', $r->Nombre);
				
				$alm->__SET('Codigo_Atributo', $r->Codigo_Atributo);
				$alm->__SET('Codigo_Atributo_Mundo', $r->Codigo_Atributo_Mundo);
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
	
 /*
    public function Obtener($Codigo,$Codigo_Mundo)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM Monstruo_Atributos WHERE Codigo = ? and Codigo_Mundo = ?");
                       
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
            $r = $stm->fetch(PDO::FETCH_OBJ);
 
            $alm = new Monstruo_Atributos();
 
            $alm->__SET('Codigo', $r->Codigo);
			$alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);
			$alm->__SET('Nombre', $r->Nombre);
 
 
            return $alm;
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 */
	public function ComprovarExiste(Monstruo_Atributos $data)
	{
	 try
        {
            $stm = $this->pdo
                      ->prepare("SELECT count(*) as 'cantidad' FROM Monstruo_Atributos WHERE Codigo_Monstruo = ? and Codigo_Monstruo_Mundo = ? and Codigo_Atributo=? and Codigo_Atributo_Mundo=?");
                       
 
            $stm->execute(array(
					$data->__GET('Codigo_Monstruo'), 
					$data->__GET('Codigo_Monstruo_Mundo'), 
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
 
    public function Eliminar($Codigo,$Codigo_Mundo)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("DELETE FROM Monstruo_Atributos WHERE Codigo_Monstruo = ? and Codigo_Monstruo_Mundo = ?");                   
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Actualizar(Monstruo_Atributos $data)
    {
        try
        {
			if ($this->ComprovarExiste($data))
			{
            $sql = "UPDATE Monstruo_Atributos SET 
						Valor			= ?
                    WHERE Codigo_Monstruo = ? and Codigo_Monstruo_Mundo=? and Codigo_Atributo=? and Codigo_Atributo_Mundo=?";
 
            $this->pdo->prepare($sql)
                 ->execute(
                array(
					$data->__GET('Valor'), 
					$data->__GET('Codigo_Monstruo'), 
					$data->__GET('Codigo_Monstruo_Mundo'), 
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
 
    public function Registrar(Monstruo_Atributos $data)
    {
        try
        {
        $sql = "INSERT INTO Monstruo_Atributos (Codigo_Monstruo,	Codigo_Monstruo_Mundo,	Codigo_Atributo_Mundo,	Codigo_Atributo ,Valor) 
                VALUES (?, ?, ?, ?, ?)";
 
        $this->pdo->prepare($sql)
             ->execute(
            array(
				$data->__GET('Codigo_Monstruo'), 
				$data->__GET('Codigo_Monstruo_Mundo'), 
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