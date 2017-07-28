<?php
	$title = "Mi cuenta";
	require_once("./capsulas/cabecera.php");
	if (!isset($_SESSION["usuario"])){
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("Location: http://$host$uri/index.php");
	}
	require_once("./capsulas/inicio.php");
	require_once("./capsulas/menureg.php");
?>
	<main>
		<h2><?php echo $title; ?></h2>
		<ul class="listbotones">
			<li class="boton"><a href="misalbumes.php">Mis álbumes</a></li>
			<li class="boton"><a href="crearalbum.php">Crear album</a></li>
			<li class="boton"><a href="anyadirfoto.php">Añadir foto a album</a></li>
			<li class="boton"><a href="solicitarAlbum.php">Solicitar album</a></li>
			<li class="boton"><a href="modificardatos.php">Modificar mis datos</a></li>
			<li class="boton"><a href="darbaja.php">Darme de baja</a></li>
		</ul>		
	</main>
<?php
	require_once("./capsulas/pie.php");
?>