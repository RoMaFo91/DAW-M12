
<!-- 
	Pagina para cargar los puntos de menu en el apartado de body parte izquierda 
	La pagina se cargara segun el nivel de seguridad que tenga el usuario
	Nivel 1 usuario normal
	Nivel 50 usuario administrador de mundo
	Nivel 100 usuario administrador total

-->

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
	<?php 
	if ($_SESSION['level']>=100) 
	{
		?>
		<li><a href="index.php?model=userg&type=form">Gestión Usuarios</a></li>
		<?php 
	} 
	if ($_SESSION['level']>=50) 
	{
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
	if ($_SESSION['level']>=1) 
	{
		?>
			<li><a href="index.php?model=personaje&type=form">Gestión Personaje</a></li>
		<?php
	}
}
else
{
	header('Location: index.php');
}
}
?>