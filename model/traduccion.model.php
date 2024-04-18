<?php
//require('./../conf_bd.php');
//require_once('./../classes.php');


class TraduccionModel { 
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
 
    public function Listar()
    {
        try
        {
            $result = array();
 
            $stm = $this->pdo->prepare("SELECT * FROM Traduccion");
            $stm->execute();
 
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Traduccion();
 
                $alm->__SET('Tabla', $r->Tabla);
				$alm->__SET('PrimaryKey', $r->PrimaryKey);
				$alm->__SET('Campo', $r->Campo);
				$alm->__SET('Parte', $r->Parte);
				$alm->__SET('Texto', $r->Texto);
				$alm->__SET('Codigo_Idioma	', $r->Codigo_Idioma);
				
 
                $result[] = $alm;
            }
 
            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
 
    public function Obtener($Tabla,$PrimaryKey,$Campo,$Parte,$Codigo_Idioma)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM Traduccion WHERE Tabla = ? and PrimaryKey = ? and Campo = ? and Parte = ? and Codigo_Idioma = ?");
                       
 
            $stm->execute(array($Tabla,$PrimaryKey,$Campo,$Parte,$Codigo_Idioma));
            $r = $stm->fetch(PDO::FETCH_OBJ);
 
            $alm = new Traduccion();
 
            $alm->__SET('Tabla', $r->Tabla);
			$alm->__SET('PrimaryKey', $r->PrimaryKey);
			$alm->__SET('Campo', $r->Campo);
			$alm->__SET('Parte', $r->Parte);
			$alm->__SET('Texto', $r->Texto);
			$alm->__SET('Codigo_Idioma	', $r->Codigo_Idioma);
 
 
            return $alm;
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Eliminar($Tabla,$PrimaryKey,$Campo,$Parte,$Codigo_Idioma)
    {
        try
        {
            $stm = $this->pdo
                      ->prepare("DELETE FROM Traduccion WHERE Tabla = ? and PrimaryKey = ? and Campo = ? and Parte = ? and Codigo_Idioma = ?");                   
 
            $stm->execute(array($Codigo,$Codigo_Mundo));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Actualizar(Traduccion $data,$TablaViejo,$PrimaryKeyViejo,$CampoViejo,$ParteViejo,$Codigo_IdiomaViejo)
    {
        try
        {
            $sql = "UPDATE Traduccion SET 
						Tabla = ?,
						PrimaryKey = ?,
						Campo = ?,
						Parte = ?,
						Codigo_Idioma = ?,
						Texto = ?
                    WHERE Tabla = ? and PrimaryKey = ? and Campo = ? and Parte = ? and Codigo_Idioma = ?";
 
            $this->pdo->prepare($sql)
                 ->execute(
                array(
					$data->__GET('Tabla'), 
					$data->__GET('PrimaryKey'), 
					$data->__GET('Campo'), 
					$data->__GET('Parte'), 
					$data->__GET('Codigo_Idioma'), 
					$data->__GET('Texto'), 
                    $TablaViejo,$PrimaryKeyViejo,$CampoViejo,$ParteViejo,$Codigo_IdiomaViejo
                    )
                );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
 
    public function Registrar(Traduccion $data)
    {
        try
        {
        $sql = "INSERT INTO Traduccion (
						Tabla ,
						PrimaryKey ,
						Campo ,
						Parte ,
						Codigo_Idioma ,
						Texto 
		) 
                VALUES (?,?, ?,?,?,?)";
 
        $this->pdo->prepare($sql)
             ->execute(
            array(
				$data->__GET('Tabla'), 
					$data->__GET('PrimaryKey'), 
					$data->__GET('Campo'), 
					$data->__GET('Parte'), 
					$data->__GET('Codigo_Idioma'), 
					$data->__GET('Texto'), 
                )
            );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
	
	
	
}
?>