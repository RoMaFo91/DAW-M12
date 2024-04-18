<?php
session_start();
require_once('./../classes.php');

if (ComprobarSession($_SESSION['user'],$_SESSION['pass']) && isset($_REQUEST["Tabla"]))
{
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
			if ($_REQUEST["Tabla"]=='')
			{
				 $sql ="SHOW COLUMNS FROM ".$_REQUEST["Tabla"];
			}
			else
			{
            $sql ="SHOW COLUMNS FROM ".$_REQUEST["Tabla"];
			}

			$stm = $pdo->prepare($sql);
			$stm->execute(array(':id' => $_REQUEST["Tabla"]));
			
			 header('Content-Type: application/json');
            print_r( json_encode ( $stm->fetchAll(PDO::FETCH_ASSOC) ) );
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
		
}	
	
?>