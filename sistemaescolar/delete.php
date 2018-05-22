<?php session_start();?>
<?php 
	include 'lib/seguridad.php';
	checkSID();
	if(!isset($_SESSION['user'])){header("location:/sistemaescolar/iniciarSesion.html");}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Eliminar</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/estilo.css">
  <meta name="keywords" content="">
  <meta charset="utf-8">
</head>
<body>
	<div class="eliminar">
		<h1 ALIGN=CENTER> Eliminar </h1>
		<div class="regresar">
			<a href="index.php">Regresar</a>
		</div>
		<h2>Registros de alumnos:</h2>
		<?php
			ReadAlumno();
		?>
		<form action="lib/deleteAlumno.php" method="post">
			<select name="IdAlumno">
				<?php  
					include 'lib/conexion.php';

					$sql = "SELECT IdAlumno FROM alumno";
					$result = mysqli_query($conexion,$sql);
					  
					for($i=0; $i<mysqli_num_rows($result); $i++){
						$fila = mysqli_fetch_array($result, MYSQLI_ASSOC);
						$IdAlumno = $fila['IdAlumno'];
						echo "<option value='$IdAlumno'>$IdAlumno ";
					}
				?>
			</select>
			<input type="submit" value="Eliminar Registro">
		</form>
		
		<h2>Registros de calificaciones:</h2>
		<?php
			ReadCursa();
		?>
		<form action="lib/deleteCursa.php" method="post">
			<select name="IdCursa">
				<?php  
				include 'lib/conexion.php';

				 $sql = "SELECT IdCursa FROM cursa";
				 $result = mysqli_query($conexion,$sql);
				  
				 for($i=0;$i<mysqli_num_rows($result);$i++){  
					 $fila = mysqli_fetch_array($result, MYSQLI_ASSOC);
					 $IdCursa = $fila['IdCursa'];
					 echo "<option value='$IdCursa'>$IdCursa ";
				 }
				 ?>
			</select>
			<input type="submit" value="Eliminar Registro">
		</form>
		
		<h2>Registros de materias:</h2>
		<?php
			ReadMateria();
		?>
		<form action="lib/deleteMateria.php" method="post">
			<select name="IdMateria">   
			<?php  
				include 'lib/conexion.php';
				$sql = "SELECT IdMateria FROM materia";
				$result = mysqli_query($conexion,$sql);

				for($i=0;$i<mysqli_num_rows($result);$i++){
					$fila = mysqli_fetch_array($result, MYSQLI_ASSOC);
					$IdMateria = $fila['IdMateria'];
					echo "<option value='$IdMateria'>$IdMateria ";
				}
			?>
			</select>
			<input type="submit" value="Eliminar Registro">
		</form>

		
	</div>
</body>
</html>