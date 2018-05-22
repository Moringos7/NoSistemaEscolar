<?php session_start();?>
<?php 
	include 'seguridad.php';
	checkSID();
	if(!isset($_SESSION['user'])){header("location:/sistemaescolar/iniciarSesion.html");}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Modificar Carrera</title>
	<link rel="stylesheet" type="text/css" href="/sistemaescolar/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/sistemaescolar/css/estilo.css">
	<meta name="keywords" content="">
 	<meta charset="utf-8">
 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
	<div class="modificar">
    	<div class="contenformulario">
    		<h1>Modificar Carrera</h1>
			<?php
				include 'conexion.php';
				if(isset($_POST['IdCarrera'])) {
					$IdCarrera = $_POST['IdCarrera'];
					$Nombre = utf8_decode($_POST['Carrera']);
						
						
						if ($Nombre != "") 
						{
							$consulta = "UPDATE Carrera SET Nombre = '{$Nombre}' WHERE IdCarrera = '$IdCarrera'";
							mysqli_query($conexion, $consulta);
							insertLog($consulta);	
						}
				}

				ReadCarrera();
				
			?>
			<form align='center' action="UpdateCarrera.php" method="POST">
				Id Carrera: <select name="IdCarrera">
					<?php  
						//include 'lib/conexion.php';

						$sql = "SELECT IdCarrera FROM carrera";
						$result = mysqli_query($conexion, $sql);
						  
						for($i=0; $i<mysqli_num_rows($result); $i++){
							$fila = mysqli_fetch_array($result, MYSQLI_ASSOC);
							$IdCarrera = $fila['IdCarrera'];
							echo "<option value='$IdCarrera'>$IdCarrera ";
						}
					?>
				</select>
				<input type="text" name="Carrera" placeholder="Carrera" ><br>
				<input type="submit" name="Modificar" value="Modificar">
			</form><br>
			<form align='center' action="/sistemaescolar/Update.php">
				<input type="submit" name="" value="Regresar">
			</form>
		</div>
	</div>
</body>
</html>
