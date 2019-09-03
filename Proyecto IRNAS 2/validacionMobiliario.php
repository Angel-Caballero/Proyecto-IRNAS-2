<?php
session_start();

require_once("gestionBD.php");
require_once("gestionarAlmacenes.php");

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
    if($error != ""){
		$errores[] = $error;
    }
        
    return $errores;
}

function validarAlmacen($conexion, $almacen){
    $error = "";
    $num_alm = consultarAlmacen($conexion, $almacen);
    
    if($num_alm == 0){
        $error = "<p>El almacén utilizado debe ser uno existente</p>";
    }

    return $error;
}
?>