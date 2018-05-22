<?php session_start();?>
<?php 
  include 'lib/seguridad.php';
  checkSID();
  if(!isset($_SESSION['user'])){header("location:/sistemaescolar/iniciarSesion.html");}
  if($_SESSION['admin']==1){echo "<script type='text/javascript'>window.location.href = '/sistemaescolar/indexLog.php';</script>";}
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
      		<h1>Insertar en la Base de Datos</h1>
      		<form method="POST" name="IniciarSesion">
      			<ul>
        			<li class="registrar">
                		<a href="lib/insertarAlumno.php">Alumno</a>
        			</li>
        			<li class="registrar">
                		<a href="lib/insertarMateria.php">Materia</a>
              		</li>
        			<li class="registrar">
                		<a href="lib/insertarCalificacion.php">Cursa</a>
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