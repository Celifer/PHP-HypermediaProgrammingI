<?php
	$title = "Últimas fotos añadidas...";

	require_once("./capsulas/cabecera.php");
	require_once("./capsulas/inicio.php");
	if (isset($_SESSION["usuario"])){
		require_once ("./capsulas/menureg.php");
	}
	else if(isset($_COOKIE["nomusuario"]) && !isset($_SESSION["usuario"])){
		require_once ("./capsulas/menucookie.php");
	}
	else{
		require_once("./capsulas/login.php");
	}	
?>
	<main>
		<?php
			$fichero = fopen("seleccionadas.txt", "r");
			$lineas = array();
			while(!feof($fichero))  
				$lineas[] = fgets($fichero);
			$aleatorio = mt_rand (0, count($lineas)-1);
			$trozos = explode('-', $lineas[$aleatorio]);
			$foto = $trozos[0];
			$nombre = $trozos[1];
			$comentario = $trozos[2];
			fclose($fichero);
		
			require_once("./capsulas/conexion.php");
			$sentencia = "SELECT *, f.titulo as TituloFoto, a.Titulo as TituloAlbum FROM albumes a, fotos f, paises p, usuarios u where f.Album = a.IdAlbum and IdFoto='$foto' and p.IdPais = f.Pais and a.Usuario = u.IdUsuario";
			$consulta = mysqli_query($conn, $sentencia);
			if (mysqli_num_rows($consulta) > 0) {
				$row = mysqli_fetch_object($consulta);
				echo "<h2>Imagen seleccionada</h2>";
				echo "<div class=cuadrocontdet>";
				echo "<a href=detalleimg.php?valor=".$row->IdFoto.">";
				echo "<img src=".$row->Fichero.">";
				echo "</a>";
				echo "<ul class=elemdet>";
				echo "<li><strong>Crítico:</strong><i>".$nombre."</i></li>";
				echo "<li><strong>Comentario:</strong><i>".$comentario."</i></li>";
				echo "<li><strong>Título:</strong><i>".$row->TituloFoto."</i></li>";
				echo "<li><strong>Fecha:</strong><i>".$row->Fecha."</i></li>";
				echo "<li><strong>Pais:</strong><i>".$row->NomPais."</i></li>";
				echo "<li><strong>Álbum:</strong><i>".$row->TituloAlbum."</i></li>";
				echo "<li><strong>Usuario:</strong><i>".$row->NomUsuario."</i></li>";
				echo "</ul>";
				echo "</div>";
			}
		?>
		<h2><?php echo $title; ?></h2>
		<ul class="indul">
			<?php
				$sentencia = "SELECT * FROM `fotos`, `paises`  where fotos.Pais = paises.IdPais order by fotos.FRegistro desc limit 5";
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
