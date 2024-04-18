<br/>
<?php
if(session_status() == PHP_SESSION_ACTIVE)
{
require_once('classes.php');
//require(getcwd().'/conf_bd.php');
//require(getcwd().'/validar.php'); 

if (ComprobarSession($_SESSION['user'],$_SESSION['pass']))
{
	if (isset($_GET["Nom"]) && isset($_GET["Cod"]))
	{
		$_SESSION['CodMundo']=$_GET["Cod"];
		$_SESSION['NomMundo']=$_GET["Nom"];
	}
	echo $_SESSION['NomMundo'];
	?>
<br/>
<br/>

			<li><a href="index.php?model=raza&type=form">Crear Raza</a></li>
			<li><a href="index.php?model=dados&type=form">Crear Dados</a></li>
			<li><a href="index.php?model=atributos&type=form">Crear Atributos</a></li>
			<li><a href="./controller/caracteristicas.controller.php">Crear Caracteristicas</a></li>
			<li><a href="./controller/tipomonstruo.controller.php">Crear Tipo Monstruo</a></li>
			<li><a href="./controller/clase.controller.php">Crear Clase</a></li>
			<li><a href="./controller/subclase.controller.php">Crear Subclase</a></li>
			<li><a href="./controller/nivel.controller.php">Crear Nivel</a></li>
			<li><a href="./controller/monstruo.controller.php">Crear Monstruo</a></li>
			<li><a href="./controller/estado.controller.php">Crear Estado</a></li>
			<li><a href="./controller/habilidades.controller.php">Crear Habilidades</a></li>
			<li><a href="./controller/traduccion.controller.php">Crear Traduccion (mantenimiento)</a></li>			  
		<?php
}
else
{
	header('Location: index.php');
}
}
?>