<?php
require_once('./../classes.php');

// Publicación de los datos a traves de webservice que pueden ser consumidos por cualquier cliente REST
	try { 
			$conf = new Conf_BD();
			$pdo = new PDO('mysql:host='.$conf->GetServer().';dbname='.$conf->GetBD(), $conf->GetUser(), $conf->GetPass());
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);              
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
	try
        {
			$sql ="";
            $result = array();
			if ($_REQUEST["codigo_mundo"]=='')
			{
				 $sql = "
                SELECT SubClase.Codigo,CONCAT(Clase.Nombre, ' ', SubClase.Nombre) as Nombre
					FROM SubClase
					JOIN Clase on SubClase.Codigo_Clase=Clase.Codigo
					WHERE SubClase.Codigo_Mundo = ( 
					SELECT Codigo
					FROM Mundo
					LIMIT 1 ) 
            ";
			}
			else
			{
            $sql = "
                SELECT SubClase.Codigo,CONCAT(Clase.Nombre, ' ', SubClase.Nombre) as Nombre
				FROM SubClase
				JOIN Clase on SubClase.Codigo_Clase=Clase.Codigo
				WHERE SubClase.Codigo_Mundo =  :id
            ";
			}
			$stm = $pdo->prepare($sql);
			$stm->execute(array(':id' => $_REQUEST["codigo_mundo"]));
			
			 header('Content-Type: application/json');
            print_r( json_encode ( $stm->fetchAll(PDO::FETCH_ASSOC) ) );
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
		
// }	
	
?>