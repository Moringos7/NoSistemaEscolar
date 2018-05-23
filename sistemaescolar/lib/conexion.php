<?php

	//$servidor1 = "192.168.84.77";
	$servidorWebLogin = 'http://localhost/WebService1/wsLogin.php?wsdl';
	$servidorWebInsertar ='http://localhost/WebService1/wsInsertar.php?wsdl';
	$servidor1 = "localhost";
	$servidor2 = "192.168.84.197";
	$baseDatos = "sistemaescolar";
	//$usuario = "replicator"; 
	$usuario = "root"; 
	//$password = "1234";
	$password = "";
	$link = mysqli_init();
	//$link2 = mysqli_connect($servidor2, $usuario, $password);
	error_reporting(0);
	mysqli_options($link, MYSQLI_OPT_CONNECT_TIMEOUT, 5);
	try {		
		$conexion1 = mysqli_real_connect($link,$servidor1, $usuario, $password, $baseDatos);
	} catch (Exception $e) {
		$conexion1 = false;
		try {
		$conexion2 = mysqli_real_connect($link, $servidor2, $usuario, $password, $baseDatos) or die();;
		} catch (Exception $e){
			
		}
	}

	if ($conexion1) $conexion = mysqli_connect($servidor1, $usuario, $password, $baseDatos);
	else if ($conexion2) $conexion = mysqli_connect($servidor2, $usuario, $password, $baseDatos);		
	else echo "<script type='text/javascript'>alert('Upps! Parece que no se ha podido conectar a la base de datos');</script>";
	
?>  