<?php
session_start();

require_once("gestionBD.php");


if (isset($_SESSION["formularioUsuario"])) {
    $nuevoUsuario["nombre"] = $_REQUEST["usuario-nombre"];
    $nuevoUsuario["email"] = $_REQUEST["usuario-email"];
    $nuevoUsuario["pass"] = $_REQUEST["usuario-password"];
    if(isset($_REQUEST["usuario-responsable"])){
        $nuevoUsuario["tipo"] = "ADMINISTRADOR";
    }else {
        $nuevoUsuario["tipo"] = "TRABAJADOR";
    }
    $_SESSION["formularioUsuario"] = $nuevoUsuario;		
}

else {
    Header("Location: formulario_alta.php");
}
    $conexion = crearConexionBD(); 
	$errores = validarDatosUsuario($nuevoUsuario);
    cerrarConexionBD($conexion);
    
if (count($errores)>0) {
	$_SESSION["erroresUsuario"] = $errores;
	Header('Location: formulario_alta.php');
} else{
    Header('Location: accion_alta_usuario.php');
}
        
function validarDatosUsuario($nuevoUsuario){
    $errores=array();

    if($nuevoUsuario["nombre"]==""){
    $errores[] = "<p>El nombre no puede estar vacío</p>";
    }

    if($nuevoUsuario["email"]==""){ 
		$errores[] = "<p>El email no puede estar vacío</p>";
	}else if(!filter_var($nuevoUsuario["email"], FILTER_VALIDATE_EMAIL)){
        $errores[] = "<p>El email es incorrecto: " . $nuevoUsuario["email"]. "</p>";
    }

    if(!isset($nuevoUsuario["pass"]) || strlen($nuevoUsuario["pass"])<8){
        $errores[] = "<p>Contraseña no válida: debe tener al menos 8 caracteres</p>";
    }else if(!preg_match("/[a-z]+/", $nuevoUsuario["pass"]) || !preg_match("/[A-Z]+/", $nuevoUsuario["pass"])){
        $errores[] = "<p>Contraseña no válida: debe contener letras mayúsculas y minúsculas</p>";
    }else if(strlen($nuevoUsuario["pass"]) > 16){
        $errores[] = "<p>Contraseña no válida: no puede tener más de 16 caracteres</p>";
    }

    if($nuevoUsuario["tipo"] != "TRABAJADOR" && $nuevoUsuario["tipo"] != "ADMINISTRADOR"){
        $errores[] = "<p>El tipo de usuario debe ser: TRABAJADOR o ADMINISTRADOR</p>";
    }

    return $errores;
}

?>