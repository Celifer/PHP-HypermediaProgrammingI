<?php 
	$servername = "localhost";
	$username = "phiDB";
	$password = "qwerty";
	$dbname = "pibd";
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if (!$conn) {
    	die("Conexion fallida: " . mysqli_connect_error());
	}
	mysqli_query ($conn,"SET NAMES 'utf8'");
?>