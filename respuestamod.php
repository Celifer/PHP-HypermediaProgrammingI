<?php	
	$title = "Modificación correcta";

	require_once("./capsulas/cabecera.php");
	include_once("./capsulas/conexion.php");
	$respuesta = array();
		
	require_once("./capsulas/validaregistro.php");
	$id = $_SESSION["ident"];
	$sentencia="SELECT * FROM paises where '$pais' = IdPais";		
	$consulta = mysqli_query($conn, $sentencia);
	if (mysqli_num_rows($consulta) > 0){
		$row = mysqli_fetch_object($consulta);
		$NomPais = $row->NomPais;
	}

	if (isset($fichero) && isset($_POST["borrafoto"])){
		$respuesta[] = "No puede subir una foto y eliminarla al mismo tiempo.";
	}

	if (!$respuesta){
		if ($foto == ""){
			if (isset($_POST["borrarfoto"])){
				$sentencia = "SELECT Foto FROM usuarios WHERE IdUsuario = '$id'";
				$consulta = mysqli_query($conn, $sentencia);
				if (mysqli_num_rows($consulta) > 0){
					$row = mysqli_fetch_object($consulta);
					$ruta = $row->Foto;
					unlink($ruta);
				}
				$sentencia = "DELETE Foto FROM usuarios WHERE IdUsuario = '$id'";
				$consulta = mysqli_query($conn, $sentencia);			
			}
			else{
				$sentencia = "SELECT Foto FROM usuarios WHERE IdUsuario = '$id'";
				$consulta = mysqli_query($conn, $sentencia);
				if (mysqli_num_rows($consulta) > 0){
					$row = mysqli_fetch_object($consulta);
					$foto = $row->Foto;
				}
			}	
		}
		$sentencia = "UPDATE usuarios SET NomUsuario = '$usuario', Clave = '$contra', Email = '$email', Sexo = '$sexo', FNacimiento = '$nacimiento', Ciudad = '$ciudad', Pais = '$pais', Foto = '$foto' WHERE IdUsuario = '$id'";
		$consulta = mysqli_query($conn, $sentencia);

		$sentencia="SELECT IdUsuario FROM usuarios where NomUsuario = '$usuario' and Clave = '$contra'";
		$consulta = mysqli_query($conn, $sentencia);
		if (mysqli_num_rows($consulta) > 0){
			$row = mysqli_fetch_object($consulta);
			$_SESSION["usuario"] = $usuario;
		}
	}
	else{
		$error = serialize($respuesta);
		$error = urlencode($error);
		$extra = "modificardatos.php?err=";
		$host = $_SERVER['HTTP_HOST'];
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
		header('Refresh:5; URL= http://localhost/phi/micuenta.php'); 
	}
	require_once("./capsulas/inicio.php");
	require_once("./capsulas/menureg.php");
	
?>

<main>
	<h2><?php echo $title; ?></h2>
	<?php 
		$sentencia2 = "SELECT * FROM usuarios where NomUsuario = '$usuario'";
		$consulta2 = mysqli_query($conn, $sentencia2);
		if (mysqli_num_rows($consulta2) > 0){
			$row = mysqli_fetch_object($consulta2);
			$nom = $row->NomUsuario;
			$mal = $row->Email;
			$sex = $row->Sexo;
			$dat = $row->FNacimiento;
			$ciu = $row->Ciudad;
			$fot = $row->Foto;		
		}
		mysqli_close($conn);
	?>
	<form  class="respregistro">
		Usuario:
		<?php if(isset($nom)) echo $nom; ?><br>
		Dirección de correo electrónico:
		<?php if(isset($mal)) echo $mal; ?><br>
		Sexo:
		<?php if(isset($sex)){ if($sex == 1)echo "Hombre"; else echo "Mujer";} ?><br>
		Fecha de nacimiento:
		<?php if(isset($dat)) echo $dat; ?><br>
		Ciudad:
		<?php if(isset($ciu)) echo $ciu; ?><br>
		País:
		<?php if(isset($NomPais)) echo $NomPais; ?><br>
		Foto:
		<?php if(isset($fot)) echo "<img src=".$row->Foto." width=200 px height=200 px>"; ?> <br>
		<h4> Redirigiendo en 5 segundos...</h4>
	</form>
</main>
<?php
	require_once("./capsulas/pie.php");
?>