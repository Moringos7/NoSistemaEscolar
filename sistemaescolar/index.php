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
  <title>Sistema escolar</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/estilo.css">
  <meta name="keywords" content="">
  <meta charset="utf-8">
</head>

<body>
	<div class="CRUD">
    	<div class="opciones">
      		<h1>CRUD: Sistema Escolar</h1>
      		<form method="POST" name="IniciarSesion">
        		<ul>
        			<li>
        				<form><h1>Usuario: <?php echo $_SESSION['user'];?></h1></form>
        			</li>
        			<li class="registrar">
                <a href="insertar.php">Insertar</a>
        			</li>
        			<li class="registrar">
                <a href="read.php">Consultar</a>
              </li>
        			<li class="registrar">
                <a href="update.php">Modificar</a>
        			</li>
        			<li class="registrar">
                <a href="delete.php">Eliminar</a>
        			</li>
        			<li class="registrar">
                <a href="lib/cerrarSesion.php">CERRAR SESIÓN</a>
        			</li>
	    		</ul>
      	</form>
    	</div>
  	</div>
</body>

</html>