<?php
	session_start();
	require_once("./capsulas/conexion.php");
	$usuario =$_SESSION['ident'];
	$sentencia = "DELETE FROM usuarios where IdUsuario = '$usuario'";
	$consulta = mysqli_query($conn, $sentencia);
	if ($consulta == false){
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("Location: http://$host$uri/baja?error=true.php");
		exit;
	}
	mysqli_close();
	$host = $_SERVER['HTTP_HOST'];
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	header("Location: http://$host$uri/salir.php");
	exit;
?>