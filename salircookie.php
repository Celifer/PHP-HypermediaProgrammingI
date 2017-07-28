<?php
	setcookie("ultimavisita", "", time() - 3600);
	setcookie("nomusuario", "", time() - 3600);  
  	setcookie("contrausuario", "", time() - 3600);
	$host = $_SERVER['HTTP_HOST'];
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	header("Location: http://$host$uri/index.php");
	exit;
?>