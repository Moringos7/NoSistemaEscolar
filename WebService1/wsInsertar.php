<?php
	include_once 'nusoap/nusoap.php';
	$Servicio = new soap_server();

	$ns ="urn:serviciowsdl";
	$Servicio->configureWSDL("Insertar",$ns);
	$Servicio->schemaTargetNamespace = $ns;


	$Servicio->wsdl->addComplexType(
    'InfoMateria',
    'complextType',
    'struct',
    'sequence',
    '',
    array(
        'Validador' => array('name' => 'Validador', 'type' => 'xsd:boolean'),
        'Sentencia' => array('name' => 'Sentencia', 'type' => 'xsd:string')
    ));
	$Servicio->wsdl->addComplexType(
    'InfoAlumno',
    'complextType',
    'struct',
    'sequence',
    '',
    array(
        'Validador' => array('name' => 'Validador', 'type' => 'xsd:boolean'),
        'Sentencia' => array('name' => 'Sentencia', 'type' => 'xsd:string')
    ));

	$Servicio->wsdl->addComplexType(
    'InfoCursa',
    'complextType',
    'struct',
    'sequence',
    '',
    array(
        'Validador' => array('name' => 'Validador', 'type' => 'xsd:boolean'),
        'ValidadorRango' => array('name' => 'ValidadorRango', 'type' => 'xsd:boolean'),
        'Sentencia' => array('name' => 'Sentencia', 'type' => 'xsd:string')
    ));

	$Servicio->register("InsertarMateria",array('Materia' => 'xsd:string'),array("return" => "tns:InfoMateria"),$ns);

	$Servicio->register("InsertarCursa",array('IdAlumno' => 'xsd:int','IdMateria' => 'xsd:int','Calificacion' => 'xsd:int'),array("return" => "tns:InfoCursa"),$ns);

	$Servicio->register("InsertarAlumno",array('Nombre' => 'xsd:string','ApellidoP' => 'xsd:string','ApellidoM' => 'xsd:string'),array("return" => "tns:InfoAlumno"),$ns);

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
	function InsertarMateria($Materia){
		$conexion = conexion();
		$validador = false;
		$Materia = utf8_decode($Materia);
		$query="INSERT INTO materia(Nombre)values('{$Materia}');";
        if($Materia!="")
        {
            $insertando = mysqli_query($conexion, $query);
            if($insertando)
            {
            	$validador = true;
            } else 
            {
                $validador = false;
            }
        }
        mysqli_close($conexion);
        return array('Validador'=>$validador, 'Sentencia'=> $query);
	}

	function InsertarCursa($IdAlumno,$IdMateria,$Calificacion){
		$conexion = conexion();	
		$validador = false;
		$validadorrango = false;
        $idAlumnov = utf8_decode( $IdAlumno);
        $idMateriav = utf8_decode( $IdMateria);
        $idCalificacionv = utf8_decode( $Calificacion);

        if($idAlumnov!="" && $idMateriav!="" && $idCalificacionv!="")
        {
            if($idCalificacionv >= 0 && $idCalificacionv <= 100)
            {
            	$validadorrango = true;
                $consulta = "INSERT INTO cursa(IdAlumno,IdMateria,Calificacion) values('$idAlumnov','$idMateriav','$idCalificacionv');";
                $insertando = mysqli_query($conexion, $consulta);
                mysqli_close($conexion);
            } 
	        if($insertando)
	        {
	           $validador = true;
	        } 
	        else 
	        {
	            $validador = false;
	        }
       }
		return array('Validador'=>$validador,'ValidadorRango'=>$validadorrango,'Sentencia'=> $consulta);
	}

	function InsertarAlumno($Nombre,$ApellidoP,$ApellidoM){
		$conexion = conexion();
		$validador = false;
		$Nombrev = utf8_decode($Nombre);
       	$ApellidoPv = utf8_decode($ApellidoP);
        $ApellidoMv = utf8_decode($ApellidoM);
        if ($Nombrev!="" && $ApellidoPv!=""&& $ApellidoMv!=""){ 
            $consulta = "INSERT INTO alumno(nombre,apellido_p,apellido_m) values('$Nombrev','$ApellidoPv','$ApellidoMv');";
            $insertando = mysqli_query($conexion, $consulta);
            if($insertando)
            {
                $validador = true;
            } 
            else 
            {
                $validador = false;
            }
        }
        mysqli_close($conexion);
        return array('Validador'=>$validador, 'Sentencia'=> $consulta);
	}

	$Servicio->service(file_get_contents("php://input")); 
?>