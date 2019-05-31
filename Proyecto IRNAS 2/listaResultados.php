<?php
	session_start();

	require_once ("gestionBD.php");
	require_once ("gestionarBusquedas.php");
	require_once ("gestionarUsuarios.php");

	if (!isset($_SESSION['login'])){
		  Header("Location: login.php");
	}else{
		  $usuario = $_SESSION['login'];
	}


		$conexion = crearConexionBD();
  // ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ?
	// ¿Hay una sesión activa?
	if (isset($_SESSION["paginacion"]))
		$paginacion = $_SESSION["paginacion"];
	
	$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
	$pag_tam = isset($_GET["PAG_TAM"]) ? (int)$_GET["PAG_TAM"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM"] : 5);

	if ($pagina_seleccionada < 1) 		$pagina_seleccionada = 1;
	if ($pag_tam < 1) 		$pag_tam = 5;

	// Antes de seguir, borramos las variables de sección para no confundirnos más adelante
	unset($_SESSION["paginacion"]);

	$conexion = crearConexionBD();
	if(isset($_SESSION['recurso'])){
		$query = $_SESSION['recurso'];
		unset($_SESSION['recurso']);

	}
	else if(isset($_SESSION['almacen'])){
		$query = $_SESSION['almacen'];
		unset($_SESSION['almacen']);
		
	}
	// La consulta que ha de paginarse
	$query = 'SELECT AUTORES.OID_AUTOR, AUTORES.APELLIDOS, AUTORES.NOMBRE, ' 
			. 'LIBROS.OID_LIBRO, LIBROS.TITULO, AUTORIAS.OID_AUTORIA ' 
			. 'FROM AUTORES, LIBROS, AUTORIAS ' 
			. 'WHERE ' . 'AUTORES.OID_AUTOR = AUTORIAS.OID_AUTOR AND ' 
			. 'LIBROS.OID_LIBRO = AUTORIAS.OID_LIBRO ' 
			. 'ORDER BY APELLIDOS, NOMBRE, OID_AUTORIA';

	// Se comprueba que el tamaño de página, página seleccionada y total de registros son conformes.
	// En caso de que no, se asume el tamaño de página propuesto, pero desde la página 1
	$total_registros = total_consulta($conexion, $query);
	$total_paginas = (int)($total_registros / $pag_tam);

	if ($total_registros % $pag_tam > 0)		$total_paginas++;

	if ($pagina_seleccionada > $total_paginas)		$pagina_seleccionada = $total_paginas;

	// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
	$paginacion["PAG_NUM"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $pag_tam;
	$_SESSION["paginacion"] = $paginacion;

	$filas = consulta_paginada($conexion, $query, $pagina_seleccionada, $pag_tam);
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
		<?php if(isset($_SESSION["almacen"])){ ?>
    <td>Almacen</td>
    <td>Tipo de camara</td>
		<td>Temperatura</td>
		<?php } else if(isset($_SESSION["recurso"])){?>
		<td>Recurso</td>
    <td>Almacen</td>
		<td>Tipo</td>
		<?php } ?>
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
