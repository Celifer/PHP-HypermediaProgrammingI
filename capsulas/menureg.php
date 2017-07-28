<?php
	$ultimavisita = "user";
	$fecha = date("c");
	setcookie($ultimavisita, $fecha, time() + (86400 * 30), "/"); // 86400 = 1 day
?>

<ul class="loginid">
	<?php echo "Hola "; echo $_SESSION["usuario"]; echo ",";?>
	<?php
		if(!isset($_COOKIE[$ultimavisita])) {
		  	echo "esta es tu primera visita"; 
		} else {
		    echo "tu última visita fue el: " . $_COOKIE[$ultimavisita];
		}
	?>
	<li><a href="micuenta.php"><?php echo "Cuenta de "; echo $_SESSION["usuario"]; ?></a></li>
	<li><a href="salir.php">Salir</a></li>
</ul>
</header>