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
		
    if (isset($_SESSION["editar_rec"])) {
        $recurso = $_SESSION["editar_rec"];
        unset($_SESSION["editar_rec"]);
        
		$conexion = crearConexionBD();		
		$excepcion = modificar_unidades($conexion, $recurso);
		cerrarConexionBD($conexion);
			
		if ($excepcion != "") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "detalleRecursos.php";
			Header("Location: excepcion.php");
		}
		else{
            Header("Location: interfazBuscador.php");
        } 
	}
	else{
        Header("Location: interfazBuscador.php"); 
    }
?>