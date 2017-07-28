<?php
	$title = "Encuentra la foto que buscas:";
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
		<h2 ><?php echo $title; ?></h2>
		<form action="resultadobusqueda.php" method="GET" class="formulario">
			<label for="tit">Título:</label><br>
			<input type="search" name="titulo" id="tit"><br>
			<label for="dat">Fecha entre:</label>
			<input type="date" name="fechai" id="dat">
			<label for="dat1">y:</label>
			<input type="date" name="fechaf" id="dat1"><br>
			<label for="cnt">País:</label><br>
			<select name="pais" id="cnt">
				<option value="0" selected>Todos</option>
				<?php
					require_once("./capsulas/paises.php");
					mysqli_close($conn);
				?>
			</select><br><br>
			<input type="submit" value="Encontrar">
		</form>
	</main>
<?php
	require_once("./capsulas/pie.php");
?>