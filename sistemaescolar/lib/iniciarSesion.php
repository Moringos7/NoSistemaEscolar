<?php 
	include_once 'nusoap/nusoap.php';
	if(isset($_POST['user'])&&isset($_POST['pass']))
	{

		/*$user=utf8_decode($_POST['user']);		
		$pass= utf8_decode($_POST['pass']);*/
		$user= $_POST['user'];		
		$pass= $_POST['pass'];
		
				
		//Cambiar ruta de WebService
		///////////////////////////
		$client = new nusoap_client('http://localhost/WebService1/servicio.php?wsdl',true);
		/////////////////////////////
		$err = $client->getError();
		if ($err) {	
			echo 'Error en Constructor' . $err ; 
		}
		$parametros = array('User' => $user,'Password' => $pass);
		$result = array();
		$result = $client->call('Login', $parametros);

		if ($client->fault) {
			echo "<script type='text/javascript'>alert('Error conexion servidor '); window.location.href = '/sistemaescolar/iniciarSesion.html';</script>";
		}else{	
			$err = $client->getError();
			if ($err) {		// Muestra el error
				echo "<script type='text/javascript'>alert('Error datos conexion '); window.location.href = '/sistemaescolar/iniciarSesion.html';</script>";	
			} else {
				/*var_dump($result['CheckUser']);
				var_dump($result['CheckPasswordExist']);
				var_dump($result['CheckPassword']);
				var_dump($result['SID']);
				var_dump($result['NombreUsuario']);
				var_dump($result['Admin']);*/
					
				if($result['CheckUser']){
					$admin = 0;
					if($result['CheckPasswordExist'])
					{
						if($result['CheckPassword'])
						{
							session_start();
							$_SESSION['SID'] = $result['SID'];
							$_SESSION['user'] = utf8_decode($result['NombreUsuario']);
						
							if ($admin==1) {
								$_SESSION['admin'] == $result['Admin'];
								echo "<script type='text/javascript'>alert('Bienvenido ');window.location.href = '/sistemaescolar/indexLog.php';</script>";
							}
							else {$_SESSION['admin'] = $result['Admin'];
								echo "<script type='text/javascript'>alert('Bienvenido ');window.location.href = '/sistemaescolar/index.php';</script>";
							
							}
							//echo "Bienvenido";
						}
						else
						{	
							echo "<script type='text/javascript'>alert('Su contraseña no coincide. '); window.location.href = '/sistemaescolar/iniciarSesion.html';</script>";			
						}
					}
					else
					{
						echo "no";	
						echo "<script type='text/javascript'>alert('Su contraseña no coincide. '); window.location.href = '/sistemaescolar/iniciarSesion.html';</script> ";
					}
				}

				else
				{
					echo"<script type='text/javascript'>alert('Su nombre de usuario no coincide. '); window.location.href = '/sistemaescolar/iniciarSesion.html'</script>";
				}
			}
		}
	}
	else
	{
		echo"<script type='text/javascript'>alert('Algo salió mal. Reintente llenar el formulario.'; window.location.href = '/sistemaescolar/iniciarSesion.html';</script>";
	}
	
?>