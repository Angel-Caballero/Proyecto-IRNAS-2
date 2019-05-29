<?php
	session_start();

	require_once ("gestionBD.php");
	require_once ("gestionarBusquedas.php");
	require_once ("gestionarUsuarios.php");

	//if (!isset($_SESSION['login'])){
		//  Header("Location: login.php");
	//}else{
		//  $usuario = $_SESSION['login'];
	//}


		$conexion = crearConexionBD();

		cerrarConexionBD($conexion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/general.css" />
	<link rel="stylesheet" type="text/css" href="css/menu.css" />
	<script type="text/javascript" src="./js/menu.js"></script>
  <link rel="icon" href="images/icono.png"/>
  <title>Base de Datos: Lista de Recursos</title>
</head>

<body>
<div class="contenido">
<?php
	include_once("cabecera.php");
?>
<div class="centrado" style="flex-direction:column;">
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
</div>
<?php
	include_once("pie.php");
?>
</body>
</html>
