<?php
// Metodo que crea un registro GUID para poder utilizar en los códigos de las tablas
function createGUID() { 
    
    // Create a token
    $token      = $_SERVER['HTTP_HOST'];
    $token     .= $_SERVER['REQUEST_URI'];
    $token     .= uniqid(rand(), true);
    
    // GUID is 128-bit hex
    $hash        = strtoupper(md5($token));
    
    // Create formatted GUID
    $guid        = '';
    
    // GUID format is XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX for readability    
    $guid .= substr($hash,  0,  8) . 
         '-' .
         substr($hash,  8,  4) .
         '-' .
         substr($hash, 12,  4) .
         '-' .
         substr($hash, 16,  4) .
         '-' .
         substr($hash, 20, 12);
            
    return $guid;

}

//Metodo que valida si el usuario existe y el password es correcto
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
 
            $stm = $pdo->prepare("SELECT * FROM Userg WHERE Codigo = ?");

            $stm->execute(array($Cod));
			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$Codigo=$r->Codigo;
				$Password=$r->Passwrod;
				$Cod_mundo=$r->Codigo_Mundo;
			}		
				
		
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