<?php 
	$ultimavisita = "user";
	$fecha = date("c");
	setcookie($ultimavisita, $fecha, time() + (86400 * 30), "/");
?>

<ul class="loginid">
	<?php echo "Hola "; echo $_COOKIE["nomusuario"];?>
	<?php
		if(!isset($_COOKIE[$ultimavisita])) {
		  	echo ", esta es tu primera visita"; 
		} else {
		    echo ", su última visita fue el " . $_COOKIE[$ultimavisita];
		}
	?>
	<li><a href="controlaccesocookie.php">Acceder</a></li>
	<li><a href="salircookie.php">Salir</a></li>
</ul>
</header>