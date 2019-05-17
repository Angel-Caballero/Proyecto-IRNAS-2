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

    $tipo = consultarTipoUsuario($conexion, $usuario);
    if($tipo == "ADMINISTRADOR"){
        $privilegios = true;
        $_SESSION['privilegios'] = $privilegios;
    }

	cerrarConexionBD($conexion);

?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- Hay que indicar el fichero externo de estilos -->
    <link rel="stylesheet" type="text/css" href="css/almacen.css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<script type="text/javascript" src="./js/boton.js"></script>
  <title>Gestión de biblioteca: Lista de Libros</title>
</head>

<body>

<?php

include_once ("cabecera.php");

include_once ("menu.php");
?>






<?php

include_once ("pie.php");
?>

</body>

</html>