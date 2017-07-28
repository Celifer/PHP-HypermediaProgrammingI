<?php
	$title = "Resultados de búsqueda";
	require_once("./capsulas/cabecera.php");
	require_once("./capsulas/inicio.php");
	if (isset($_SESSION["usuario"])){
		require_once ("./capsulas/menureg.php");
	}
	else{
		require_once("./capsulas/login.php");
	}
?>
<main>
	<?php
		$titulo = $fechai = $fechaf = $pais= $nomPais = "";
		$titulo = $_GET["titulo"];
		$fechai = $_GET["fechai"];
		$fechaf = $_GET["fechaf"];
		$pais = $_GET["pais"];

		require_once("./capsulas/conexion.php");
		$sentencia = "SELECT * FROM paises where $pais=paises.IdPais";
		$consulta = mysqli_query($conn, $sentencia);
		if (mysqli_num_rows($consulta) > 0) {
			$row = mysqli_fetch_object($consulta);
			$nomPais = $row->NomPais;
		}
	?>
	<h2><?php echo $title; ?></h2>
			<h3 id="subtit">Criterios de búsqueda</h3>
		<form class="formulario">
			<label for="tit">Título:</label><br>
			<input type="text" name="titulo" value="<?php echo $titulo;?>" id="tit" readonly><br>
			<label for="dat">Fecha:</label><br>
			<input type="date" name="fechai" value="<?php echo $fechai?>" id="dat" readonly>
			<label for="dat1">hasta</label>
			<input type="date" name="fechaf" value="<?php echo $fechaf;?>" id="dat1" readonly><br>
			<label for="cnt">País:<br></label>
			<input type="text" name="cnt" value="<?php echo $nomPais;?>" id ="cnt" readonly><br>
			
		</form>
	<ul>
		<?php
			
			$sentencia = "SELECT * FROM `fotos`, `paises`  where fotos.Pais = paises.IdPais";

			if ($titulo!="")
				$sentencia.= " and fotos.Titulo like '%$titulo%'";
			if ($fechai!="")
				$sentencia.= " and fotos.Fecha>'$fechai'";
			if ($fechaf!="")
				$sentencia.= " and fotos.Fecha<'$fechaf'";
			if ($pais!=0)
				$sentencia.= " and fotos.Pais =$pais";			
		
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