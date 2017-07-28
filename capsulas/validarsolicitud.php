<?php 
	if (isset($_POST["nombre"])){
		$nombre = trim(mysqli_real_escape_string($conn, $_POST["nombre"]));
		$nombre= filter_var($nombre, FILTER_SANITIZE_STRING);
	}
	else{
		$respuesta[] = "Debes completar el campo Nombre.";
	}

	if (isset($_POST["titulo"])){
		$titulo = trim(mysqli_real_escape_string($conn, $_POST["titulo"]));
		$titulo= filter_var($titulo, FILTER_SANITIZE_STRING);
	}
	else{
		$respuesta[] = "Debes completar el campo Titulo.";
	}


	if (isset($_POST["textoad"])){
		$descrip = trim(mysqli_real_escape_string($conn, $_POST["textoad"]));
	}
	else{
		$descrip = "";
	}

	if (isset($_POST["email"])) {
			$email = trim(mysqli_real_escape_string($conn, $_POST["email"]));
			$email = filter_var($email, FILTER_SANITIZE_EMAIL);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  				$respuesta[] = "Formato de email no válido."; 
			}
		}
		else{
			$respuesta[] = "Debes completar el campo Email.";
	}

	if (isset($_POST["dir"])){
			$dir = trim(mysqli_real_escape_string($conn, $_POST["dir"]));
			$dir = filter_var($dir, FILTER_SANITIZE_NUMBER_INT);
			$direccion = $dir;
			$direccion.= " ";
		}
		else{
			$respuesta[] = "Debes completar la dirección.";
		}

	if (isset($_POST["num"])){
			$num = trim(mysqli_real_escape_string($conn, $_POST["num"]));
			$num = filter_var($num, FILTER_SANITIZE_NUMBER_INT);
			$direccion .= $num;
			$direccion.= " ";
		}
		else{
			$num ="";
		}

	if (isset($_POST["cp"])){
			$cp = trim(mysqli_real_escape_string($conn, $_POST["cp"]));
			$cp = filter_var($cp, FILTER_SANITIZE_NUMBER_INT);
			$direccion .= $cp;
			$direccion.= " ";
		}
		else{
			$respuesta[] = "Debes escribir un código postal.";
		}

	if (isset($_POST["loc"])){
		$loc = trim(mysqli_real_escape_string($conn, $_POST["loc"]));
		$loc= filter_var($loc, FILTER_SANITIZE_STRING);
		$direccion .= $loc;
		$direccion.= " ";
	}
	else{
		$respuesta[] = "Debes completar el campo Localidad.";
	}

	if (isset($_POST["provincia"])){
		$provincia = trim(mysqli_real_escape_string($conn, $_POST["provincia"]));
		$provincia= filter_var($provincia, FILTER_SANITIZE_STRING);
		$direccion .= $provincia;
	}
	else{
		$respuesta[] = "Debes completar el campo Provincia.";
	}



	if (isset($_POST["tel"])){
			$tel = trim(mysqli_real_escape_string($conn, $_POST["tel"]));
			$tel = filter_var($tel, FILTER_SANITIZE_NUMBER_INT);
		}
		else{
			$respuesta[] = "Debes completar el campo Téléfono.";
		}

	if (isset($_POST["col"])){
		$col = trim(mysqli_real_escape_string($conn, $_POST["col"]));
		$col= filter_var($col, FILTER_SANITIZE_STRING);
	}
	else{
		$col = "black";
	}

	if (isset($_POST["ncop"])){
			$ncop = trim(mysqli_real_escape_string($conn, $_POST["ncop"]));
			$ncop = filter_var($ncop, FILTER_SANITIZE_NUMBER_INT);
		}
		else{
			$respuesta[] = "Debes completar el campo Número de copias.";
		}

	if (isset($_POST["resol"])){
			$resol = trim(mysqli_real_escape_string($conn, $_POST["resol"]));
			$resol = filter_var($resol, FILTER_SANITIZE_NUMBER_INT);
		}

	if (isset($_POST["album"])){
		$album = trim(mysqli_real_escape_string($conn, $_POST["album"]));
		if ($album == 0)
			$respuesta [] ="Debes crear un álbum primero";
	}
	else{
		$respuesta[] = "Debes seleccionar un álbum";
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
		$respuesta[] = "Debes introducir una fecha";
	}

	if (isset($_POST["impcol"])){
			$impcol = trim(mysqli_real_escape_string($conn, $_POST["impcol"]));
			$impcol = filter_var($impcol, FILTER_SANITIZE_NUMBER_INT);
		}
		else{
			$respuesta[] = "Debes elegir un modo de impresión.";
		}

?>