<?php
session_start();
if (isset($_SESSION["formularioMobiliario"])) {
    $nuevoMobiliario["tipo-mobiliario"] = $_REQUEST["tipo-mobiliario"];
    $nuevoMobiliario["almacen"] = $_REQUEST["almacen"];
    $nuevoMobiliario["nombre"] = $_REQUEST["nombre"];
    $nuevoMobiliario["tipo"] = $_REQUEST["tipo"];
    $nuevoMobiliario["temperatura"] = $_REQUEST["temeperatura"];
    $_SESSION["formularioMobiliario"] = $nuevoMobiliario;
}

else 
    Header("Location: form_alta_usuario.php");

    $conexion = crearConexionBD(); 
	$errores = validarDatosUsuario($conexion, $nuevoMobiliario);
    cerrarConexionBD($conexion);
    
if (count($errores)>0) {
	
	$_SESSION["errores"] = $errores;
	Header('Location: form_alta_usuario.php');
} else
	
    Header('Location: accion_alta_usuario.php');
        
function validarDatosUsuario($conexion, $nuevoMobiliario){
    $errores=array();

    if($nuevoMobiliario["nombre"]=="") 
    $errores[] = "<p>El nombre no puede estar vacío</p>";

    if($nuevoMobiliario["tipo"] != "estanteria" &&
        $nuevoMobiliario["tipo"] != "cajonera" {
		$errores[] = "<p>El tipo debe ser estanteria o cajonera</p>";
}
    if($nuevoMobiliario["tipo-mobiliario"] != "ambiente" &&
		$nuevoMobiliario["tipo-mobiliario"] != "frio" {
		$errores[] = "<p>El tipo de mobiliario debe ser temperatura ambiente o equipo de frio</p>";
?>