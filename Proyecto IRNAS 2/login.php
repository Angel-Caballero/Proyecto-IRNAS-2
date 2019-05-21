<?php
	session_start();
  	
  	include_once("gestionBD.php");
 	include_once("gestionarUsuarios.php");
	
	 if (isset($_POST['submit'])){
		$nombre= $_POST['nombre'];
		$pass = $_POST['pass'];

		$conexion = crearConexionBD();
		$num_usuarios = consultarUsuario($conexion,$nombre,$pass);
		cerrarConexionBD($conexion);	
	
		if ($num_usuarios == 0)
			$login = "error";	
		else {
			$_SESSION['login'] = $nombre;
			Header("Location: index.php");
		}	
	}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/almacen.css" />
  <title>Base de Datos: Login</title>
</head>

<body>

<?php
	include_once("cabecera.php");
?>

<main>
	<?php if (isset($login)) {
		echo "<div class=\"error\">";
		echo "Error en la contraseña o no existe el usuario.";
		echo "</div>";
	}	
	?>
	
	<!-- The HTML login form -->
	<form action="login.php" method="post">
		<div><label for="nombre">Nombre de Usuario: </label><input type="text" name="nombre" id="nombre" /></div>
		<div><label for="pass">Contraseña: </label><input type="password" name="pass" id="pass" /></div>
		<input type="submit" name="submit" value="submit" />
	</form>
		
</main>

<?php
	include_once("pie.php");
?>
</body>
</html>