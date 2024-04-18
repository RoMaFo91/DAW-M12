<?php
session_start();
require_once('classes.php');
$model = new MundoModel(); 
//require(getcwd().'/conf_bd.php');
//require(getcwd().'/validar.php'); 

if (ComprobarSession($_SESSION['user'],$_SESSION['pass']))
{
	?>
		<html>
		<body>
		<h1>Welcome <?php echo $_SESSION['user']; ?></h1>
		</br></br>
		<a href="index.php?Desc=desc">Desconectar</a>
		</br></br>
		<ul>
			<h1><li><a href="./controller/mundo.controller.php">Crear_Mundo</a></li></h1>
		    <?php foreach($model->Listar() as $r): ?>
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