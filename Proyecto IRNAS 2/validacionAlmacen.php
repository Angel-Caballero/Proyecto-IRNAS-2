<?php
session_start();
if (isset($_SESSION["formularioAlmacen"])) {
    $nuevoAlmacen["nombre"] = $_REQUEST["nombre"];
    $nuevoAlmacen["tipo-iluminacion"] = $_REQUEST["tipo-iluminacion"];
    $nuevoAlmacen["temperatura"] = $_REQUEST["temperatura"];
    $nuevoAlmacen["tipo-camara"] = $_REQUEST["tipo-camara"];
    $_SESSION["formularioAlmacen"] = $nuevoAlmacen;		
}

else 
    Header("Location: form_alta_usuario.php");

    $conexion = crearConexionBD(); 
	$errores = validarDatosUsuario($conexion, $nuevoAlmacen);
    cerrarConexionBD($conexion);
    
if (count($errores)>0) {
	
	$_SESSION["errores"] = $errores;
	Header('Location: form_alta_usuario.php');
} else
	
    Header('Location: accion_alta_usuario.php');
        
function validarDatosUsuario($conexion, $nuevoAlmacen){
    $errores=array();

    if($nuevoAlmacen["nombre"]=="") 
    $errores[] = "<p>El nombre no puede estar vacío</p>";

    if($nuevoAlmacen["tipo-iluminacion"]==""){ 
		$errores[] = "<p>El tipo-iluminacion no puede estar vacío</p>";
	}else if(!isset($nuevoAlmacen["tipo-iluminacion"])){
        $expresion = '/^[a-z]$/'
            if(preg_match($expresion, $value)){ echo 'El tipo de iluminacion es correcto'; }else{$errores[] = "<p> El tipo de iluminacion no puede tener numeros</p>"; })
}
    if($nuevoAlmacen["tipo-camara"] != "Almacen" &&
		$nuevoAlmacen["tipo-camara"] != "invitro" && 
		$nuevoAlmacen["tipo-camara"] != "frio") {
		$errores[] = "<p>El tipo de camara debe ser Almacen, invitro o frio</p>";
?>