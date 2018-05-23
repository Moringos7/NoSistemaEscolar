<?php

	include_once 'nusoap/nusoap.php';
	$client = new nusoap_client('http://localhost/WebService1/wsInsertar.php?wsdl',true);
	$err = $client->getError();
	if ($err) {	
		echo 'Error en Constructor' . $err ; 
	}
	
	//$parametros = array('IdAlumno' => 1,'IdMateria'=>25,'Calificacion'=>100);
	$parametros = array('IdAlumno'=>3,'IdMateria'=>25,'Calificacion' => 103);
	$result = array();
	$result = $client->call('InsertarCursa', $parametros);

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
			var_dump($result);
		}
	}
?>