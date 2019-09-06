<?php	
    session_start();
    
    require_once("gestionBD.php");
    require_once("gestionarUsuarios.php");
    
    if (!isset($_SESSION['login'])) {
        Header("Location: login.php");
    } else {
        $usuario = $_SESSION['login'];
    }
    
    if(!isset($_SESSION['privilegios'])){
        Header("Location: interfazBuscador.php");
    }

	if (isset($_REQUEST["usuario-elemento"])) {
		$usuario = $_REQUEST["usuario-elemento"];
		unset($_SESSION["usuario-elemento"]);
		
		$conexion = crearConexionBD();		
		$excepcion = quitar_usuario($conexion, $usuario);
		cerrarConexionBD($conexion);
			
		if ($excepcion != "") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "formulario_baja.php";
			Header("Location: excepcion.php");
		}
		else{
            $_SESSION["mensjUsuario"] = "Usuario eliminado correctamente";
            Header("Location: formulario_baja.php");
        } 
	}
	else{
        Header("Location: interfaz_buscador.php"); 
    }
?>