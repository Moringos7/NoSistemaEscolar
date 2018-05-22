<?php session_start();?>
<?php 
	include 'seguridad.php';
	checkSID();
	if(!isset($_SESSION['user'])){header("location:/sistemaescolar/iniciarSesion.html");}
?>
<?php
	include 'conexion.php';
	
if(isset($_POST["IdAlumno"])){	
	$IdAlumno = $_POST['IdAlumno'];
	$query = "DELETE FROM alumno where IdAlumno ='{$IdAlumno}'";
	$consulta = mysqli_query($conexion,$query );
	insertLog($query);
	if($consulta){
		echo"<script type='text/javascript'>alert('Registro de alumno eliminado'); window.location.href = '/sistemaescolar/delete.php';</script>";
	}else{
		echo"<script type='text/javascript'>alert('El registro no pudo ser eliminado'); window.location.href = '/sistemaescolar/delete.php';</script>";
	}
	mysqli_close($conexion);
}else{
	echo "<script type='text/javascript'>alert('No se encuentra el id solicitado. '); window.location.href = '/sistemaescolar/delete.php';</script> ";
}
?>