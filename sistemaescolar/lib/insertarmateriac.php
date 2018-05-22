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
include 'conexion.php';
$Nombrev = $_POST['nombre'];


$insertando = mysqli_query($conexion, "INSERT INTO materia(Nombre)values('$Nombrev');");
if($insertando)
{

print("Insertado, todo verde");
} else {
print("No insertado");
}
mysqli_close($conexion);
?>
   <a  href="/sistemaescolar/insertar.php"> Regresar </a>
   </BODY>
</HTML>