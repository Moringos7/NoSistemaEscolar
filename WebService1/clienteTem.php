<?php

	include_once 'nusoap/nusoap.php';
	$client = new nusoap_client('http://localhost/WebService1/servicio.php?wsdl',true);
	$err = $client->getError();
	if ($err) {	
		echo 'Error en Constructor' . $err ; 
	}
	
	$parametros = array('User' => 'Piña','Password' => 'piña');
	$result = array();
	$result = $client->call('Login', $parametros);

	if ($client->fault) {
		/*echo 'Fallo: Conexion WebService';*/
		echo "Fallo";
		print_r($result);
	}else{	
		$err = $client->getError();
		if ($err) {		// Muestra el error
			/*echo 'Error: Comunicación WebService ' . $err ; */
			echo "Error: ".$err;
		} else {		// Muestra el resultado
			/*var_dump($result['CheckUser']);
			var_dump($result['CheckPasswordExist']);
			var_dump($result['CheckPassword']);
			var_dump($result['SID']);
			var_dump($result['NombreUsuario']);
			var_dump($result['Admin']);*/
			echo $result['NombreUsuario'];
		}
	}
?>