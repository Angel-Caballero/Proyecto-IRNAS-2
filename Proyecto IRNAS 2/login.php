<?php
	session_start();
  	
  	include_once("gestionBD.php");
 	include_once("gestionarUsuarios.php");
	
	 if (isset($_POST['submit'])){
		$nombre= $_POST['nombre'];
		$pass = $_POST['pass'];
	
		$conexion = crearConexionBD();
		$num_usuarios = consultarUsuario($conexion,$nombre,$pass);

		
  	 	$tipo = consultarTipoUsuario($conexion, $usuario);
	 
		cerrarConexionBD($conexion);	
	
		if ($num_usuarios == 0)
			$login = "error";	
		else {
			$_SESSION['login'] = $nombre;
			Header("Location: interfazBuscador.php");
		}	

		if($tipo == "ADMINISTRADOR"){
			$privilegios = true;
			$_SESSION['privilegios'] = $privilegios;
		  }
	}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/general.css" />
  <link rel="icon" href="images/icono.png"/>
  <title>Base de Datos: Login</title>
</head>

<body>
<div class="contenido">
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
	<form action="login.php" method="post" class="centrado">
		<div style="max-width:250px;"><label for="nombre">Nombre de Usuario: </label><input type="text" name="nombre" id="nombre" class="prueba"/></div>
		<div style="max-width:250px;"><label for="pass">Contraseña: </label><input type="password" name="pass" id="pass" /></div>
		<input type="submit" name="submit" value="Enviar" />
	</form>
		
</main>
</div>
<?php
	include_once("pie.php");
?>
</body>
</html>