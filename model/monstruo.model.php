<?php
//require('./../conf_bd.php');
//require_once('./../classes.php');
class Monstruo {
 
    private $Codigo_Mundo;
    private $Codigo;
    private $Nombre;
    private $Sexo;
    private $ESPNJ;
    private $Codigo_Nivel;
    private $Codigo_Nivel_Mundo;
    private $Codigo_SubClase;
    private $Codigo_SubClase_Mundo;
     private $Codigo_Tipo_Mons;
    private $Codigo_Tipo_Mons_Mundo;
    private $Estado;
    
    public function __GET($k){ return $this->$k; }
       public function __SET($k, $v){ return $this->$k = $v; }
   }
 
   
class MonstruoModel { 
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
 
    public function Listar($CodMundo)
    {
        try
        {
            $result = array();
 
            $stm = $this->pdo->prepare("SELECT * FROM Monstruo WHERE Codigo_Mundo=?");
            $stm->execute(array($CodMundo));
 
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Monstruo();
 
                $alm->__SET('Codigo', $r->Codigo);
				$alm->__SET('Nombre', $r->Nombre);
				$alm->__SET('Sexo', $r->Sexo);
				$alm->__SET('ESPNJ', $r->ESPNJ);
				$alm->__SET('Codigo_Nivel', $r->Codigo_Nivel);
				$alm->__SET('Codigo_SubClase', $r->Codigo_SubClase);
				$alm->__SET('Codigo_Tipo_Mons', $r->Codigo_Tipo_Mons);
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
 
    public function Obtener($Codigo,$Codigo_Mundo)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM Monstruo WHERE Codigo = ? and Codigo_Mundo = ?");
                       
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
            $r = $stm->fetch(PDO::FETCH_OBJ);
 
            $alm = new Monstruo();
 
            $alm->__SET('Codigo', $r->Codigo);
			$alm->__SET('Nombre', $r->Nombre);
			$alm->__SET('Sexo', $r->Sexo);
			$alm->__SET('ESPNJ', $r->ESPNJ);
			$alm->__SET('Codigo_Nivel', $r->Codigo_Nivel);
			$alm->__SET('Codigo_Nivel_Mundo', $r->Codigo_Nivel_Mundo);
			$alm->__SET('Codigo_SubClase', $r->Codigo_SubClase);
			$alm->__SET('Codigo_SubClase_Mundo', $r->Codigo_SubClase_Mundo);
			$alm->__SET('Codigo_Tipo_Mons', $r->Codigo_Tipo_Mons);
			$alm->__SET('Codigo_Tipo_Mons_Mundo', $r->Codigo_Tipo_Mons_Mundo);
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
                      ->prepare("DELETE FROM Monstruo WHERE Codigo = ? and Codigo_Mundo = ?");                   
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Actualizar(Monstruo $data,$codigo_viejo)
    {
        try
        {
            $sql = "UPDATE Monstruo SET 
						Codigo			= ?,
						Nombre = ?,
						Sexo = ?,
						Codigo_Nivel = ?,
						Codigo_Nivel_Mundo = ?,
						Codigo_SubClase = ?,
						Codigo_SubClase_Mundo = ?,
						Codigo_Tipo_Mons = ?,
						Codigo_Tipo_Mons_Mundo = ?,
						Codigo_Mundo = ?,
						ESPNJ = ?
                    WHERE Codigo = ?";
            $this->pdo->prepare($sql)
                 ->execute(
                array(
					$data->__GET('Codigo'), 
					$data->__GET('Nombre'), 
					$data->__GET('Sexo'), 
					$data->__GET('Codigo_Nivel'), 
					$data->__GET('Codigo_Nivel_Mundo'),
					$data->__GET('Codigo_SubClase'), 
					$data->__GET('Codigo_SubClase_Mundo'), 
					$data->__GET('Codigo_Tipo_Mons'), 					
					$data->__GET('Codigo_Tipo_Mons_Mundo'), 	
					$data->__GET('Codigo_Mundo'), 
					$data->__GET('ESPNJ'), 
                    $codigo_viejo
                    )
                );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Registrar(Monstruo $data)
    {
        try
        {
			
        $sql = "INSERT INTO Monstruo (Codigo_Mundo,Codigo,Nombre,Sexo,Codigo_Nivel,Codigo_Nivel_Mundo,Codigo_SubClase,Codigo_SubClase_Mundo,Codigo_Tipo_Mons,Codigo_Tipo_Mons_Mundo,ESPNJ) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?)";
 
        $this->pdo->prepare($sql)
             ->execute(
            array(
				$data->__GET('Codigo_Mundo'), 
				$data->__GET('Codigo'),
				$data->__GET('Nombre'),
				$data->__GET('Sexo'), 
				$data->__GET('Codigo_Nivel'),
				$data->__GET('Codigo_Nivel_Mundo'), 
				$data->__GET('Codigo_SubClase'),
				$data->__GET('Codigo_SubClase_Mundo'), 				
				$data->__GET('Codigo_Tipo_Mons'),
				$data->__GET('Codigo_Tipo_Mons_Mundo'),
				$data->__GET('ESPNJ')
                )
            );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
}
?>