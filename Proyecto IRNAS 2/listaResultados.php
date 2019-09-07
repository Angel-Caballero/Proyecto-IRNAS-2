<?php
session_start();

require_once("gestionBD.php");
require_once("gestionarBusquedas.php");
require_once("gestionarUsuarios.php");
require_once("paginacion_busqueda.php");

if (!isset($_SESSION['login'])) {
	Header("Location: login.php");
} else {
	$usuario = $_SESSION['login'];
}

if (isset($_SESSION["recurso"])) {
	unset($_SESSION["recurso"]);
}

$conexion = crearConexionBD();

if (isset($_GET["almacen"])) {
	unset($_SESSION['busqAlmacen']);
	$query = $_GET["almacen"];
	$recursos = recursosEnAlmacen($conexion, $query);
} else {
	if (isset($_SESSION['busqRecurso'])) {
		$query = $_SESSION['busqRecurso'];
		unset($_SESSION['busqAlmacen']);
		$recursos = buscarRecursos($conexion, $query);
	} else if (isset($_SESSION['busqAlmacen'])) {
		$query = $_SESSION['busqAlmacen'];
		unset($_SESSION['busqRecurso']);
		$almacenes = buscarAlmacenes($conexion, $query);
	} else {
		Header("Location: interfazBuscador.php");
	}
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
	<link rel="icon" href="images/icono.png" />
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
					<?php if (isset($_SESSION["busqAlmacen"])) { ?>
						<th>Almacen</th>
						<th>Tipo de camara</th>
						<th>Temperatura</th>
						<?php foreach ($almacenes as $almacen) { ?>
				<tr>
					<td><a href="listaResultados.php?almacen=<?php echo $almacen["NOMBRE"]; ?>"><?php echo $almacen["NOMBRE"]; ?></td>
					<td><?php echo $almacen["TIPOILUMINACION"]; ?></td>
					<td><?php echo $almacen["TIPOCAMARA"]; ?></td>
				</tr>
			<?php } ?>
		<?php } else if (isset($_SESSION["busqRecurso"]) || isset($_GET["almacen"])) { ?>
			<tr>
			<th>Recurso</th>
			<th>Almacen</th>
			<th>Tipo</th>
			<?php foreach ($recursos as $recurso) { ?>
				<tr>
					<td><?php echo $recurso["NOMBRE"]; ?></td>
					<td><?php echo $recurso["ALMACEN"]; ?></td>
					<td><?php echo $recurso["TIPO"]; ?></td>
					<td><form method="post" action="controlador_recursos.php">
							<div class="fila_recurso">
								<div class="datos_recurso">
									<input id="NOMBRE" name="NOMBRE" type="hidden" value="<?php echo $recurso["NOMBRE"]; ?>" />
									<input id="FORMULAQUIMICA" name="FORMULAQUIMICA" type="hidden" value="<?php echo $recurso["FORMULAQUIMICA"]; ?>" />
									<input id="UNIDADES" name="UNIDADES" type="hidden" value="<?php echo $recurso["UNIDADES"]; ?>" />
									<input id="CANTIDAD" name="CANTIDAD" type="hidden" value="<?php echo $recurso["CANTIDAD"]; ?>" />
									<input id="RESERVAMINIMA" name="RESERVAMINIMA" type="hidden" value="<?php echo $recurso["RESERVAMINIMA"]; ?>" />
									<input id="TIPO" name="TIPO" type="hidden" value="<?php echo $recurso["TIPO"]; ?>" />
									<input id="ALMACEN" name="ALMACEN" type="hidden" value="<?php echo $recurso["ALMACEN"]; ?>" />
								</div>
								<div id="boton">
									<input type="submit" name="submit" value="Informacion"/>
								</div>
							</div>
						</form>
					</td>
				</tr>
			<?php } ?>
		<?php } ?>
		</tr>
		</table>
	</div>
	</div>
	<?php
	include_once("pie.php");
	?>
</body>

</html>