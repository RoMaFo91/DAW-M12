<?php
//require('./../conf_bd.php');
//require_once('./../classes.php');


class GenModel { 
	private $pdo; 
	private $basededades;
	public function __CONSTRUCT() 
	{ 
		$conf = new Conf_BD();
		try { 
		$basededades=$conf->GetBD();
		
		$this->pdo = new PDO('mysql:host='.$conf->GetServer().';dbname='.$conf->GetBD(), $conf->GetUser(), $conf->GetPass());
		//$this->pdo = new PDO('mysql:host=localhost;dbname=id3949160_rfg_v1', 'id3949160_rfg_v1','roger');
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);              
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
    }
 
    public function ListarTabla()
    {
        try
        {
			$conf = new Conf_BD();
            $result = array();
            $stm = $this->pdo->prepare("SHOW FULL TABLES FROM ".$conf->GetBD());
			//$stm = $this->pdo->prepare("111111111");
			
            $stm->execute();
			
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Tabla();
 
                $alm->__SET('Codigo', $r->Tables_in_rolfunga_bd);
                $result[] = $alm;
            }
 
            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
	
	public function ListarCampo($TablaFiltro)
    {
        try
        {
			$result = array();
			
				
				$conf = new Conf_BD();
				
	 if ($TablaFiltro!='')
			{
				$stm = $this->pdo->prepare("SHOW COLUMNS FROM ".$TablaFiltro);
			}
	else
			{
				$stm = $this->pdo->prepare("SHOW COLUMNS FROM Atributos");
			}
				$stm->execute(array($TablaFiltro));
	 
				foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
				{
					$alm = new Campo();
	 
					$alm->__SET('Codigo', $r->Field);
					$result[] = $alm;
				}
			
			return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
	
	
	
}
?>