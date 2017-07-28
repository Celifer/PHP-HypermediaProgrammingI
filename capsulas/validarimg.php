<?php 
	if(isset($_POST["submit"])) {
		if (isset($_POST["titulo"])){
			$directorio = "./imgs/fotos/";
			$usu = $_SESSION["usuario"];
			$fichero = $directorio . $usu . "_" . time('H:m:s') . "_" . basename($_FILES["foto"]["name"]);
		}
		elseif (isset($_POST["usuario"])){
			$directorio = "./imgs/perfil/";	
			$f = basename($_FILES["foto"]["name"]);
			if (isset($_SESSION["usuario"])){
				$usuv = $_SESSION["usuario"];
				$fic = $directorio . $usuv .  "_." . pathinfo($f, PATHINFO_EXTENSION);
			}
			$usu = $_POST["usuario"];
			$fichero = $directorio . $usu .  "_." . pathinfo($f, PATHINFO_EXTENSION);	
		}

		
		$extension = pathinfo($fichero,PATHINFO_EXTENSION);

	    if(empty(getimagesize($_FILES["foto"]["tmp_name"])))
	   		$respuesta[] = "El fichero seleccionado no es una imagen.";

	   	if (mb_strlen(basename($_FILES["foto"]["name"]),"UTF-8") > 225)
	   		$respuesta[] = "El fichero tiene un nombre demasiado largo.";

	   	if ($_FILES["foto"]["size"] > 2097152) 
    		$respuesta[] = "El fichero es demasiado grande.";	

		if (isset($fic) && file_exists($fic))
			unlink($fic);		
			
		if($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif") 
			$respuesta[] = "Solo se admiten los formatos jpg, png, jpeg y gif.";

		if (!$respuesta) {
			if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $fichero))
				$respuesta[] = "Ha sucedido un error al intentar subir el fichero."	;	
		}   			
	}
?>