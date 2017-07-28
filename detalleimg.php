<?php
	$title = "Detalle imagen";
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
	<div class="cuadrocontdet">
		<?php
			$id = $_GET['valor'];
			require_once("./capsulas/conexion.php");
			$sentencia = "SELECT *, f.titulo as TituloFoto, a.Titulo as TituloAlbum FROM albumes a, fotos f, paises p, usuarios u where f.Album = a.IdAlbum and IdFoto=$id and p.IdPais = f.Pais and a.Usuario = u.IdUsuario";

			$consulta = mysqli_query($conn, $sentencia);
			while ($row = mysqli_fetch_object($consulta)) {
				echo "<a href=detalleimg.php?valor=".$row->IdFoto.">";
				echo "<img src=".$row->Fichero.">";
				echo "</a>";
				echo "<ul class=elemdet>";
				echo "<li><strong>Título:</strong><i>".$row->TituloFoto."</i></li>";
				echo "<li><strong>Fecha:</strong><i>".$row->Fecha."</i></li>";
				echo "<li><strong>Pais:</strong><i>".$row->NomPais."</i></li>";
				echo "<li><strong>Álbum:</strong><i>".$row->TituloAlbum."</i></li>";
				echo "<li><strong>Usuario:</strong><i>".$row->NomUsuario."</i></li>";
				echo "</ul>";
				}
			mysqli_close($conn);				
		?>		
	</div>
</main>
<?php
	require_once("./capsulas/pie.php");
?>