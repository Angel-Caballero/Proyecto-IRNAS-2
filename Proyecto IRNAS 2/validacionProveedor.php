<?php
session_start();
if (isset($_SESSION["proveedor"])) {
    $nuevoProveedor["nombre-empresa"] = $_REQUEST["nombre_empresa"];
    $nuevoProveedor["nombre-comercial"] = $_REQUEST["nombre-comercial"];
    $nuevoProveedor["email"] = $_REQUEST["email"];
    $nuevoProveedor["telefono1"] = $_REQUEST["telefono1"];
    $nuevoProveedor["telefono2"] = $_REQUEST["telefono2"];
    $nuevoProveedor["telefono3"] = $_REQUEST["telefono3"]
    $_SESSION["proveedor"] = $nuevoProveedor;		
}

else 
    Header("Location: añadir.php");

    $conexion = crearConexionBD(); 
	$errores = validarDatosProveedor($conexion, $nuevoProveedor);
    cerrarConexionBD($conexion);
    
if (count($errores)>0) {
	
	$_SESSION["errores"] = $errores;
	Header('Location: form_alta_usuario.php');
} else
	
    Header('Location: accion_alta_usuario.php');
        
function validarDatosProveedor($conexion, $nuevoProveedor){
    $errores=array();

    if($nuevoProveedor["nombre-comercial"]=="") 
    $errores[] = "<p>El nombre del comercial no puede estar vacío</p>";

    if($nuevoProveedor["email"]==""){ 
		$errores[] = "<p>El email no puede estar vacío</p>";
	}else if(!filter_var($nuevoProveedor["email"], FILTER_VALIDATE_EMAIL)){
        $errores[] = "<p>El email es incorrecto: " . $nuevoUsuario["email"]. "</p>";
        
    if(!isset($nuevoProveedor["telefono1"]) || 
    $expresion = '/^[9|6|7][0-9]{8}$/'){
        if(preg_match($expresion, $value)){ echo 'El telefono es correcto'; }else{ echo 'El telefono es incorrecto'; })
    }else if($nuevoProveedor["telefono1"]==""){
        $errores[] = "<p>El telefono1 no puede estar vacío</p>";
    }
    if(!isset($nuevoProveedor["telefono2"]) || 
    $expresion = '/^[9|6|7][0-9]{8}$/'){
        if(preg_match($expresion, $value)){ echo 'El telefono es correcto'; }else{ echo 'El telefono es incorrecto'; })

    if(!isset($nuevoProveedor["telefono3"]) || 
    $expresion = '/^[9|6|7][0-9]{8}$/'){
        if(preg_match($expresion, $value)){ echo 'El telefono es correcto'; }else{ echo 'El telefono es incorrecto'; })
     
?>