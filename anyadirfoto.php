<?php
	$title = "Añadir foto a album";
	require_once("./capsulas/cabecera.php");
	if (!isset($_SESSION["usuario"])){
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("Location: http://$host$uri/index.php");
	}
	require_once("./capsulas/inicio.php");
	require_once("./capsulas/menureg.php");
	include_once("./capsulas/conexion.php");
	require_once("./capsulas/error.php"); 
?>
<main>
	<h2><?php echo $title; ?></h2>
	<form action="respuestaanyadir.php" method="POST" enctype="multipart/form-data" class="modificarinfusu">
			<h3 class="tituloform">Información de la foto</h3><br><br>
			<label for="titulo">Titulo:</label><br>
			<input type="text" name="titulo" id="titulo" required placeholder="Titulo de la foto"><br>
			<label for="descrip">Descripción:</label><br>
			<textarea name="descrip" cols="30" rows="5" maxlength="4000" placeholder="Escribe de qué va tu foto" id="descrip"></textarea><br>
			<label for="birth">Fecha de la foto:</label><br>
			<input type="date" name="fecha" id="date" required><br>
			<label for="cnt">País:</label><br>
			<select name="pais" id="cnt" required>
				<?php
					include("./capsulas/paises.php");
				?>
			</select><br>
			<label for="album">Album:</label><br>
			<select name="album" id="cnt" required >
				<?php
					include("./capsulas/albumes.php");
					mysqli_close($conn);
				?>
			</select><br>
			<label for="img">Foto:</label><br>
			<input type="file" name="foto" id="img">Las fotos mayores de 2MB no se subirán.<br><br>
			<input type="submit" class="send" value="Continuar" name="submit">
		</form>
</main>
<?php
	require_once("./capsulas/pie.php");
?>