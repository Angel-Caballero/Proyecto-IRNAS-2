<?php
	session_start();

	require_once ("gestionBD.php");
	require_once ("gestionarBusquedas.php");
	require_once ("gestionarUsuarios.php");
	require_once ("paginacion_busqueda.php");

	if (!isset($_SESSION['login'])){
		  Header("Location: login.php");
	}else{
		  $usuario = $_SESSION['login'];
	}


		$conexion = crearConexionBD();

	if(isset($_SESSION['recurso'])){
		$query = $_SESSION['recurso'];
		unset($_SESSION['almacen']);
		$recursos = buscarRecursos($conexion, $query);
	}
	else if(isset($_SESSION['almacen'])){
		$query = $_SESSION['almacen'];
		unset($_SESSION['recurso']);
		$almacenes = buscarAlmacenes($conexion, $query);
	}
	
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

<table style="width:90%;">
  <tr>
	<?php if(isset($_SESSION["almacen"])){ ?>
    	<th>Almacen</th>
    	<th>Tipo de camara</th>
		<th>Temperatura</th>
		<?php foreach($almacenes as $almacen){ ?>
		<tr>
   	 <td><?php echo $almacen["NOMBRE"]; ?></td>
    <td><?php echo $almacen["TIPOILUMINACION"]; ?></td> 
    <td><?php echo $almacen["TIPOCAMARA"]; ?></td>
  </tr>
	<?php } ?>
		<?php } else if(isset($_SESSION["recurso"])){?>
		<th>Recurso</th>
   		<th>Almacen</th>
		<th>Tipo</th>
		<?php foreach($recursos as $recurso){ ?>
		<tr>
   	 <td><?php echo $recurso["NOMBRE"]; ?></td>
    <td><?php echo $recurso["ALMACEN"]; ?></td> 
    <td><?php echo $recurso["TIPO"]; ?></td>
  </tr>
  		<?php } ?>
		<?php } ?>
	</tr>
</table>

</div>
</div>
</div>
<?php
	include_once("pie.php");
?>
</body>
</html>
