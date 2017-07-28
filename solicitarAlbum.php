<?php
	$title = "Solicitud de impresión de álbum";
	require_once("./capsulas/cabecera.php");
	if (!isset($_SESSION["usuario"])){
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("Location: http://$host$uri/index.php");
	}
	require_once("./capsulas/inicio.php");
	require_once("./capsulas/menureg.php");
	include_once("./capsulas/conexion.php");
	require_once("./capsulas/error.php");
?>
	<main>
		<h2><?php echo $title; ?></h2>
		<p>Mediante este formulario conseguirás tener en tus manos el álbum que deseas. A la izquierda se sitúan los precios y a la derecha los datos que debes introducir.</p>
		<ul class="solicitud">
			<li id="tarif">
				<h3>Tarifas</h3><br>
				<table>
					<tr>
						<th>Concepto</th>
						<th>Tarifa</th>
					</tr>
					<tr>
						<td>< 5 páginas</td>
						<td>0.10 € por pág.</td>
					</tr>
					<tr>
						<td>Entre 5 y 10 páginas</td>
						<td>0.08 € por pág.</td>
					</tr>
					<tr>
						<td>> 11 páginas</td>
						<td>0.07 € por pág.</td>
					</tr>
					<tr>
						<td>Blanco y negro</td>
						<td>0 €</td>
					</tr>
					<tr>
						<td>Color</td>
						<td>0.05 € por foto</td>
					</tr>
					<tr>
						<td>Resolución > 300 dpi</td>
						<td>0.02 € por foto</td>
					</tr>
				</table>
			</li>
			<li id="formu">
				<form action="respuestaalbum.php" method="post" class="formulariosol">
					<fieldset>
						<legend><h3 class="tituloform">Formulario de solicitud</h3></legend>
						Rellena el siguiente formulario aportando todos los detalles para confeccionar tu álbum.<br>
						<ul>
							<li>
								<label for="nombre">Nombre</label>
								<input type="text" name="nombre" id="nombre" placeholder="Tu nombre y apellidos" maxlength="200" required> (*)
							</li>
							<li>
								<label for="titulo">Título</label>
								<input type="text" name="titulo" id="titulo" required placeholder="Para la portada" maxlength="200"> (*)
							</li>
							<li>
								<label for="textoad">Texto adicional</label> <!-- Esto es un textarea -->
								<textarea name="textoad" cols="30" rows="5" maxlength="4000" placeholder="Descripción o dedicatoria" id="textoad"></textarea>
							</li>
							<li>
								<label for="email">Correo electrónico</label>
								<input type="email" name="email" id="mail" required placeholder="ejemplo@email.com" maxlength="200" required> (*)
							</li>
							<li>
								<label for="dir">Dirección</label>
								<input type="text" name="dir" id="dir" placeholder="Nombre de calle" maxlength="200" required>
								<input type="number" name="num" id="num" placeholder="Número (s/n por defecto)" maxlength="5" min="1">
								<input type="text" name="cp" id="cp" placeholder="Código postal" maxlength="5" required pattern="((0[1-9]|5[0-2])|[1-4][0-9])[0-9]{3}">
								<input type="text" name="loc" id="loc" placeholder="Localidad" maxlength="200" required>
								<input type="text" name="provincia" id="provincia" placeholder="Provincia" maxlength="200" required>
								
							</li>
							<li>
								<label for="tel">Teléfono</label>
								<input type="tel" name="tel" id="tel" placeholder="Para poder contactar contigo"  required>
							</li>
							<li>
								<label for="col">Color de la portada</label>
								<input type="color" name="col" id="col" value="black">
							</li>
							<li>
								<label for="ncop">Número de copias</label>
								<input type="number" name="ncop" id="ncop" value="1" min="1" required> (*)
							</li>
							<li>
								<label for="resol">Resolución de las fotos</label>
								<input type="range" name="resol" id="resol" value="150" min="150" max="900" step="150" oninput="resolout.value=resol.value"> 
								<output name="resolout" id="resolout">150</output>
							</li>
							<li>
								<label for="album">Álbum de SharePic</label>
								<select name="album" id="cnt" required >
									<?php
										include("./capsulas/albumes.php");
										mysqli_close($conn);
									?>
								</select><br>
							</li>
							<li>
								<label for="fecha">Fecha de recepción</label>
								<input type="date" name="fecha" id="fecharep"> 
							</li>
							<li>
								<label for="impcol">Modo de impresión</label>
								<input type="radio" name="impcol" id="impcol" value="0" checked><label for="impcol">Blanco y negro</label>
								 <input type="radio" name="impcol" id="impcol2" value="1"><label for="impcol2">Color</label>
							</li>
						</ul>
						<input type="submit" value="Continuar" class="send">
					</fieldset>
				</form>
			</li>
		</ul>
		
	</main>
<?php
	require_once("./capsulas/pie.php");
?>