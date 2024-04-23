<?php
require_once('./../classes.php');

// http://localhost/webserice/getClase.php?codigo_mundo=971BBEBA-BE42-C92C-08CF-2A4F535F7022
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
                SELECT Codigo, Nombre
					FROM Clase
					WHERE Codigo_Mundo = ( 
					SELECT Codigo
					FROM Mundo
					LIMIT 1 ) 
            ";
			}
			else
			{
				$sql = "
					SELECT Codigo,Nombre
					FROM Clase
					WHERE Codigo_Mundo =  :id
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