<?php	
    session_start();
    
    require_once("gestionBD.php");
    require_once("gestionarProveedores.php");
    
    if (!isset($_SESSION['login'])) {
        Header("Location: login.php");
    } else {
        $usuario = $_SESSION['login'];
    }
    
    if(!isset($_SESSION['privilegios'])){
        Header("Location: interfazBuscador.php");
    }

	if (isset($_REQUEST["proveedor-elemento"])) {
		$proveedor = $_REQUEST["proveedor-elemento"];
		unset($_SESSION["proveedor-elemento"]);
		
		$conexion = crearConexionBD();		
		$excepcion = quitar_proveedor($conexion, $proveedor);
		cerrarConexionBD($conexion);
			
		if ($excepcion != "") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "formulario_baja.php";
			Header("Location: excepcion.php");
		}
		else{
            $_SESSION["mensjProveedor"] = "Proveedor eliminado correctamente";
            Header("Location: formulario_baja.php");
        } 
	}
	else{
        Header("Location: interfaz_buscador.php"); 
    }
?>