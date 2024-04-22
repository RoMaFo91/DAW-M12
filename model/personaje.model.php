<?php
//require('./../conf_bd.php');
//require_once('./../classes.php');
class Personaje {
 
    private $Codigo_Mundo;
    private $Codigo;
    private $Nombre;
    private $Sexo;
    private $Codigo_Userg;
    private $obj_Codigo_Raza;
    private $Codigo_Raza;
    private $Codigo_Raza_Mundo;
    private $obj_Codigo_Nivel;
    private $Codigo_Nivel;
    private $Codigo_Nivel_Mundo;
    private $obj_Codigo_SubClase;
    private $Codigo_SubClase;
    private $Codigo_SubClase_Mundo;
    private $Estado;
    
    public function name()
    {
        return $this->Nombre;
    }

    public function __GET($k){ return $this->$k; }
       public function __SET($k, $v){ return $this->$k = $v; }
   }
 
   
class PersonajeModel { 
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
 
            $stm = $this->pdo->prepare("SELECT * FROM Personaje WHERE Codigo_Mundo=?");
            $stm->execute(array($CodMundo));
 
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Personaje();
 
                $alm->__SET('Codigo', $r->Codigo);
				$alm->__SET('Nombre', $r->Nombre);
				$alm->__SET('Sexo', $r->Sexo);
				$alm->__SET('Codigo_Userg', $r->Codigo_Userg);
				$alm->__SET('Codigo_Nivel', $r->Codigo_Nivel);
                $alm->__SET('obj_Codigo_Nivel',(new NivelModel())->Obtener($r->Codigo_Nivel,$r->Codigo_Mundo));
				$alm->__SET('Codigo_SubClase', $r->Codigo_SubClase);
                $alm->__SET('obj_Codigo_SubClase',(new SubclaseModel())->Obtener($r->Codigo_SubClase,$r->Codigo_Mundo));
				$alm->__SET('Codigo_Raza', $r->Codigo_Raza);
                $alm->__SET('obj_Codigo_Raza',(new RazaModel())->Obtener($r->Codigo_Raza,$r->Codigo_Mundo));
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

    public function Listar_User($CodMundo,$user)
    {
        try
        {
            $result = array();
 
            $stm = $this->pdo->prepare("SELECT * FROM Personaje WHERE Codigo_Mundo=? AND Codigo_Userg=?");
            $stm->execute(array($CodMundo,$user));
 
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Personaje();
 
                $alm->__SET('Codigo', $r->Codigo);
				$alm->__SET('Nombre', $r->Nombre);
				$alm->__SET('Sexo', $r->Sexo);
				$alm->__SET('Codigo_Userg', $r->Codigo_Userg);
				$alm->__SET('Codigo_Nivel', $r->Codigo_Nivel);
                $alm->__SET('obj_Codigo_Nivel',(new NivelModel())->Obtener($r->Codigo_Nivel,$r->Codigo_Mundo));
				$alm->__SET('Codigo_SubClase', $r->Codigo_SubClase);
                $alm->__SET('obj_Codigo_SubClase',(new SubclaseModel())->Obtener($r->Codigo_SubClase,$r->Codigo_Mundo));
				$alm->__SET('Codigo_Raza', $r->Codigo_Raza);
                $alm->__SET('obj_Codigo_Raza',(new RazaModel())->Obtener($r->Codigo_Raza,$r->Codigo_Mundo));
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
                      ->prepare("SELECT * FROM Personaje WHERE Codigo = ? and Codigo_Mundo = ?");
                       
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
            $r = $stm->fetch(PDO::FETCH_OBJ);
 
            $alm = new Personaje();
 
            $alm->__SET('Codigo', $r->Codigo);
            $alm->__SET('Nombre', $r->Nombre);
            $alm->__SET('Sexo', $r->Sexo);
            $alm->__SET('Codigo_Userg', $r->Codigo_Userg);
            $alm->__SET('Codigo_Nivel', $r->Codigo_Nivel);
            $alm->__SET('Codigo_SubClase', $r->Codigo_SubClase);
            $alm->__SET('Codigo_Raza', $r->Codigo_Raza);
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
                      ->prepare("DELETE FROM Personaje WHERE Codigo = ? and Codigo_Mundo = ?");                   
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Actualizar(Personaje $data)
    {
        try
        {
            $sql = "UPDATE Personaje SET 
						Nombre = ?,
						Sexo = ?,
                        Codigo_Userg = ?,
						Codigo_Nivel = ?,
						Codigo_Nivel_Mundo = ?,
						Codigo_SubClase = ?,
						Codigo_SubClase_Mundo = ?,
						Codigo_Raza = ?,
						Codigo_Raza_Mundo = ?
                    WHERE Codigo = ? AND Codigo_Mundo = ?";
                    echo   $sql;
            $this->pdo->prepare($sql)
                 ->execute(
                array(
					$data->__GET('Nombre'), 
					$data->__GET('Sexo'), 
                    $data->__GET('Codigo_Userg'), 
					$data->__GET('Codigo_Nivel'), 
					$data->__GET('Codigo_Nivel_Mundo'),
					$data->__GET('Codigo_SubClase'), 
					$data->__GET('Codigo_SubClase_Mundo'), 
					$data->__GET('Codigo_Raza'), 					
					$data->__GET('Codigo_Raza_Mundo'), 	
                    $data->__GET('Codigo'),
                    $data->__GET('Codigo_Mundo')
                    )
                );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Registrar(Personaje $data)
    {
        try
        {
			
        $sql = "INSERT INTO Personaje (Codigo_Mundo,Codigo,Nombre,Sexo,Codigo_Userg,Codigo_Nivel,Codigo_Nivel_Mundo,Codigo_SubClase,Codigo_SubClase_Mundo,Codigo_Raza,Codigo_Raza_Mundo) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?)";
 
        $this->pdo->prepare($sql)
             ->execute(
            array(
				$data->__GET('Codigo_Mundo'), 
				createGUID(),
				$data->__GET('Nombre'),
				$data->__GET('Sexo'), 
                $data->__GET('Codigo_Userg'),
				$data->__GET('Codigo_Nivel'),
				$data->__GET('Codigo_Nivel_Mundo'), 
				$data->__GET('Codigo_SubClase'),
				$data->__GET('Codigo_SubClase_Mundo'), 				
				$data->__GET('Codigo_Raza'),
				$data->__GET('Codigo_Raza_Mundo')
                )
            );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
}
?>