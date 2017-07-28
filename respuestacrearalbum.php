<?php
	$title = "Álbum creado";
	require_once("./capsulas/cabecera.php");
	
	include_once("./capsulas/conexion.php");
	$usuario = $_SESSION["ident"];

	$respuesta = array();
	if (isset($_POST["titulo"])){
		$titulo = trim(mysqli_real_escape_string($conn, $_POST["titulo"]));
		$titulo= filter_var($titulo, FILTER_SANITIZE_STRING);
	}
	else{
		$respuesta[] = "Debes completar el campo Titulo.";
	}

	if (isset($_POST["descrip"])){
		$descrip = trim(mysqli_real_escape_string($conn, $_POST["descrip"]));
	}
	else{
		$descrip = "";
	}

	if (isset($_POST["fecha"])){
		$fecha = trim(mysqli_real_escape_string($conn, $_POST["fecha"]));
		$fec_array = explode('-', $fecha);
		$t=time();
		if (count($fec_array)==3) {
			if (!checkdate($fec_array[1], $fec_array[2], $fec_array[0])){
				$respuesta[] = "Formato de fecha incorrecto.";
			}			
		}
	}
	else{
		$fecha = "";
	}

	if (isset($_POST["pais"])){
		$pais = trim(mysqli_real_escape_string($conn, $_POST["pais"]));
		$pais = filter_var($pais, FILTER_SANITIZE_NUMBER_INT);
	}
	else{
		$respuesta[] = "Debes introducir un pais";
	}

	if (!$respuesta){
		$sentencia = "INSERT INTO albumes (Titulo, Descripcion, Fecha, Pais, Usuario) VALUES ('$titulo', '$descrip', '$fecha', '$pais', '$usuario')";
		$consulta = mysqli_query($conn, $sentencia);
		$sentencia="SELECT * FROM paises where '$pais' = IdPais";		
		$consulta = mysqli_query($conn, $sentencia);
		mysqli_close($conn);
		if (mysqli_num_rows($consulta) > 0){
			$row = mysqli_fetch_object($consulta);
			$NomPais = $row->NomPais;
		}
		
	}
	
	else{
		$error = serialize($respuesta);
		$error = urlencode($error);
		$extra = "crearalbum.php?err=";
		$host = $_SERVER['HTTP_HOST'];
		mysqli_close($conn);
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("Location: http://$host$uri/$extra$error");
		exit;
	}
	

	if (!isset($_SESSION["usuario"])){
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("Location: http://$host$uri/index.php");
	}
	else{
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header('Refresh:7; URL= http://localhost/phi/micuenta.php'); 
	}
	require_once("./capsulas/inicio.php");
	require_once("./capsulas/menureg.php");	
?>
<main>
	<h2><?php echo $title; ?></h2>
	<div  class="respregistro">
		Título:
		<?php if(isset($titulo)) echo $titulo; ?><br>
		Descripción:
		<?php if(isset($descrip)) echo $descrip; ?><br>
		Fecha:
		<?php if(isset($fecha)) echo $fecha; ?><br>
		País:
		<?php if(isset($NomPais)) echo $NomPais; ?><br>
		<h4> Redirigiendo en 7 segundos...</h4>
	</div>
	</main>
<?php
	require_once("./capsulas/pie.php");
?>