<?php 
	session_start();

	$_SESSION["usuario"] = $_COOKIE["nomusuario"];

	$host = $_SERVER['HTTP_HOST'];
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	header("Location: http://$host$uri/micuenta.php");
	exit;
?>