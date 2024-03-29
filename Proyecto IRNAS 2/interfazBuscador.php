<?php
session_start();

require_once ("gestionarBusquedas.php");
require_once ("gestionarUsuarios.php");

if (!isset($_SESSION['login'])){
    Header("Location: login.php");
}else{
    $usuario = $_SESSION['login'];
}

if (isset($_SESSION['busqAlmacen'])){
  unset($_SESSION['busqAlmacen']);
}else if (isset($_SESSION['busqRecurso'])){
  unset($_SESSION['busqRecurso']);
}else if(isset($_GET["almacen"])){
  unset($_GET["almacen"]);
}

if (isset($_SESSION["recurso"])) {
	unset($_SESSION["recurso"]);
}

if(isset($_SESSION["editando"])){
	unset($_SESSION["editando"]);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- Hay que indicar el fichero externo de estilos -->
  <link rel="stylesheet" type="text/css" href="css/general.css" />
  <link rel="stylesheet" type="text/css" href="css/menu.css" />
	<script type="text/javascript" src="./js/menu.js"></script>
  <title>Base de Datos: Buscador</title>
  <link rel="icon" href="images/icono.png"/>
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
<div class="centrado" style="max-width:500px; flex-direction:column">
	<form  action="controlador_buscador.php" method="post">	    
		<input type="search" placeholder="Buscar..." name="search">
    <input type="submit" name="submit" value="Buscar" />
        <div class="centrado">
            <label>Almacenes</label><input type="radio" name="tipo" value="Almacen" required>
            <label>Recursos</label><input type="radio" name="tipo" value="Recurso"> 
        </div>
	</form>
   </div>
   </div>
</div>
<?php
	include_once("pie.php");
?>
</body>
</html>