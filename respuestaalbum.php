<?php
	$title = "Información del pedido";
	require_once("./capsulas/cabecera.php");
	include_once("./capsulas/conexion.php");

	$respuesta = array();
	require_once("./capsulas/validarsolicitud.php");

	if (!$respuesta){

				$nhojas = $ncop;
				if ($nhojas < 5){
					$costehoja = 0.1 * $nhojas;
				}
				elseif ($nhojas>4 && $nhojas<11) {
					$costehoja = 0.08 * $nhojas;
				}
				elseif ($nhojas>10) {
					$costehoja = 0.07 * $nhojas;
				}

				if ($impcol == "color"){
					$costehoja = $costehoja + ($nhojas * 0.05);
				}

				if ($resol >300){
					$costehoja = $costehoja + ($nhojas * 0.02);
				}


		$sentencia = "INSERT INTO solicitudes (Album, Nombre, Titulo, Descripcion, Email, Direccion, Color, Copias, Resolucion, Fecha, IColor, Coste) VALUES ('$album', '$nombre', '$titulo', '$descrip', '$email', '$direccion', '$col', '$ncop', '$resol', '$fecha', '$impcol', '$costehoja')";
		$consulta = mysqli_query($conn, $sentencia);
		$sentencia="SELECT * FROM albumes where '$album' = IdAlbum";		
		$consulta = mysqli_query($conn, $sentencia);
		if (mysqli_num_rows($consulta) > 0){
			$row = mysqli_fetch_object($consulta);
			$NomAlbum = $row->Titulo;
			mysqli_close($conn);
		}		
	}
	else{
		mysqli_close($conn);
		$error = serialize($respuesta);
		$error = urlencode($error);
		$extra = "solicitaralbum.php?err=";
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
		header('Refresh:7; URL= http://localhost/phi/misalbumes.php'); 
	}
	require_once("./capsulas/inicio.php");
	require_once("./capsulas/menureg.php");	

?>
	<main>
		<h2><?php echo $title; ?></h2>
		
		<p>Esta es la información asociada al álbum que acabas de solicitar:</p>
		
		<ul class="formulario">
			<li>
				<label for="nombre">Nombre: </label>
				<input type="text" name="nombre" id="nombre" disabled value="<?php echo $_POST["nombre"]; ?>"> 
			</li>
			<li>
				<label for="titulo">Título: </label>
				<input type="text" name="titulo" id="titulo" disabled value="<?php echo $_POST["titulo"]; ?>">
			</li>
			<li>
				<label for="textoad">Texto adicional: </label> 
				<textarea name="textoad" cols="30" rows="5" maxlength="4000" id="textoad" disabled><?php echo $_POST["textoad"]; ?></textarea>
			</li>
			<li>
				<label for="mail">Correo electrónico</label>
				<input type="email" name="mail" id="mail" disabled value="<?php echo $_POST["email"]; ?>">
			</li>
			<li>
				<label for="dir">Dirección</label>
				<input type="text" name="dir" id="dir" disabled value="<?php echo $_POST["dir"]; ?>">
				<input type="number" name="num" id="num" disabled value="<?php echo $_POST["num"]; ?>">
				<input type="text" name="cp" id="cp" value="<?php echo $_POST["cp"]; ?>" disabled>
				<input type="text" name="loc" id="loc" value="<?php echo $_POST["loc"]; ?>" disabled>
				<input type="text" name="provincia" id="provincia" placeholder="Provincia" maxlength="200" value="<?php echo $_POST["provincia"]; ?>" disabled>
				<br>
			</li>
			<li>
				<label for="col">Color de la portada</label>
				<input type="color" name="col" id="col" value="<?php echo $_POST["col"]; ?>" disabled>
			</li>
			<li>
				<label for="ncop">Número de copias</label>
				<input type="number" name="ncop" id="ncop" value="<?php echo $_POST["ncop"]; ?>" disabled>
			</li>
			<li>
				<label for="resol">Resolución de las fotos</label>
				<input type="text" name="resol" id="resol" value="<?php echo $_POST["resol"]; ?>" disabled> 
			</li>
			<li>
				<label for="album">Álbum de SharePic</label>
				<input type="text" name="album" id="album" value="<?php echo $NomAlbum ?>" disabled> 
			</li>
			<li>
				<label for="fecha">Fecha de recepción</label>
				<input type="text" name="fecha" id="fecha"  value="<?php echo $_POST["fecha"]; ?>" disabled> 
			</li>
			<li>
				<label for="impcol">Modo de impresión</label>
				<input type="text" name="impcol" id="impcol" disabled <?php echo "value="; if ($impcol==0) echo "BN"; else echo "Color"; echo ">"?>
			</li>
			<li>
			
				<p class="coste">Coste total: <?php echo "$costehoja €"  ?> </p>
			</li>
		</ul>

	</main>
<?php
	require_once("./capsulas/pie.php");
?>