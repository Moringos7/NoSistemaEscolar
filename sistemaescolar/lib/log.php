<?php
	function insertLog(	$queryStatement) {
		include 'conexion.php';
		$user = utf8_decode($_SESSION['user']);
		$hoy=  getdate();
		$hoy['hours']-=7;
		$ip=getRealIP();
		$date=$hoy['year']."-".$hoy['mon']."-".$hoy['mday']." ".$hoy['hours'].":".$hoy['minutes'].":".$hoy['seconds'];
		$Query = "SELECT IdLogin FROM login WHERE User = '{$user}'";
		$ResultadoID = mysqli_query($conexion, $Query);
		$ID = mysqli_fetch_array($ResultadoID);
		$queryStatement=str_replace("'", "", $queryStatement);
		$QueryInsert="INSERT into log VALUES (NULL,'{$date}', '{$ID[0]}', '{$queryStatement}','{$ip}')";
		$ResultadoInsert=mysqli_query($conexion, $QueryInsert);

	}
    function getRealIP()
	{
	    if (isset($_SERVER["HTTP_CLIENT_IP"]))
	    {
	        return $_SERVER["HTTP_CLIENT_IP"];
	    }else if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
	    {
	        return $_SERVER["HTTP_X_FORWARDED_FOR"];
	    }else if (isset($_SERVER["HTTP_X_FORWARDED"]))
	    {
	        return $_SERVER["HTTP_X_FORWARDED"];
	    }else if (isset($_SERVER["HTTP_FORWARDED_FOR"]))
	    {
	        return $_SERVER["HTTP_FORWARDED_FOR"];
	    }else if (isset($_SERVER["HTTP_FORWARDED"]))
	    {
	        return $_SERVER["HTTP_FORWARDED"];
	    }else
	    {
	        return $_SERVER["REMOTE_ADDR"];
	    }
	}

 
?>