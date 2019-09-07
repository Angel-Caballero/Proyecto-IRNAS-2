<?php	
	session_start();
	
	if (isset($_REQUEST["NOMBRE"])){
        $recurso["nombre"] = $_REQUEST["NOMBRE"];
        $recurso["almacen"] = $_REQUEST["ALMACEN"];
        $_SESSION["baja_rec"] = $recurso;
        Header("Location: accion_borrar_recurso.php");
	}
	else {
        Header("Location: detalleRecursos.php");
    }
	
?>