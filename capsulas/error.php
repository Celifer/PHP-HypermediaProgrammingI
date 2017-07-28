<?php
	if(isset($_GET['err'])){
		$errores = unserialize($_GET['err']);
		echo "<aside>";
		echo "<br>";
		foreach($errores as $r)
			echo "<span>Errores: </span>".$r."<br>"; 	
		echo "</aside>";
	}
?>