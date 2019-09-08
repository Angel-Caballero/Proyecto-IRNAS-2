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

// ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ?
// ¿Hay una sesión activa?
if (isset($_SESSION["paginacion"])) {
	$paginacion = $_SESSION["paginacion"];
}

$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int) $_GET["PAG_NUM"] : (isset($paginacion) ? (int) $paginacion["PAG_NUM"] : 1);
$pag_tam = isset($_GET["PAG_TAM"]) ? (int) $_GET["PAG_TAM"] : (isset($paginacion) ? (int) $paginacion["PAG_TAM"] : 2);

if ($pagina_seleccionada < 1) {
	$pagina_seleccionada = 1;
}

if ($pag_tam < 1) {
	$pag_tam = 2;
}

// Antes de seguir, borramos las variables de sección para no confundirnos más adelante
unset($_SESSION["paginacion"]);

$conexion = crearConexionBD();

if (isset($_GET["almacen"])) {
	unset($_SESSION['busqAlmacen']);
	$query = $_GET["almacen"];
	$recursos = recursosEnAlmacen($conexion, $query);
} else {
	if (isset($_SESSION['busqRecurso'])) {
		if ($_SESSION['busqRecurso'] == "") {
			// La consulta que ha de paginarse
			$query = 'SELECT * FROM RECURSOS WHERE (NOMBRE = NOMBRE) ORDER BY NOMBRE';

			// Se comprueba que el tamaño de página, página seleccionada y total de registros son conformes.
			// En caso de que no, se asume el tamaño de página propuesto, pero desde la página 1
			$total_registros = total_consulta($conexion, $query);
			$total_paginas = (int) ($total_registros / $pag_tam);

			if ($total_registros % $pag_tam > 0) {
				$total_paginas++;
			}

			if ($pagina_seleccionada > $total_paginas) {
				$pagina_seleccionada = $total_paginas;
			}

			// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
			$paginacion["PAG_NUM"] = $pagina_seleccionada;
			$paginacion["PAG_TAM"] = $pag_tam;
			$_SESSION["paginacion"] = $paginacion;

			$filasRecursos = consulta_paginada($conexion, $query, $pagina_seleccionada, $pag_tam);
		} else {
			$query = $_SESSION['busqRecurso'];
			unset($_SESSION['busqAlmacen']);
			$recursos = buscarRecursos($conexion, $query);
		}
	} else if (isset($_SESSION['busqAlmacen'])) {
		if ($_SESSION['busqAlmacen'] == "") {
			// La consulta que ha de paginarse
			$query = 'SELECT * FROM ALMACENES WHERE (NOMBRE = NOMBRE) ORDER BY NOMBRE';

			// Se comprueba que el tamaño de página, página seleccionada y total de registros son conformes.
			// En caso de que no, se asume el tamaño de página propuesto, pero desde la página 1
			$total_registros = total_consulta($conexion, $query);
			$total_paginas = (int) ($total_registros / $pag_tam);

			if ($total_registros % $pag_tam > 0) {
				$total_paginas++;
			}

			if ($pagina_seleccionada > $total_paginas) {
				$pagina_seleccionada = $total_paginas;
			}

			// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
			$paginacion["PAG_NUM"] = $pagina_seleccionada;
			$paginacion["PAG_TAM"] = $pag_tam;
			$_SESSION["paginacion"] = $paginacion;

			$filasAlmacenes = consulta_paginada($conexion, $query, $pagina_seleccionada, $pag_tam);
		} else {
			$query = $_SESSION['busqAlmacen'];
			unset($_SESSION['busqRecurso']);
			$almacenes = buscarAlmacenes($conexion, $query);
		}
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
			<?php if (isset($filasRecursos) || isset($filasAlmacenes)) { ?>
				<nav>

					<div id="enlaces">

						<?php

							for ($pagina = 1; $pagina <= $total_paginas; $pagina++)

								if ($pagina == $pagina_seleccionada) { 	?>

							<span class="current"><?php echo $pagina; ?></span>

						<?php } else { ?>

							<a href="listaResultados.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

						<?php } ?>

					</div>



					<form method="get" action="listaResultados.php">

						<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada ?>" />

						Mostrando

						<input id="PAG_TAM" name="PAG_TAM" type="number" min="1" max="<?php echo $total_registros; ?>" value="<?php echo $pag_tam ?>" autofocus="autofocus" />

						entradas de <?php echo $total_registros ?>

						<input type="submit" value="Cambiar">

					</form>

				</nav>
			<?php } ?>
			<table style="width:90%;">
				<tr>
					<?php if (isset($_SESSION["busqAlmacen"])) { ?>
						<th>Almacén</th>
						<th>Tipo de cámara</th>
						<th>Temperatura</th>
						<?php if (isset($filasAlmacenes)) {
							foreach ($filasAlmacenes as $almacen) { ?>
				<tr>
					<td><a href="listaResultados.php?almacen=<?php echo $almacen["NOMBRE"]; ?>"><?php echo $almacen["NOMBRE"]; ?></td>
					<td><?php echo $almacen["TIPOCAMARA"]; ?></td>
					<td><?php echo $almacen["TEMPERATURA"]; ?></td>
				</tr>
							<?php } ?>
						<?php } else {
							foreach ($almacenes as $almacen) { ?>
				<tr>
					<td><a href="listaResultados.php?almacen=<?php echo $almacen["NOMBRE"]; ?>"><?php echo $almacen["NOMBRE"]; ?></td>
					<td><?php echo $almacen["TIPOCAMARA"]; ?></td>
					<td><?php echo $almacen["TEMPERATURA"]; ?></td>
				</tr>
							<?php } ?>
						<?php } ?>
					<?php } else if (isset($_SESSION["busqRecurso"]) || isset($_GET["almacen"])) { ?>
							<tr>
								<th>Recurso</th>
								<th>Almacén</th>
								<th>Tipo</th>
								<?php if (isset($filasRecursos)) {
									foreach ($filasRecursos as $recurso) { ?>
							<tr>
										<td><?php echo $recurso["NOMBRE"]; ?></td>
										<td><?php echo $recurso["ALMACEN"]; ?></td>
										<td><?php echo $recurso["TIPO"]; ?></td>
										<td>
										<form method="post" action="controlador_recursos.php">
											<div class="fila_recurso">
												<div class="datos_recurso">
													<form method="post" action="accion_borrar_recurso.php">
														<input id="NOMBRE" name="NOMBRE" type="hidden" value="<?php echo $recurso["NOMBRE"]; ?>" />
														<input id="FORMULAQUIMICA" name="FORMULAQUIMICA" type="hidden" value="<?php echo $recurso["FORMULAQUIMICA"]; ?>" />
														<input id="UNIDADES" name="UNIDADES" type="hidden" value="<?php echo $recurso["UNIDADES"]; ?>" />
														<input id="CANTIDAD" name="CANTIDAD" type="hidden" value="<?php echo $recurso["CANTIDAD"]; ?>" />
														<input id="RESERVAMINIMA" name="RESERVAMINIMA" type="hidden" value="<?php echo $recurso["RESERVAMINIMA"]; ?>" />
														<input id="TIPO" name="TIPO" type="hidden" value="<?php echo $recurso["TIPO"]; ?>" />
														<input id="ALMACEN" name="ALMACEN" type="hidden" value="<?php echo $recurso["ALMACEN"]; ?>" />
												</div>
												<div id="boton">
													<input type="submit" name="info" id="info" value="Informacion" />
												</div>
											</div>
										</form>
										</td>
							</tr>
									<?php } ?>
								<?php } else {
										foreach ($recursos as $recurso) { ?>
									<tr>
											<td><?php echo $recurso["NOMBRE"]; ?></td>
											<td><?php echo $recurso["ALMACEN"]; ?></td>
											<td><?php echo $recurso["TIPO"]; ?></td>
											<td>
												<form method="post" action="controlador_recursos.php">
													<div class="fila_recurso">
														<div class="datos_recurso">
															<form method="post" action="accion_borrar_recurso.php">
																<input id="NOMBRE" name="NOMBRE" type="hidden" value="<?php echo $recurso["NOMBRE"]; ?>" />
																<input id="FORMULAQUIMICA" name="FORMULAQUIMICA" type="hidden" value="<?php echo $recurso["FORMULAQUIMICA"]; ?>" />
																<input id="UNIDADES" name="UNIDADES" type="hidden" value="<?php echo $recurso["UNIDADES"]; ?>" />
																<input id="CANTIDAD" name="CANTIDAD" type="hidden" value="<?php echo $recurso["CANTIDAD"]; ?>" />
																<input id="RESERVAMINIMA" name="RESERVAMINIMA" type="hidden" value="<?php echo $recurso["RESERVAMINIMA"]; ?>" />
																<input id="TIPO" name="TIPO" type="hidden" value="<?php echo $recurso["TIPO"]; ?>" />
																<input id="ALMACEN" name="ALMACEN" type="hidden" value="<?php echo $recurso["ALMACEN"]; ?>" />
														</div>
														<div id="boton">
															<input type="submit" name="info" id="info" value="Informacion" />
														</div>
													</div>
												</form>
											</td>
									</tr>
										<?php } ?>
									<?php } ?>
					<?php } ?>

			</table>
		</div>
	</div>
	<?php
	include_once("pie.php");
	?>
</body>

</html>