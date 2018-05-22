<?php
	include 'log.php';
	function checkSID() 
	{
		include 'conexion.php';
	
		$user = utf8_decode($_SESSION['user']);
		$Query = "SELECT sid FROM login WHERE User = '{$user}'";
		$ResultadoSID = mysqli_query($conexion, $Query);
		$SID = mysqli_fetch_array($ResultadoSID);
		if ($SID[0] != $_SESSION['SID']) 
		{
			echo "<script type='text/javascript'>alert('Tu sesión ha sido iniciada en otra instancia');window.location.href = '/sistemaescolar/lib/cerrarSesion.php';</script>";
		}
	}

	function ReadAlumno() 
	{
		

		echo "<table align='center'><tr><th style='border: 1px solid black'>IdAlumno</th><th style='border: 1px solid black'>Nombre</th>";
		echo "<th style='border: 1px solid black'>Apellido Paterno</th><th style='border: 1px solid black'>Apellido Materno</th></tr>";
		include 'conexion.php';
		$array = array();
		$select = "SELECT * FROM alumno";	
		$resultado = mysqli_query($conexion,$select);
		
		$x=1;
		while($registro = mysqli_fetch_array($resultado,MYSQLI_ASSOC))
		{
			if($x==1)
			{
				insertLog($select); $x=0;
			}
			$registro['Nombre'] = utf8_encode($registro['Nombre']);
			$registro['Apellido_P'] = utf8_encode($registro['Apellido_P']);
			$registro['Apellido_M'] = utf8_encode($registro['Apellido_M']);

			echo "<tr>";
			echo "<td style='border: 1px solid black; text-align: center;'>".$registro['IdAlumno']."</td>";
			echo "<td style='border: 1px solid black; text-align: center;'>".$registro['Nombre']."</td>";
			echo "<td style='border: 1px solid black; text-align: center;'>".$registro['Apellido_P']."</td>";
			echo "<td style='border: 1px solid black; text-align: center;'>".$registro['Apellido_M']."</td>";
			echo "</tr>";
		}
		mysqli_close($conexion);
		echo "</table>";
	}

	function ReadCursa() 
	{
		

		echo "<table align='center'><tr><th style='border: 1px solid black'>IdCursa</th><th style='border: 1px solid black'>IdAlumno</th><th style='border: 1px solid black'>IdMateria</th><th style='border: 1px solid black'>Calificacion</th></tr>;";
		include 'conexion.php';
		$array = array();
		$select = "SELECT * FROM cursa";	
		$resultado = mysqli_query($conexion,$select);

		
		$x=1;
		while($registro = mysqli_fetch_array($resultado,MYSQLI_ASSOC))
		{
			if($x==1)
			{
				insertLog($select); $x=0;
			}
			echo "<tr>";
			echo "<td style='border: 1px solid black; text-align: center;'>".$registro['IdCursa']."</td>";
			echo "<td style='border: 1px solid black; text-align: center;'>".$registro['IdAlumno']."</td>";
			echo "<td style='border: 1px solid black; text-align: center;'>".$registro['IdMateria']."</td>";
			echo "<td style='border: 1px solid black; text-align: center;'>".$registro['Calificacion']."</td>";
			echo "</tr>";
		}
		mysqli_close($conexion);
		echo "</table>";
	}

	function ReadMateria() 
	{
		

		echo "<table align='center'><tr><th style='border: 1px solid black'>IdMateria</th><th style='border: 1px solid black'>Materia</th></tr>";
		include 'conexion.php';
		$array = array();
		$select = "SELECT * FROM materia";	
		$resultado = mysqli_query($conexion,$select);
		
		$x=1;

		while($registro = mysqli_fetch_array($resultado,MYSQLI_ASSOC))
		{
			if($x==1)
			{
				insertLog($select); $x=0;
			}
			$registro['Nombre'] = utf8_encode($registro['Nombre']);

			echo "<tr>";
			echo "<td style='border: 1px solid black; text-align: center;'>".$registro['IdMateria']."</td>";
			echo "<td style='border: 1px solid black; text-align: center;'>".$registro['Nombre']."</td>";
			echo "</tr>";
		}
		mysqli_close($conexion);
		echo "</table>";
	}
	function ReadLog() 
	{
		
		echo "<table align='center'><tr><th style='border: 1px solid black'>IdLog</th><th style='border: 1px solid black'>Fecha</th>";
		echo "<th style='border: 1px solid black'>Usuario</th><th style='border: 1px solid black'>Query</th><th style='border: 1px solid black'>IP</th></tr>";
		include 'conexion.php';
		$array = array();
		$select = "SELECT * FROM log";	
		$resultado = mysqli_query($conexion,$select);
		
		$x=1;
		while($registro = mysqli_fetch_array($resultado,MYSQLI_ASSOC))
		{
			$user=$registro['User'];
			if($x==1)
			{
				insertLog($select); $x=0;
			}
			$selectU="SELECT User FROM login where IdLogin='{$user}'";
			$resultadoU = mysqli_query($conexion,$selectU);
			$nombre = mysqli_fetch_array($resultadoU);
			$nombreF=$nombre[0];

			echo "<tr>";
			echo "<td style='border: 1px solid black; text-align: center;'>".$registro['IdLog']."</td>";
			echo "<td style='border: 1px solid black; text-align: center;'>".$registro['Date']."</td>";
			echo "<td style='border: 1px solid black; text-align: center;'>".$nombreF."</td>";
			echo "<td style='border: 1px solid black; text-align: center;'>".$registro['Query']."</td>";
			echo "<td style='border: 1px solid black; text-align: center;'>".$registro['IPaddress']."</td>";
			echo "</tr>";
		}
		mysqli_close($conexion);
		echo "</table>";
	}

?>