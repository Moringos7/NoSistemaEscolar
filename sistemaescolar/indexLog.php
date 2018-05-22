<?php session_start();?>
<?php 
	include 'lib/seguridad.php';
	checkSID();
	if(!isset($_SESSION['user'])){header("location:/sistemaescolar/iniciarSesion.html");}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Consultar</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/estilo.css">
  <meta name="keywords" content="">
  <meta charset="utf-8">
</head>
<body>
	<div class="consultar">
		<h1 ALIGN=CENTER> Consultar </h1>
		<div class="regresar">
			<a href="lib/cerrarSesion.php">Cerrar sesión</a>
		</div>
		<div class="actualizar">
			<a href="indexLog.php">Actualizar</a>
		</div>
		
		<?php
			ReadLog();
		?>
	</div>
</body>
</html>