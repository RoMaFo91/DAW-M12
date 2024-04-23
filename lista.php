
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
if (isset($_SESSION['login_correct'])) {
//Comprobamos que el usuario es valido
if (ComprobarSession($_SESSION['user'],$_SESSION['pass']))
{
	//Comprobamos si las variables de código de mundo y nombre de mundo estan llenas
	if (isset($_GET["Nom"]) && isset($_GET["Cod"]))
	{
		$_SESSION['CodMundo']=$_GET["Cod"];
		$_SESSION['NomMundo']=$_GET["Nom"];
	}
	?>		
	<?php 
	//Revisamos el nivel de autorización que tiene el usuario que a realizad login y filtramos los
	//puntos de menu segun el nivel
	//Lista de modelos disponibles para usuario con nivel superior de seguridad 100
	if ($_SESSION['level']>=100) 
	{
		?>
		<li><a href="index.php?model=userg&type=form">Gestión Usuarios</a></li>
		<?php 
	} 
	//Este punto es para que el usuario no administrador pueda ver y cambiar su usuario
	else
	{
		?>
		<li><a href="index.php?model=userg&type=form&action=editar&Codigo=<?php echo $_SESSION['user']; ?>&Codigo_Mundo=<?php echo $_SESSION['CodMundo']; ?>">Gestión Usuarios</a></li>
		<?php 
	}
	//Lista de modelos disponibles para usuario con nivel superior de seguridad 50
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
			<li><a href="index.php?model=pais&type=form">Gestión Pais</a></li>
			<li><a href="index.php?model=lugar&type=form">Gestión Lugar</a></li>
			
		<?php
	}
	//Lista de modelos disponibles para usuario con nivel superior de seguridad 1
	if ($_SESSION['level']>=1) 
	{
		?>
			<li><a href="index.php?model=personaje&type=form">Gestión Personaje</a></li>
		<?php
	}
}
else
{
	//En el caso de intentar entrar en la web sin estar login te envia a index.php
	//header('Location: index.php');
}
}
}
?>