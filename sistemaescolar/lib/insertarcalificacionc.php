<?php session_start();?>
<?php 
	include 'seguridad.php';
	checkSID();
	if(!isset($_SESSION['user'])){header("location:/sistemaescolar/iniciarSesion.html");}
?>
<HTML>
<HEAD>
<TITLE>Cursa insertado</TITLE>
</HEAD>
<BODY>
 <?php
include 'conexion.php';
$idAlumnov = $_POST['idAlumno'];
$idMateriav = $_POST['IdMateria'];
$idCalificacionv = $_POST['Calificacion'];


$insertando = mysqli_query($conexion, "INSERT INTO cursa(IdAlumno,IdMateria,Calificacion) values('$idAlumnov','$idMateriav','$idCalificacionv');");
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