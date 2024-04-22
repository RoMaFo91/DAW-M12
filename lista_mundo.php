<?php
session_start();
require_once('classes.php');
$model = new MundoModel(); 


//Comprobamos que el usuario esta login en el caso que no se enviara a index.php
if (ComprobarSession($_SESSION['user'],$_SESSION['pass']))
{
	// Esta pagina carga una lista de los mundos disponibles para poder realizar acciones
	?>
		<html>
		<body>
		<h1>Welcome <?php echo $_SESSION['user']; ?></h1>
		</br></br>
		<a href="index.php?Desc=desc">Desconectar</a>
		</br></br>
		<ul>
			<h1><li><a href="./controller/mundo.controller.php">Crear_Mundo</a></li></h1>
		    <?php 
			if ($_SESSION['level']<100) 
			{
				$lista=$model->Listar_User($_SESSION['user']);
			}
			else
			{
				$lista=$model->Listar();
			}		
			foreach($lista as $r): ?>
				<h1><li><a href="lista.php?Cod=<?php echo $r->__GET('Codigo'); ?>&Nom=<?php echo $r->__GET('Nombre'); ?>"><?php echo $r->__GET('Codigo'); ?> - <?php echo $r->__GET('Nombre'); ?></a></li></h1>
            <?php endforeach; ?>	
		</ul>
		</body>
		</html>
		<?php
}
else
{
	header('Location: index.php');
}

?>