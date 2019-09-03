<?php
session_start();

require_once("gestionBD.php");

if (isset($_SESSION["formularioAlmacen"])) {
    $nuevoAlmacen["nombre"] = $_REQUEST["almacen-nombre"];
    $nuevoAlmacen["tipo-iluminacion"] = $_REQUEST["almacen-iluminacion"];
    $nuevoAlmacen["temperatura"] = $_REQUEST["almacen-temperatura"];
    $nuevoAlmacen["tipo-camara"] = $_REQUEST["almacen-tipo-camara"];
    $_SESSION["formularioAlmacen"] = $nuevoAlmacen;		
}else{
    Header("Location: formulario_alta.php");
}
    $conexion = crearConexionBD(); 
	$errores = validarDatosAlmacen($nuevoAlmacen);
    cerrarConexionBD($conexion);
    
if (count($errores)>0) {
	$_SESSION["erroresAlmacen"] = $errores;
	Header('Location: formulario_alta.php');
} else{
    Header('Location: accion_alta_almacen.php');
} 
function validarDatosAlmacen($nuevoAlmacen){
    $errores=array();

    if($nuevoAlmacen["nombre"] == ""){
        $errores[] = "<p>El nombre no puede estar vacío</p>";
    }
    
    if($nuevoAlmacen["tipo-iluminacion"] == ""){ 
		$errores[] = "<p>El tipo-iluminacion no puede estar vacío</p>";
	}
    
    if(!preg_match("/^[0-9][A-Z]$/", $nuevoAlmacen["tipo-iluminacion"])){ 
        $errores[] = "<p> El tipo de iluminacion tiene que contener números y letras mayúsculas</p>";
    }

    if($nuevoAlmacen["temperatura"] == ""){ 
		$errores[] = "<p>La temperatura no puede estar vacía</p>";
	}
    
    if($nuevoAlmacen["tipo-camara"] != "NORMAL" && $nuevoAlmacen["tipo-camara"] != "CAMARA IN-VITRO" && $nuevoAlmacen["tipo-camara"] != "CAMARA FRIO") {
        $errores[] = "<p>El tipo de camara debe ser Almacen, invitro o frio</p>";
    }

    return $errores;
}
?>