<?php
	session_start();
	$nombre = $_POST["usuario"];
	$contra = $_POST["contraseña"];

	require_once("./capsulas/conexion.php");
	$sentencia = "SELECT NomUsuario, IdUsuario FROM usuarios where '$nombre' = NomUsuario and '$contra' = Clave";
	$consulta = mysqli_query($conn, $sentencia);
	if (mysqli_num_rows($consulta) > 0){
		$row = mysqli_fetch_object($consulta);
		$existe = $row->NomUsuario;
	}
		
	mysqli_close();
	if ($existe !=null) {
		$_SESSION["usuario"] = $row->NomUsuario;
		$_SESSION["ident"] = $row->IdUsuario;
		$extra = "micuenta.php";
		setcookie("nomusuario", $nombre, time() + (86400 * 30)); // 86400 = 1 day * 30 = 1 month
		setcookie("contrausuario", $contra, time() + (86400 * 30)); // 86400 = 1 day * 30 = 1 month
	
		if (!isset($_REQUEST['recordar'])){
  			setcookie("nomusuario", "", time() - 3600);  // expira al instante
  			setcookie("contrausuario", "", time() - 3600); // expira al instante		
  			}
		}
	else{
		$extra = "index.php";
		$mensaje = "?error=true";

		}
		
	$host = $_SERVER['HTTP_HOST'];
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	header("Location: http://$host$uri/$extra$mensaje");
	exit;
?>




