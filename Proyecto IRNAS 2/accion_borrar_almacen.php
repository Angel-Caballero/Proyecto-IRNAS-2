<?php	
    session_start();
    
    require_once("gestionBD.php");
    require_once("gestionarAlmacenes.php");
    
    if (!isset($_SESSION['login'])) {
        Header("Location: login.php");
    } else {
        $usuario = $_SESSION['login'];
    }
    
    if(!isset($_SESSION['privilegios'])){
        Header("Location: interfazBuscador.php");
    }

	if (isset($_REQUEST["almacen-elemento"])) {
		$almacen = $_REQUEST["almacen-elemento"];
		unset($_SESSION["almacen-elemento"]);
		
		$conexion = crearConexionBD();		
		$excepcion = quitar_almacen($conexion, $almacen);
		cerrarConexionBD($conexion);
			
		if ($excepcion != "") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "formulario_baja.php";
			Header("Location: excepcion.php");
		}
		else{
            $_SESSION["mensjAlmacen"] = "Almacen eliminado correctamente";
            Header("Location: formulario_baja.php");
        } 
	}
	else{
        Header("Location: interfaz_buscador.php"); 
    }
?>