<?php 
	require_once("conexion.php");
	$sentencia = "SELECT NomPais, IdPais, CodPais FROM `paises` order by NomPais";
	$consulta = mysqli_query($conn, $sentencia);

	if (mysqli_num_rows($consulta) > 0) {
   		 while($row = mysqli_fetch_assoc($consulta)) {
   		 	$pa = $row["IdPais"];
        	echo "<option value=$pa";
        	if (isset($CDPais) && $CDPais == $pa)
        		echo " selected=selected";
        	echo ">". $row["NomPais"]."</option>";
   		 }
	} 
?>