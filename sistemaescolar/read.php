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
			<a href="index.php">Regresar</a>
		</div>
		<div class="actualizar">
			<a href="read.php">Actualizar</a>
		</div>
		<h3>Calificaciones:</h3>
		<?php
			ReadCursa();
		?>
	
		<h3>Alumnos:</h3>
		<?php
			ReadAlumno();
		?>
	
		<h3>Materias:</h3>
		<?php
			ReadMateria();
		?>
		
	</div>
</body>
</html>