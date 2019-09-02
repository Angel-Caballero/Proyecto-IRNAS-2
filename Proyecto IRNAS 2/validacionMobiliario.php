<?php
session_start();

require_once("gestionBD.php");
require_once("gestionarBusquedas.php");

if (isset($_SESSION["formularioMobiliario"])) {
    $nuevoMobiliario["tipo-mob"] = $_REQUEST["tipo-mobiliario"];
    $nuevoMobiliario["almacen"] = $_REQUEST["mobiliario-almacen"];
    $nuevoMobiliario["nombre"] = $_REQUEST["mobiliario-nombre"];
    $nuevoMobiliario["tipo-temp-amb"] = $_REQUEST["mobiliario-temp-amb"];
    $nuevoMobiliario["temperatura"] = $_REQUEST["mobiliario-temperatura"];
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

    if($nuevoMobiliario["tipo-mob"] == "ambiente"){
        if($nuevoMobiliario["tipo-temp-amb"] != "estanteria" && $nuevoMobiliario["tipo-temp-amb"] != "cajonera") {
            $errores[] = "<p>El tipo debe ser estanteria o cajonera</p>";
        }
    }else if($nuevoMobiliario["tipo-mob"] == "frio"){
        if($nuevoMobiliario["temperatura"]==""){
            $errores[] = "<p>La temperatura no puede estar vacía</p>";
        }
    }else{
        $errores[] = "<p>El tipo de mobiliario debe ser temperatura ambiente o equipo de frio</p>";
    }

   // if($nuevoMobiliario["tipo-mob"] != "ambiente" && $nuevoMobiliario["tipo-mob"] != "frio") {
     //   $errores[] = "<p>El tipo de mobiliario debe ser temperatura ambiente o equipo de frio</p>";
    //}

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