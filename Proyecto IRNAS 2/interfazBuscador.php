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
<div class="centrado">
<?php
    include_once("menu.php");
?>
<div>
	<form action="gestionarBusquedas.php" method="GET">	    
		<input type="search" placeholder="Buscar..." name="search">
    <input type="submit" name="submit" value="Buscar" />
        <div>
            <label>
                <input type="radio" name="tipo" value="Almacenes"> Almacenes
            </label>
            <label>
                <input type="radio" name="tipo" value="Recursos"> Recursos
            </label>
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