<?php

	session_start();
	session_unset();
	session_destroy();
	header("location:/sistemaescolar/iniciarSesion.html");
	
?>