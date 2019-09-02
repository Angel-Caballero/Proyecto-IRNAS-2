<?php
session_start();

require_once("gestionBD.php");
require_once("gestionarBusquedas.php");

if (isset($_SESSION["formularioMobiliario"])) {
    $nuevoMobiliario["temp-mobiliario"] = $_REQUEST["temp-mobiliario"];
    $nuevoMobiliario["almacen"] = $_REQUEST["almacen"];
    $nuevoMobiliario["nombre"] = $_REQUEST["nombre"];
    $nuevoMobiliario["tipo"] = $_REQUEST["tipo"];
    $nuevoMobiliario["temperatura"] = $_REQUEST["temeperatura"];
    $_SESSION["formularioMobiliario"] = $nuevoMobiliario;
}else{
    Header("Location: formulario_alta.php");
}
    $conexion = crearConexionBD(); 
	$errores = validarDatosMobiliario($conexion, $nuevoMobiliario);
    cerrarConexionBD($conexion);
    
if (count($errores)>0) {
	$_SESSION["erroresMobiliario"] = $errores;
	Header('Location: formulario_alta.php');
} else{
    Header('Location: accion_alta_mobiliario.php');
} 

function validarDatosMobiliario($conexion, $nuevoMobiliario){
    $errores=array();

    if($nuevoMobiliario["nombre"]==""){
        $errores[] = "<p>El nombre no puede estar vacío</p>";
    }

    if($nuevoMobiliario["tipo"] != "estanteria" && $nuevoMobiliario["tipo"] != "cajonera") {
		$errores[] = "<p>El tipo debe ser estanteria o cajonera</p>";
    }

    if($nuevoMobiliario["temp-mobiliario"] != "ambiente" && $nuevoMobiliario["temp-mobiliario"] != "frio") {
        $errores[] = "<p>El tipo de mobiliario debe ser temperatura ambiente o equipo de frio</p>";
    }

    if($nuevoMobiliario["temperatura"]==""){
        $errores[] = "<p>La temperatura no puede estar vacía</p>";
    }

    $error = validarAlmacen($conexion, $nuevoMobiliario["almacen"]);
    if($error!=""){
		$errores[] = $error;
    }
        
    return $errores;
}

function validarAlmacen($conexion, $almacenMob){
    $error = "";
    $almacenes = todosLosAlmacenes($conexion);
    $existe = false;
    foreach ($almacenes as $almacen) {
        if ($almacen["NOMBRE"] == $almacenMob["NOMBRE"]) {
            $existe = true;
            break;
        }
    }

    if(!$existe){
        $error = "<p>El almacén no existe</p>";
    }

    return $error;
}
?>