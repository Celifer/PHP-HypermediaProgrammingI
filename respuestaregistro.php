<?php	
	$title = "Registro correcto";

	require_once("./capsulas/cabecera.php");
	include_once("./capsulas/conexion.php");
	$respuesta = array();
		
	require_once("./capsulas/validaregistro.php");

	$sentencia="SELECT * FROM paises where '$pais' = IdPais";		
	$consulta = mysqli_query($conn, $sentencia);
	if (mysqli_num_rows($consulta) > 0){
		$row = mysqli_fetch_object($consulta);
		$NomPais = $row->NomPais;
	}

	if (!$respuesta){
		$sentencia = "INSERT INTO usuarios (NomUsuario, Clave, Email, Sexo, FNacimiento, Ciudad, Pais, Foto) VALUES ('$usuario', '$contra', '$email', '$sexo', '$nacimiento', '$ciudad', '$pais', '$foto')";
		$consulta = mysqli_query($conn, $sentencia);
		$sentencia="SELECT IdUsuario FROM usuarios where NomUsuario = '$usuario' and Clave = '$contra'";
		$consulta = mysqli_query($conn, $sentencia);
		if (mysqli_num_rows($consulta) > 0){
			$row = mysqli_fetch_object($consulta);
			$_SESSION["ident"] = $row->IdUsuario;
			$_SESSION["usuario"] = $usuario;
		}
	}
	else{
		$error = serialize($respuesta);
		$error = urlencode($error);
		$extra = "registro.php?err=";
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
		header('Refresh:5; URL= http://localhost/phi/index.php'); 
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
	<div  class="respregistro">
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
		<?php if(isset($fot)) echo "<img src=".$row->Foto.">"; ?> <br>
		<h4> Redirigiendo en 5 segundos...</h4>
	</div>
</main>
<?php
	require_once("./capsulas/pie.php");
?>