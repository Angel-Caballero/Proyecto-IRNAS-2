<?php
session_start();
if (isset($_SESSION["formularioProveedor"])) {
    $nuevoProveedor["nombre-empresa"] = $_REQUEST["nombre_empresa"];
    $nuevoProveedor["nombre-comercial"] = $_REQUEST["nombre-comercial"];
    $nuevoProveedor["email"] = $_REQUEST["email"];
    $nuevoProveedor["telefono1"] = $_REQUEST["telefono1"];
    $nuevoProveedor["telefono2"] = $_REQUEST["telefono2"];
    $nuevoProveedor["telefono3"] = $_REQUEST["telefono3"];
    $_SESSION["formularioProveedor"] = $nuevoProveedor;		
}

else 
    Header("Location: añadir.php");

    $conexion = crearConexionBD(); 
	$errores = validarDatosProveedor($conexion, $nuevoProveedor);
    cerrarConexionBD($conexion);
    
if (count($errores)>0) {
	
	$_SESSION["erroresProveedor"] = $errores;
	Header('formulario_alta.php');
} else
	
    Header('Location: accion_alta_proveedor.php');
        
function validarDatosProveedor($conexion, $nuevoProveedor){
    $errores=array();

    if($nuevoProveedor["nombre-comercial"]=="") 
    $errores[] = "<p>El nombre del comercial no puede estar vacío</p>";

    if($nuevoProveedor["email"]==""){ 
		$errores[] = "<p>El email no puede estar vacío</p>";
	}else if(!filter_var($nuevoProveedor["email"], FILTER_VALIDATE_EMAIL)){
        $errores[] = "<p>El email es incorrecto: " . $nuevoProveedor["email"]. "</p>";
        
    if(!isset($nuevoProveedor["telefono1"])){
    $expresion = '/^[9|6|7][0-9]{8}$/'
        if(preg_match($expresion, $value)){ echo 'El teléfono es correcto'; }else{ $errores[] = "<p>El teléfono introducido no es valido</p>"; })
    }else if($nuevoProveedor["telefono1"]==""){
        $errores[] = "<p>El teléfono1 no puede estar vacío</p>";
    }
    if(!isset($nuevoProveedor["telefono2"])){
    $expresion = '/^[9|6|7][0-9]{8}$/'
        if(preg_match($expresion, $value)){ echo 'El teléfono es correcto'; }else{ $errores[] = "<p>El teléfono introducido no es valido</p>"; })
    }
    if(!isset($nuevoProveedor["telefono3"])){ 
    $expresion = '/^[9|6|7][0-9]{8}$/'
        if(preg_match($expresion, $value)){ echo 'El teléfono es correcto'; }else{ $errores[] = "<p>El teléfono introducido no es valido</p>"; })
    }

    return $errores;
}
?>