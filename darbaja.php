<?php
	$title = "Darme de baja";
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
		<form action="confirmaBaja.php"  class="formulario" method="POST">
			Solicitud de baja del usuario <?php echo $_SESSION["usuario"]; ?>. <br>
			<?php 
				if (isset($_GET["error"]) && $_GET["error"]==true)
					echo "<span>Se ha cometido un error al procesar su solicitud. Vuélvalo a intentar.</span>";
			?>
				<input type="submit" class="send" value="Confirmar baja"/>
		</form>
		

</main>
<?php
	require_once("./capsulas/pie.php");
?>