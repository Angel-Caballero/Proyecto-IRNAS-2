<?php

session_start();

require_once("gestionBD.php");

if (isset($_SESSION["formularioProveedor"])) {
    $nuevoProveedor["nombre-empresa"] = $_REQUEST["proveedor-nombre-empresa"];
    $nuevoProveedor["nombre-comercial"] = $_REQUEST["proveedor-nombre-comercial"];
    $nuevoProveedor["email"] = $_REQUEST["proveedor-email"];
    $nuevoProveedor["telefono1"] = $_REQUEST["proveedor-telefono1"];

    if($_REQUEST["proveedor-telefono2"] != ""){
        $nuevoProveedor["telefono2"] = $_REQUEST["proveedor-telefono2"];
    }

    if($_REQUEST["proveedor-telefono3"] != ""){
        $nuevoProveedor["telefono3"] = $_REQUEST["proveedor-telefono3"];
    }
   
    $_SESSION["formularioProveedor"] = $nuevoProveedor;		
}

else{
    Header("Location: formulario_alta.php");
}
    

    $conexion = crearConexionBD(); 
	$errores = validarDatosProveedor($conexion, $nuevoProveedor);
    cerrarConexionBD($conexion);
    
if (count($errores)>0) {
	$_SESSION["erroresProveedor"] = $errores;
	Header('Location: formulario_alta.php');
} else {
    Header('Location: accion_alta_proveedor.php');
}
function validarDatosProveedor($conexion, $nuevoProveedor){
    $errores=array();

    if($nuevoProveedor["nombre-comercial"]==""){
    $errores[] = "<p>El nombre del comercial no puede estar vacío</p>";
    }

    if($nuevoProveedor["email"]==""){ 
		$errores[] = "<p>El email no puede estar vacío</p>";
	}else if(!filter_var($nuevoProveedor["email"], FILTER_VALIDATE_EMAIL)){
        $errores[] = "<p>El email es incorrecto: " . $nuevoProveedor["email"]. "</p>";
    }
        
    $expresion = '/^[9|6|7][0-9]{8}$/';
    if(!preg_match($expresion, $nuevoProveedor["telefono1"])){ 
         $errores[] = "<p>El teléfono 1 no es válido</p>";
    
    }else if($nuevoProveedor["telefono1"] ==" "){
        $errores[] = "<p>El teléfono 1 no puede estar vacío</p>";
    }

    if(isset($nuevoProveedor["telefono2"])){
        if(!preg_match($expresion, $nuevoProveedor["telefono2"])){ 
            $errores[] = "<p>El teléfono 2 introducido no es válido</p>"; 
        }
    }
    if(isset($nuevoProveedor["telefono3"])){ 
        if(!preg_match($expresion, $nuevoProveedor["telefono3"])){ 
            $errores[] = "<p>El teléfono 3 introducido no es válido</p>"; }
    }

    return $errores;
}

?>