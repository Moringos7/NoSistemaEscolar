<?php
	include_once 'nusoap/nusoap.php';
	$Servicio = new soap_server();

	$ns ="urn:serviciowsdl";
	$Servicio->configureWSDL("Login",$ns);
	$Servicio->schemaTargetNamespace = $ns;

	$Servicio->wsdl->addComplexType(
    'InfoLogin',
    'complextType',
    'struct',
    'sequence',
    '',
    array(
        'CheckUser' => array('name' => 'CheckUser', 'type' => 'xsd:boolean'),
        'CheckPasswordExist' => array('name' => 'CheckPasswordExist', 'type' => 'xsd:boolean'),
        'CheckPassword' => array('name' => 'CheckPassword', 'type' => 'xsd:boolean'),
        'SID' => array('name' => 'SID', 'type' => 'xsd:int'),
        'NombreUsuario' => array('name' => 'NombreUsuario', 'type' => 'xsd:string'),
        'Admin' => array('name' => 'Admin', 'type' => 'xsd:int')
    ));


	$Servicio->register("Login",array('User' => 'xsd:string','Password' => 'xsd:string'),array("return" => "tns:InfoLogin"),$ns);

	function conexion(){
		/*
		Cambiar valores conexion
		*/
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
		return $conexion;
	}
	function Login($User,$Password){
		$conexion = conexion();
		$CheckUser = false;
		$CheckPasswordExist = false;
		$CheckPassword = false;
		$SID = 0;
		$NombreUsuario="lolo";
		$Admin = 0;

		$user= utf8_decode($User);
		$password= utf8_decode($Password);
		$iniciarSesion="SELECT IdLogin,Password/*,Admin*/ FROM login WHERE User='$user'";
		
		$resultado_iniciarSesion=mysqli_query($conexion, $iniciarSesion);

		if($userDetectado = mysqli_fetch_array($resultado_iniciarSesion))
		{
			$CheckUser = true;
			$IdLog = $userDetectado[0];
			$passwordBD=$userDetectado[1];
			//$admin=$userDetectado[1];
			////
			$admin = 0;
			/////
			if($passwordBD)
			{
				$CheckPasswordExist = true;
				if($password==$passwordBD)
				{
					$CheckPassword = true;

					$SID = rand();
					$user= utf8_decode($User);
					$NombreUsuario = $user;
					
					$Query = "UPDATE login SET sid = '$SID' WHERE IdLogin = '$IdLog'";

					mysqli_query($conexion, $Query);
					if ($admin==1) {
						$Admin = 1;
						return array('CheckUser'=>$CheckUser, 'CheckPasswordExist'=> $CheckPasswordExist,'CheckPassword'=> $CheckPassword,'SID'=>$SID,'NombreUsuario' => $NombreUsuario,'Admin' => $Admin);		
					}
					else {
						$Admin = 0;
						return array('CheckUser'=>$CheckUser, 'CheckPasswordExist'=> $CheckPasswordExist,'CheckPassword'=> $CheckPassword,'SID'=>$SID,'NombreUsuario' => $NombreUsuario,'Admin' => $Admin);
					}
				}
				else
				{	
					return array('CheckUser'=>$CheckUser, 'CheckPasswordExist'=> $CheckPasswordExist,'CheckPassword'=> $CheckPassword,'SID'=>$SID,'NombreUsuario' => $NombreUsuario,'Admin' => $Admin);		
				}
			}
			else
			{
				return array('CheckUser'=>$CheckUser, 'CheckPasswordExist'=> $CheckPasswordExist,'CheckPassword'=> $CheckPassword,'SID'=>$SID,'NombreUsuario' => $NombreUsuario,'Admin' => $Admin);
			}
		}else
		{
			return array('CheckUser'=>$CheckUser, 'CheckPasswordExist'=> $CheckPasswordExist,'CheckPassword'=> $CheckPassword,'SID'=>$SID,'NombreUsuario' => $NombreUsuario,'Admin' => $Admin);
		}
	}
	$Servicio->service(file_get_contents("php://input")); 
?>