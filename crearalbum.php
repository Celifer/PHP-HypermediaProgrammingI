<?php
	$title = "Crear álbum";
	require_once("./capsulas/cabecera.php");
	if (!isset($_SESSION["usuario"])){
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("Location: http://$host$uri/index.php");
	}
	require_once("./capsulas/inicio.php");
	require_once("./capsulas/menureg.php");	

	require_once("./capsulas/error.php");
	
?>
<main>
	<h2><?php echo $title; ?></h2>
	<form class="formulario" method="POST" action="respuestacrearalbum.php">
		<label for="titulo">Título:</label><br>
		<input type="text" name="titulo" id="titulo" required placeholder="Sé creativo" autofocus>(*)<br>
		<label for="descrip">Descripción:</label><br>
		<textarea name="descrip" cols="30" rows="5" maxlength="4000" placeholder="Escribe de qué va tu álbum" id="descrip"></textarea><br>
		<label for="fecha">Fecha:</label><br>
		<input type="date" name="fecha" id="fecha"><br>
		<label for="cnt">País:(*)</label><br>
		<select name="pais" id="cnt" required>
			<?php
				require_once("./capsulas/paises.php");
				mysqli_close($conn);
			?>
		</select><br>
			<input type="submit" value="Continuar" class="send">
	</form>	
</main>
<?php
	require_once("./capsulas/pie.php");
?>