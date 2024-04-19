<?php
function ComprobarSession($Cod,$Pass)
    {
		$salt='$2017=(rmf)(dps)$(06-10)/(01-04-2024)$';
		$Codigo='';
		$Password='';
		$conf = new Conf_BD();
		try 
			{ 
		$pdo = new PDO('mysql:host='.$conf->GetServer().';dbname='.$conf->GetBD(), $conf->GetUser(), $conf->GetPass());
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);              
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
			$result = array();
 
            $stm = $pdo->prepare("SELECT * FROM Master WHERE Codigo = ?");
            $stm->execute(array($Cod));
            $r = $stm->fetch(PDO::FETCH_OBJ);				
				$Codigo=$r->Codigo;
				$Password=$r->Passwrod;
				$Cod_mundo=$r->Codigo_Mundo;
		
		//session_start();
			if ($Cod == $Codigo && (crypt($Pass,$salt)==$Password))
			{
				if($_SESSION['CodMundo']=='')
				{
					$_SESSION['CodMundo']=$Cod_mundo;
				}
				
				return true;
			}
			else
			{
				return false;
			}
    }
?>