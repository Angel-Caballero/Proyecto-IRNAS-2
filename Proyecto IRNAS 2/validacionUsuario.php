<?php
session_start();
if (isset($_SESSION["formulario"])) {
    $nuevoUsuario["nombre"] = $_REQUEST["nombre"];
    $nuevoUsuario["email"] = $_REQUEST["email"];
    $nuevoUsuario["pass"] = $_REQUEST["pass"];
    $_SESSION["formulario"] = $nuevoUsuario;		
}

else 
    Header("Location: form_alta_usuario.php");

    $conexion = crearConexionBD(); 
	$errores = validarDatosUsuario($conexion, $nuevoUsuario);
    cerrarConexionBD($conexion);
    
if (count($errores)>0) {
	
	$_SESSION["errores"] = $errores;
	Header('Location: form_alta_usuario.php');
} else
	
    Header('Location: accion_alta_usuario.php');
        
function validarDatosUsuario($conexion, $nuevoUsuario){
    $errores=array();

    if($nuevoUsuario["nombre"]=="") 
    $errores[] = "<p>El nombre no puede estar vacío</p>";

    if($nuevoUsuario["email"]==""){ 
		$errores[] = "<p>El email no puede estar vacío</p>";
	}else if(!filter_var($nuevoUsuario["email"], FILTER_VALIDATE_EMAIL)){
        $errores[] = "<p>El email es incorrecto: " . $nuevoUsuario["email"]. "</p>";
        
    if(!isset($nuevoUsuario["pass"]) || strlen($nuevoUsuario["pass"])<8){
        $errores [] = "<p>Contraseña no válida: debe tener al menos 8 caracteres</p>";
?>