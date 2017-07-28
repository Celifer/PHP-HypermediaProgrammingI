<?php
session_start();
$_SESSION = array();
session_unset();
if(isset($_COOKIE[session_name()])) {
	setcookie(session_name(), ’’, time() - 42000, ’/’);
}
session_destroy();
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
header("Location: http://$host$uri/index.php");
exit;
?>