<?php session_start();?>
<?php 
  include 'lib/seguridad.php';
  checkSID();
  if(!isset($_SESSION['user'])){header("location:/sistemaescolar/iniciarSesion.html");}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Modificar</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/estilo.css">
  <meta name="keywords" content="">
  <meta charset="utf-8">
</head>

<body>
	<div class="modificar">
    	<div class="opciones">
      		<h1>Modificar Base de Datos</h1>
      		<form method="POST" name="IniciarSesion">
      			<ul>
        			<li class="registrar">
                		<a href="lib/UpdateAlumno.php">Alumno</a>
        			</li>
        			<li class="registrar">
                		<a href="lib/UpdateMateria.php">Materia</a>
              		</li>
        			<li class="registrar">
                		<a href="lib/UpdateCursa.php">Cursa</a>
        			</li>
              
        			<li class="registrar">
                		<a href="index.php">REGRESAR</a>
        			</li>
	    		</ul>
      		</form>
    	</div>
  	</div>
</body>

</html>