<?php
	$title = "Mis albumes";
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
	<ul>
		<?php
		$user = $_SESSION["usuario"];
			require_once("./capsulas/conexion.php");
			$sentencia = "SELECT IdAlbum, titulo, descripcion FROM `albumes`, `usuarios`  where albumes.Usuario = usuarios.IdUsuario and usuarios.NomUsuario = '$user'";		
			$consulta = mysqli_query($conn, $sentencia);
			if (mysqli_num_rows($consulta) > 0) {
				while ($row = mysqli_fetch_object($consulta)) {
					echo "<ul class=cuadrocont>";
						echo "<li><strong>Titulo:</strong><a href=veralbum.php?i=".$row->IdAlbum.">".$row->titulo."</a></li><br>";
						echo "<li ><strong>Descripción:</strong><i>".$row->descripcion."</i></li>";	
					echo "</ul>";

				}
			}
			mysqli_close($conn);
		?>
	</ul>	
</main>
<?php
	require_once("./capsulas/pie.php");
?>