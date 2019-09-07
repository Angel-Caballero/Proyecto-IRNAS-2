<?php	
    session_start();
    
    require_once("gestionBD.php");
    require_once("gestionarRecurso.php");
    
    if (!isset($_SESSION['login'])) {
        Header("Location: login.php");
    } else {
        $usuario = $_SESSION['login'];
    }
    
    if(!isset($_SESSION['privilegios'])){
        Header("Location: interfazBuscador.php");
    }

	if (isset($_REQUEST["NOMBRE"]) && isset($_REQUEST["ALMACEN"])) {
        $nombre = $_REQUEST["NOMBRE"];
        $almacen = $_REQUEST["ALMACEN"];
        
		$conexion = crearConexionBD();		
		$excepcion = quitar_recurso($conexion, $nombre,$almacen);
		cerrarConexionBD($conexion);
			
		if ($excepcion != "") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "formulario_baja.php";
			Header("Location: excepcion.php");
		}
		else{
            $_SESSION["mensjRecurso"] = "Recurso eliminado correctamente";
            Header("Location: formulario_baja.php");
        } 
	}
	else{
        Header("Location: interfaz_buscador.php"); 
    }
?>