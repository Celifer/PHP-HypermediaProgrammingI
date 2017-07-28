<?php	
	$title = "Foto insertada";

	require_once("./capsulas/cabecera.php");
	include_once("./capsulas/conexion.php");
	$respuesta = array();

	

	if (isset($_POST["titulo"])){
		$titulo = trim(mysqli_real_escape_string($conn, $_POST["titulo"]));
		$titulo= filter_var($titulo, FILTER_SANITIZE_STRING);
	}
	else{
		$respuesta[] = "Debes completar el campo Titulo.";
	}

	if (isset($_POST["fecha"])){
		$fecha = trim(mysqli_real_escape_string($conn, $_POST["fecha"]));
		$fec_array = explode('-', $fecha);
		$t=time();
		if (count($fec_array)==3) {
			if (!checkdate($fec_array[1], $fec_array[2], $fec_array[0])){
				$respuesta[] = "Formato de fecha incorrecto.";
			}
			elseif (strtotime(date("Y-m-d",$t))<strtotime($fecha)){
				$respuesta[] = "Introduce una fecha anterior o igual a la actual.";
			}			
		}
	}
	else{
		$respuesta[] = "Debes introducir una fecha";
	}

	if (isset($_POST["pais"])){
		$pais = trim(mysqli_real_escape_string($conn, $_POST["pais"]));
		$pais = filter_var($pais, FILTER_SANITIZE_NUMBER_INT);
	}
	else{
		$respuesta[] = "Debes introducir un pais";
	}

	if (isset($_POST["album"])){
		$album = trim(mysqli_real_escape_string($conn, $_POST["album"]));
		if ($album == 0)
			$respuesta [] ="Debes crear un álbum primero";
	}
	else{
		$respuesta[] = "Debes seleccionar un álbum";
	}

	if (isset($_POST["descrip"])){
		$descrip = trim(mysqli_real_escape_string($conn, $_POST["descrip"]));
	}
	else{
		$descrip = "";
	}

	if(isset($_FILES['foto']['tmp_name']) && is_file($_FILES['foto']['tmp_name'])){
		require_once ("./capsulas/validarimg.php");
		if (isset($fichero))
			$foto = $fichero;
	}
	else{
		$respuesta[] = "Debes introducir una imagen";
	}



	if (!$respuesta){
		$sentencia="INSERT INTO fotos (Titulo, Descripcion, Fecha, Pais, Album, Fichero) VALUES ('$titulo', '$descrip', '$fecha','$pais','$album','$foto')";
		$consulta = mysqli_query($conn, $sentencia);
		$sentencia="SELECT * FROM paises where '$pais' = IdPais";		
		$consulta = mysqli_query($conn, $sentencia);
		if (mysqli_num_rows($consulta) > 0){
			$row = mysqli_fetch_object($consulta);
			$NomPais = $row->NomPais;
		}
		$sentencia="SELECT * FROM albumes where '$album' = IdAlbum";		
		$consulta = mysqli_query($conn, $sentencia);
		if (mysqli_num_rows($consulta) > 0){
			$row = mysqli_fetch_object($consulta);
			$NomAlbum = $row->Titulo;
		}
		mysqli_close($conn);
	}
	
	else{
		$error = serialize($respuesta);
		$error = urlencode($error);
		$extra = "anyadirfoto.php?err=";
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
		Fecha:
		<?php if(isset($fecha)) echo $fecha; ?><br>
		País:
		<?php if(isset($NomPais)) echo $NomPais; ?><br>
		Álbum:
		<?php if(isset($NomAlbum)) echo $NomAlbum; ?><br>
		Foto:
		<?php if(isset($foto)) echo "<img src=".$fichero." width=200 px height=200 px>"; ?> <br>
		<h4> Redirigiendo en 7 segundos...</h4>
	</div>
	</main>
<?php
	require_once("./capsulas/pie.php");
?>