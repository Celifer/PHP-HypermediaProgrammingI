<?php	
	$title = "Regístrate";

	require_once("./capsulas/cabecera.php");
	require_once("./capsulas/inicio.php");
	require_once("./capsulas/login.php");

	require_once("./capsulas/error.php"); 
?>
	<main>
	<h2><?php echo $title; ?></h2>
		<form action="respuestaregistro.php" method="post" enctype="multipart/form-data" class="formulario">
			<label for="user">Usuario:</label><br>
			<input type="text" name="usuario" id="user" required maxlength="15" minlength="3" placeholder="Sé creativo" autofocus >(*)<br>
			<label for="key">Contraseña:</label><br>
			<input type="password" name="contrasenya" id="key" required maxlength="15" minlength="6" placeholder="De 6 a 15 carácteres."  title="La contraseña debe contener una mayúscula, una minúscula y un número" >(*)<br>
			<label for="rkey">Repetir contraseña:</label><br>
			<input type="password" name="contrasenya2" id="rkey" required maxlength="15" minlength="6" placeholder="De 6 a 15 carácteres."  title="La contraseña debe contener una mayúsucla, una minúsucla y un número">(*)<br>
			<label for="mail">Dirección de correo electrónico:</label><br>
			<input type="email" name="email" id="mail" required placeholder="ejemplo@email.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">(*)<br>
			<label for="sex">Sexo:</label><br>
			<input type="radio" name="sexo" value="1" id="sex" checked>Hombre<br>
			<input type="radio" name="sexo" value="2" >Mujer<br>
			<label for="birth">Fecha de nacimiento:</label><br>
			<input type="date" name="nacimiento" id="birth" required>(*)<br>
			<label for="city">Ciudad:</label><br>
			<input type="text" name="ciudad" id="city" required >(*)<br>
			<label for="pais">País:</label><br>
			<select name="pais" id="cnt" required >
				<?php
					require_once("./capsulas/paises.php");
					mysqli_close($conn);
				?>
			</select><br>
			<label for="img">Foto:</label><br>
			<input type="file" name="foto" id="img">Las fotos mayores de 2MB no se subirán.<br><br>
			<input type="submit" value="Continuar" class="send" name="submit">
		</form>
	</main>
<?php
	require_once("./capsulas/pie.php");
?>