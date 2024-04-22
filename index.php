<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gestión de mundos</title>
	<link rel="stylesheet" href="css/styles.css">
	<script type="text/javascript">
		// Funciona para validar en javascript que el correo sea correcto
		function validateEmail(){
     
				// Get our input reference.
				var emailField = document.getElementById('email');
               
				// Define our regular expression.
				var validEmail =  /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
				// Using test we can check if the text match the pattern
				if( validEmail.test(emailField.value) ){
					return true;
				}else{
					alert('El correo no es válido');
					return false;
				}
			} 
	</script>
</head>

<?php
//Pagina base de toda la aplicación contendra varias secciones que ira llenando segun la URL
// que este construida, la parte mas variable es la de contenido que va cargando segun la URL

if (session_status() == PHP_SESSION_NONE) {
	session_start();
  }

require_once('classes.php');

if (isset($_GET["Desc"])) {
	//Este punto llegara cuando pulse el link desconectar
	$_SESSION['user'] = NULL;
	$_SESSION['pass'] = NULL;
	$_SESSION['login_correct']=NULL;
	session_destroy();
}
if (isset($_REQUEST['user']) && isset($_REQUEST['pass'])) {
	//Este punto llegara cuando ha intentado realizar login
	$_SESSION['user'] = $_REQUEST['user'];
	$_SESSION['pass'] = $_REQUEST['pass'];
	$_SESSION['CodMundo']='';
	
	//Se comprueba que el usuario es valido tanto el password como el código
	if (ComprobarSession($_REQUEST['user'], $_REQUEST['pass'])) {
		//En el caso de haber hecho login con un usuario correcto cargara el resto de pagina

		require($_SERVER['DOCUMENT_ROOT'] . "/controller/userg.controller.base.php");
		$_SESSION['level']=$model->Obtener($_SESSION['user'])->__GET('Security_Level');
		$_SESSION['login_correct'] = True;
		// header('Location: index.php');
		// header('Location: controller/mundo.controller.php');
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
						// Cargamos el controlador de mundo en tipo lista para poder ver
						// todos los mundos disponibles
						$type = "list";
						require($_SERVER['DOCUMENT_ROOT'] . "/controller/mundo.controller.php");
						
					}
					?>
				</ul>
			</nav>
			<?php
			if (isset($_SESSION['login_correct'])) {
				?>
			<div class="login">
				<!-- Elimina las variables de sessión -->
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
				</ul>
			</div>
			<div class="contenido">
				<!-- Contenido principal -->
				<?php
				if (isset($_SESSION['NomMundo']))
				{ ?><h1>Bienvenido <?php echo $_SESSION['user']; ?> al mundo : <?php
					echo $_SESSION['NomMundo'];
				}
				
				 ?> </h1> 
				
				<?php

				if (isset($_REQUEST['model'])) {
					if ($_REQUEST['model']=="monstruo" || $_REQUEST['model']=="personaje")
					{
						echo '<div class="container_big">';
					}
					else
					{
						echo '<div class="container">';
					}

					$model = $_REQUEST['model'];
					$type = "form";
					require($_SERVER['DOCUMENT_ROOT'] . "/controller/" . $model . ".controller.php");
				}
				else
				{
					echo '<div class="container">';
				}


				if (!isset($_SESSION['login_correct'])) {
				?>
				<!-- Formulario de login -->
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