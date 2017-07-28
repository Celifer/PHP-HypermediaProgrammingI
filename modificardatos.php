<?php
	$title = "Modificar datos";
	require_once("./capsulas/cabecera.php");
	if (!isset($_SESSION["usuario"])){
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("Location: http://$host$uri/index.php");
	}
	require_once("./capsulas/inicio.php");
	require_once("./capsulas/menureg.php");

	require_once("./capsulas/error.php")
?>
	<main>
		<h2><?php echo $title; ?></h2>

		<?php
			include_once("./capsulas/conexion.php");
			
			$id = $_SESSION["ident"];
			$sentencia="SELECT * FROM usuarios where IdUsuario = '$id'";
			$consulta = mysqli_query($conn, $sentencia);
			if (mysqli_num_rows($consulta) > 0){
				$row = mysqli_fetch_object($consulta);
				$s = $row->Sexo;
				$CDPais = $row->Pais;
				$fo = $row->Foto;
			}
			
		 ?>
		<form action="respuestamod.php" method="post" enctype="multipart/form-data" class="formulario">
			<label for="user">Usuario:</label><br>
			<input type="text" name="usuario" id="user"  autofocus <?php echo "value=".$row->NomUsuario.">"; ?>(*)<br>
			<label for="key">Contraseña:</label><br>
			<input type="password" name="contrasenya" id="key"  placeholder="De 6 a 15 carácteres."  title="La contraseña debe contener una mayúscula, una minúscula y un número" <?php echo "value=" .$row->Clave.">" ; ?>(*)<br>
			<label for="rkey">Repetir contraseña:</label><br>
			<input type="password" name="contrasenya2" id="rkey" title="La contraseña debe contener una mayúscula, una minúscula y un número" <?php echo "value=" .$row->Clave.">" ; ?><br>
			<label for="mail">Dirección de correo electrónico:</label><br>
			<input type="email" name="email" id="mail" placeholder="ejemplo@email.com" <?php echo "value=" .$row->Email.">" ; ?>(*)<br>
			<label for="sex">Sexo:</label><br>
			<input type="radio" name="sexo" value="1" id="sex" <?php if ($s ==1) echo "checked"; ?>>Hombre<br>
			<input type="radio" name="sexo" value="2" <?php if ($s ==2) echo "checked"; ?>>Mujer<br>
			<label for="birth">Fecha de nacimiento:</label><br>
			<input type="date" name="nacimiento" id="birth" <?php echo "value=" .$row->FNacimiento.">" ; ?>(*)<br>
			<label for="city">Ciudad:</label><br>
			<input type="text" name="ciudad" id="city" <?php echo "value=" .$row->Ciudad.">" ; ?>(*)<br>
			<label for="pais">País:</label><br>
			<select name="pais" id="cnt" >			
				<?php
					require_once("./capsulas/paises.php");
					mysqli_close($conn);
				?>
			</select><br>
			<label for="img">Foto:</label><br>
			<input type="file" name="foto" id="img"><br>Las fotos mayores de 2MB no se subirán.<br> 
			<?php if ($fo!="") echo "<img src=".$fo." width=200 px height=200 px>"; ?><br>
			<input type="checkbox" name="borrarfoto" value="1"> Eliminar foto de perfil<br><br>
			<input type="submit" value="Continuar" class="send" name="submit">
		</form>

	</main>
<?php
	require_once("./capsulas/pie.php");
?>