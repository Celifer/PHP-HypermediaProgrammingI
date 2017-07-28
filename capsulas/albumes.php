<?php 
	$user = $_SESSION["ident"];
	include("conexion.php");
	$sentencia = "SELECT * FROM `albumes`, `usuarios` where albumes.Usuario = usuarios.IdUsuario and usuarios.IdUsuario = '$user' order by IdAlbum";
	$consulta = mysqli_query($conn, $sentencia);

	if (mysqli_num_rows($consulta) > 0) {
   		 while($row = mysqli_fetch_assoc($consulta)) {
        	echo "<option value=".$row["IdAlbum"].">".$row["Titulo"]."</option>";
   		 }
	} 
	else
		echo "<option value=0> No hay álbumes </option>";
?>