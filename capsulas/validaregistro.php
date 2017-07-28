<?php
		if (isset($_POST["usuario"])){
			$usuario = trim(mysqli_real_escape_string($conn, $_POST["usuario"]));
			$usuario = filter_var($usuario, FILTER_SANITIZE_STRING);
			$expreg=stripslashes("^[A-Za-z0-9]{3,15}$");
			if(preg_match('/' . $expreg . '/', $usuario) === 0){
				$respuesta[] ="El nombre debe tener entre 3 y 15 caracteres alfabéticos y números."; 
			}
		}
		else{
			$respuesta[] = "Debes completar el campo Usuario.";
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


		if (isset($_POST["sexo"])){
			$sexo = trim(mysqli_real_escape_string($conn, $_POST["sexo"]));
			$sexo = filter_var($sexo, FILTER_SANITIZE_NUMBER_INT);
		}
		else{
			$respuesta[] = "Debes elegir un sexo.";
		}


		if (isset($_POST["contrasenya"])){
			$contra = trim(mysqli_real_escape_string($conn, $_POST["contrasenya"]));
			$contra = filter_var($contra, FILTER_SANITIZE_STRING);
			$expreg=stripslashes("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[A-Za-z0-9_]{6,15}$");
			if(preg_match('/' . $expreg . '/', $contra) === 0){
				$respuesta[] ="La contraseña debe tener entre 6 y 15 caracteres, una mayúscula, una letra minúscula y al menos un número."; 
			}
			
		}
		else{
			$respuesta[] = "Debes completar el campo Contraseña.";
		}


		if (isset($_POST["contrasenya2"])){
			$contra2 = trim(mysqli_real_escape_string($conn, $_POST["contrasenya2"]));
			$contra2 = filter_var($contra2, FILTER_SANITIZE_STRING);
			if ($contra!=$contra2){
				$respuesta[] ="Ambas contraseñas deben coincidir."; 
			}
			
		}
		else{
			$respuesta[] = "Debes repetir la contraseña.";
		}


		if (isset($_POST["nacimiento"])){
			$nacimiento = trim(mysqli_real_escape_string($conn, $_POST["nacimiento"]));
			//$expreg = "/^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$/"; EXP ORIGINAL
			//$expreg = "/^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$/"; //ORDEN ALTERADO
			$nac_array = explode('-', $nacimiento);
			$t=time();
			if (count($nac_array)==3) {
				if (!checkdate($nac_array[1], $nac_array[2], $nac_array[0])){
					$respuesta[] = "Formato de fecha incorrecto.";
				}
				elseif (strtotime(date("Y-m-d",$t))<strtotime($nacimiento)){
					$respuesta[] = "Introduce una fecha anterior a la actual.";
				}			
			}
		}
		else{
			$respuesta[] = "Debes introducir tu fecha de nacimiento.";
		}


		if (isset($_POST["ciudad"])){
			$ciudad = trim(mysqli_real_escape_string($conn, $_POST["ciudad"]));
			$ciudad = filter_var($ciudad, FILTER_SANITIZE_STRING);
		}
		else{
			$ciudad = "";
		}
		
		if (isset($_POST["pais"])){
			$pais = trim(mysqli_real_escape_string($conn, $_POST["pais"]));
			$pais = filter_var($pais, FILTER_SANITIZE_NUMBER_INT);
		}
		else{
			$pais = "";
		}
		
		
		if(isset($_FILES['foto']['tmp_name']) && is_file($_FILES['foto']['tmp_name'])){
			require_once ("validarimg.php");
			if (isset($fichero))
				$foto = $fichero;
			else
				$foto = "";
		}
		else{
			$foto = "";
		}
?>