<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Página Web Moderna</title>
	<link rel="stylesheet" href="css/styles.css">
</head>

<?php
//session_start();

require_once('classes.php');

if (isset($_GET["Desc"])) {
	session_start();
	$_SESSION['user'] = NULL;
	$_SESSION['pass'] = NULL;
}
if (isset($_REQUEST['user']) && isset($_REQUEST['pass'])) {
	session_start();
	$_SESSION['user'] = $_REQUEST['user'];
	$_SESSION['pass'] = $_REQUEST['pass'];
	if (ComprobarSession($_REQUEST['user'], $_REQUEST['pass'])) {
		$_SESSION['login_correct']=True;
		// header('Location: index.php');
		// header('Location: controller/mundo.controller.php');
	} else {
		$_SESSION['login_correct']=False;
		// header('Location: index.php');
	}
} 
?>

	<body>

		<header class="header">
			<div class="container_head">
				<div class="logo">
					<img src="logo.png" alt="Logo" class="logo-img">
				</div>
				<h1>Gestor de mundos</h1>
				<p>Mundos disponibles :</p>
				<nav class="navbar">
					<ul class="nav-list">

						<?php
						if(session_status() == PHP_SESSION_ACTIVE)
						{
						// include('/controller/mundo.controller.php?type=list');
						$type="list";
						require($_SERVER['DOCUMENT_ROOT']."/controller/mundo.controller.php");
						// include($_SERVER['DOCUMENT_ROOT'].'/controller/mundo.controller.php?type=list');
					}
						?>
					</ul>
				</nav>
				<div class="login">
					<a href="#" class="login-link">Iniciar sesión</a>
				</div>
			</div>
		</header>

		<body>
			<div class="contenedor">
				<div class="menu-lateral">
					<!-- Contenido del menú lateral -->
					<ul>
						<?php
						if(session_status() == PHP_SESSION_ACTIVE)
						{
							require($_SERVER['DOCUMENT_ROOT']."/lista.php");
						}
						?>
						<!-- <li><a href="#">Inicio</a></li>
						<li><a href="#">Acerca de</a></li>
						<li><a href="#">Contacto</a></li> -->
					</ul>
				</div>
				<div class="contenido">
					<!-- Contenido principal -->
					<h1>Bienvenido</h1>
					<p>Este es el contenido principal de la página.</p>
<?php

if (isset($_REQUEST['model']))
{
	$model=$_REQUEST['model'];
	$type="form";
	require($_SERVER['DOCUMENT_ROOT']."/controller/".$model.".controller.php");
	echo $_REQUEST['model'];

}


if(session_status() != PHP_SESSION_ACTIVE)
{
?>

					<form action="index.php" method="post">

						<table style="width:500px;">


							<tr>
								<th style="text-align:left;">User</th>
								<td><input type="text" name="user" style="width:100%;" /></td>
							</tr>
							<tr>
								<th style="text-align:left;">Password</th>
								<td><input type="password" name="pass" style="width:100%;" /></td>
							</tr>
							<tr>
								<td colspan="2">
									<button type="submit" class="pure-button pure-button-primary">Entrar</button>
								</td>

							</tr>

						</table>
					</form>
					<?php
}
					?>
				</div>
			</div>
		</body>


	<?php

	?>

	<footer class="footer">
		<div class="container_footer">
			<p>Derechos de autor © 2024. Todos los derechos reservados.</p>
		</div>
	</footer>