<?php 
	if (isset($_GET["error"]) && $_GET["error"]==true){
		$usuer ="Combinación errónea";
	}
	else{
		$usuer ="";
	}
?>
	<form  action="controlacceso.php" method="post" id="frm">
			<ul class="login">
				<li class="log1"><label for="usu">Usuario</label>
				<br><input type="text" name="usuario" id="usu" required ><br>
				<span><?php echo $usuer; ?></span></li>
				<li class="log1"><label for="usukey">Contraseña</label>
				<br><input type="password" name="contraseña" id="usukey" required><br>
				<input type="checkbox" name="recordar" value="recordar"><label for="recordar">Recordar</label></li><br>
				<li class="fnl"><input type="submit" value="Iniciar sesión" id="log"><br>
				<a href="registro.php">Regístrate</a></li>			
			</ul>
		</form>	
	</header>