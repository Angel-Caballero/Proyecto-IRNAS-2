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
  // ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ?
	// ¿Hay una sesión activa?
	if (isset($_SESSION["paginacion"])){
		$paginacion = $_SESSION["paginacion"];
	}
	
	$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
	$pag_tam = isset($_GET["PAG_TAM"]) ? (int)$_GET["PAG_TAM"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM"] : 5);

	if ($pagina_seleccionada < 1) 		$pagina_seleccionada = 1;
	if ($pag_tam < 1) 		$pag_tam = 5;

	// Antes de seguir, borramos las variables de sección para no confundirnos más adelante
	unset($_SESSION["paginacion"]);

	$conexion = crearConexionBD();
	if(isset($_SESSION['recurso'])){
		$query = $_SESSION['recurso'];
		unset($_SESSION['almacen']);
	}
	else if(isset($_SESSION['almacen'])){
		$query = $_SESSION['almacen'];
		unset($_SESSION['recurso']);
	}
	$query = 'SELECT * ' 
			. 'FROM USUARIOS '  
			. 'ORDER BY NOMBRE';
	// Se comprueba que el tamaño de página, página seleccionada y total de registros son conformes.
	// En caso de que no, se asume el tamaño de página propuesto, pero desde la página 1
	
	//$total_registros = total_consulta($conexion, $query);
	$total_registros = total_consulta_prueba($conexion, $query);
	$total_paginas = (int)($total_registros / $pag_tam);

	if ($total_registros % $pag_tam > 0)		$total_paginas++;

	if ($pagina_seleccionada > $total_paginas)		$pagina_seleccionada = $total_paginas;

	// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
	$paginacion["PAG_NUM"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $pag_tam;
	$_SESSION["paginacion"] = $paginacion;

	//$filas = consulta_paginada($conexion, $query, $pagina_seleccionada, $pag_tam);
	$filas = consulta_paginada_prueba($conexion, $query, $pagina_seleccionada, $pag_tam);
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
<nav>

<div id="enlaces">

	<?php

		for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )

			if ( $pagina == $pagina_seleccionada) { 	?>

				<span class="current"><?php echo $pagina; ?></span>

	<?php }	else { ?>

				<a href="listaResultados.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

	<?php } ?>

</div>
<form method="get" action="listaRecursos.php">

	<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>

	Mostrando

	<input id="PAG_TAM" name="PAG_TAM" type="number"

		min="1" max="<?php echo $total_registros; ?>"

		value="<?php echo $pag_tam?>" autofocus="autofocus" />

	entradas de <?php echo $total_registros?>

	<input type="submit" value="Cambiar">

</form>

</nav>
<table style="width:90%;">
  <tr>
		<?php if(isset($_SESSION["almacen"])){ ?>
    <th>Almacen</th>
    <th>Tipo de camara</th>
		<th>Temperatura</th>
		<?php } else if(isset($_SESSION["recurso"])){?>
		<th>Recurso</th>
    <th>Almacen</th>
		<th>Tipo</th>
		<?php } ?>
	</tr>
	
	<?php foreach($filas as $fila){ ?>
		<tr>
    <td><?php echo $fila["NOMBRE"]; ?></td>
    <td><?php echo $fila["EMAIL"]; ?></td> 
    <td><?php echo $fila["TIPO"]; ?></td>
  </tr>
	<?php } ?>
</table>

</div>
</div>
</div>
<?php
	include_once("pie.php");
?>
</body>
</html>
