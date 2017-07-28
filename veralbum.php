<?php
	$title = "Ver album";
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
		$id = $_GET['i'];
		$user = $_SESSION["usuario"];
		require_once("./capsulas/conexion.php");
		$sentencia = "SELECT * FROM `albumes`,`fotos`, `usuarios`, `paises`  WHERE fotos.Album = albumes.IdAlbum and albumes.Usuario = usuarios.IdUsuario and usuarios.NomUsuario = '$user' and fotos.Pais=paises.IdPais and albumes.IdAlbum = '$id'";		
		$consulta = mysqli_query($conn, $sentencia);
		if (mysqli_num_rows($consulta) > 0) {
			while ($row = mysqli_fetch_object($consulta)) {
				echo "<li class=cuadrocont>";
					echo "<a href=detalleimg.php?valor=".$row->IdFoto.">";
					echo "<img src=".$row->Fichero.">";
					echo "</a>";
					echo "<ul class=elem>";
					echo "<li><strong>Título:</strong><i>".$row->Titulo."</i></li>";
					echo "<li><strong>Fecha:</strong><i>".$row->Fecha."</i></li>";
					echo "<li><strong>Pais:</strong><i>".$row->NomPais."</i></li>";
					echo "</ul></li>";
			}
		}
		mysqli_close($conn);
	?>
	</ul>
</main>
<?php
	require_once("./capsulas/pie.php");
?>