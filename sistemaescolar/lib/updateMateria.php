<?php session_start();?>
<?php 
	include 'seguridad.php';
	checkSID();
	if(!isset($_SESSION['user'])){header("location:/sistemaescolar/iniciarSesion.html");}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Modificar Materia</title>
	<link rel="stylesheet" type="text/css" href="/sistemaescolar/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/sistemaescolar/css/estilo.css">
	<meta name="keywords" content="">
 	<meta charset="utf-8">
 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
	<div class="modificar">
    	<div class="contenformulario">
    		<h1>Modificar Materia</h1>
			<?php
				include 'conexion.php';
				if(isset($_POST['IdMateria'])) {
					$IdMateria = $_POST['IdMateria'];
					$QueryChecaMateria = "SELECT IdMateria FROM materia WHERE IdMateria = '$IdMateria'";
					$ResultadoQueryChecaMateria = mysqli_query($conexion, $QueryChecaMateria);
					if (mysqli_num_rows($ResultadoQueryChecaMateria) > 0) {
						if (isset($_POST['Nombre'])) {
							$Nombre = utf8_decode($_POST['Nombre']);
							$QueryUpdateNombre = "UPDATE materia SET Nombre = '".$Nombre."' WHERE IdMateria = '$IdMateria'";
							if (!mysqli_query($conexion, $QueryUpdateNombre)) {
								echo "<script type='text/javascript'>alert('".mysqli_error($conexion)."');</script>";
							}
							insertLog($QueryUpdateNombre);
						}			
					}
					else {
						echo "<script type='text/javascript'>alert('IdMateria erroneo');</script>";
					}
				}
				ReadMateria();
				/*$QuerySelectMateria = "SELECT * FROM Materia";
				$ResultadoQuerySelectMateria = mysqli_query($conexion, $QuerySelectMateria);
				
				echo "<table align='center'> <tr> <th>IdMateria</th><th>Nombre</th></tr>";
				while ($Filas = mysqli_fetch_array($ResultadoQuerySelectMateria, MYSQL_ASSOC)) { 
					echo "<tr><td>".$Filas['IdMateria']."</td>";
					echo "<td>".utf8_decode($Filas['Nombre'])."</td></tr>";
				}
				echo "</table>";*/
			?>
			<form align='center' action="UpdateMateria.php" method="POST">
				<input type="text" name="IdMateria" placeholder="IdMateria">
				<input type="text" name="Nombre" placeholder="Nombre"><br>
				<input type="submit" name="Modificar" value="Modificar">
			</form><br>
			<form align='center' action="/sistemaescolar/Update.php">
				<input type="submit" name="" value="Regresar">
			</form>
		</div>
	</div>
</body>
</html>