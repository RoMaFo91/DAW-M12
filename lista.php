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
	?>
			<li><a href="index.php?model=raza&type=form">Gestión Raza</a></li>
			<li><a href="index.php?model=dados&type=form">Gestión Dados</a></li>
			<li><a href="index.php?model=atributos&type=form">Gestión Atributos</a></li>
			<li><a href="index.php?model=caracteristicas&type=form">Gestión Caracteristicas</a></li>
			<li><a href="index.php?model=tipomonstruo&type=form">Gestión Tipo Monstruo</a></li>
			<li><a href="index.php?model=clase&type=form">Gestión Clase</a></li>
			<li><a href="index.php?model=subclase&type=form">Gestión Subclase</a></li>
			<li><a href="index.php?model=nivel&type=form">Gestión Nivel</a></li>
			<li><a href="index.php?model=monstruo&type=form">Gestión Monstruo</a></li>
			<li><a href="index.php?model=estado&type=form">Gestión Estado</a></li>
			<li><a href="index.php?model=habilidades&type=form">Gestión Habilidades</a></li>
			<li><a href="index.php?model=traduccion&type=form">Gestión Traduccion (mantenimiento)</a></li>			  
		<?php
}
else
{
	header('Location: index.php');
}
}
?>