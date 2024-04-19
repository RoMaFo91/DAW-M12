<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Página Web Moderna</title>
	<link rel="stylesheet" href="css/styles.css">
</head>

<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
  }

require_once('classes.php');

if (isset($_GET["Desc"])) {
	$_SESSION['user'] = NULL;
	$_SESSION['pass'] = NULL;
	$_SESSION['login_correct']=NULL;
}
if (isset($_REQUEST['user']) && isset($_REQUEST['pass'])) {
	$_SESSION['user'] = $_REQUEST['user'];
	$_SESSION['pass'] = $_REQUEST['pass'];
	$_SESSION['CodMundo']='';
	
	if (ComprobarSession($_REQUEST['user'], $_REQUEST['pass'])) {
		$_SESSION['login_correct'] = True;
		// header('Location: index.php');
		// header('Location: controller/mundo.controller.php');
	} else {
		$_SESSION['login_correct'] = False;
		// header('Location: index.php');
	}
}
?>

<body>

	<header class="header">
		<div class="container_head">
			<div class="logo">
				<img src="icon/logo.jpg" alt="Logo" class="logo-img" style="width:40%">
			</div>
			<h1>Gestor de mundos</h1>
			<p>Mundos disponibles :</p>
			<nav class="navbar">
				<ul class="nav-list">

					<?php
					if (isset($_SESSION['login_correct'])) {
						// include('/controller/mundo.controller.php?type=list');
						$type = "list";
						require($_SERVER['DOCUMENT_ROOT'] . "/controller/mundo.controller.php");
						// include($_SERVER['DOCUMENT_ROOT'].'/controller/mundo.controller.php?type=list');
					}
					?>
				</ul>
			</nav>
			<?php
			if (isset($_SESSION['login_correct'])) {
				?>
			<div class="login">
				<a href="index.php?Desc=desc" class="login-link">Cerrar sesión</a>
			</div>
			<?php
			}
			?>
		</div>
	</header>

	<body>
		<div class="contenedor">
			<div class="menu-lateral">
				<!-- Contenido del menú lateral -->
				<ul>
					<?php
					if (isset($_SESSION['login_correct'])) {
						require($_SERVER['DOCUMENT_ROOT'] . "/lista.php");
					}
					?>
					<!-- <li><a href="#">Inicio</a></li>
						<li><a href="#">Acerca de</a></li>
						<li><a href="#">Contacto</a></li> -->
				</ul>
			</div>
			<div class="contenido">
				<!-- Contenido principal -->
				<?php
				if (isset($_SESSION['NomMundo']))
				{ ?><h1>Bienvenido al mundo : <?php
					echo $_SESSION['NomMundo'];
				}
				
				 ?> </h1> 
				<div class="container">
				<?php

				if (isset($_REQUEST['model'])) {
					$model = $_REQUEST['model'];
					$type = "form";
					require($_SERVER['DOCUMENT_ROOT'] . "/controller/" . $model . ".controller.php");
				}


				if (!isset($_SESSION['login_correct'])) {
				?>

					<form action="index.php" method="post">

								User<input type="text" name="user" style="width:100%;" />
							Password<input type="password" name="pass" style="width:100%;" />
							<br/><br/>
									<button type="submit" class="pure-button pure-button-primary">Entrar</button>

					</form>
				<?php
				}
				?>
				</div>
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