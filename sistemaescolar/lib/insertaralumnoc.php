<?php session_start();?>
<?php 
	include 'seguridad.php';
	checkSID();
	if(!isset($_SESSION['user'])){header("location:/sistemaescolar/iniciarSesion.html");}
?>
<HTML>
<HEAD>
<TITLE>Alumno insertado</TITLE>
</HEAD>
<BODY>
 <?php
ReadAlumno();
include 'conexion.php';
$Nombrev = $_POST['nombre'];
$ApellidoPv = $_POST['ApellidoP'];
$ApellidoMv = $_POST['ApellidoM'];

$insertando = mysqli_query($conexion, "INSERT INTO alumno(nombre,apellido_p,apellido_m) values('$Nombrev','$ApellidoPv','$ApellidoMv');");
if($insertando)
{
		print("Insertado, todo verde");
} else 
{
	print("No insertado");
}
mysqli_close($conexion);
?>
  <a  href="/sistemaescolar/insertar.php"> Regresar </a> 
   </BODY>
</HTML>
