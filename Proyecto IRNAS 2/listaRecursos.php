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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/general.css" />
  <link rel="stylesheet" type="text/css" href="css/menu.css" />
  <link rel="icon" href="images/icono.png"/>
  <title>Base de Datos: Login</title>
</head>

<body>
<div class="contenido">
<?php
	include_once("cabecera.php");
?>
<div class="centrado" style="flex-direction:column">
<?php
	include_once("menu.php");
?>
<div>
<form action=".php">
  <select name="paginado">
    <option value="1">10</option>
    <option value="2">20</option>
    <option value="3">30</option>
    <option value="4">40</option>
  </select>
  <input type="submit">
</form>
</div>
<table style="width:90%;">
  <tr>
    <td>Recurso</td>
    <td>Tipo</td> 
    <td>Almacen</td>
  </tr>
</table>

<section class="paginacion">
	<ul>
		<li><a href="http://"></a>Pagina1</li>
	</ul>
</section>

</div>
</div>
<?php
	include_once("pie.php");
?>
</body>
</html>