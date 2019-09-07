<?php	
	session_start();
	
	if (isset($_REQUEST["info"])){
		$recurso["NOMBRE"] = $_REQUEST["NOMBRE"];
		$recurso["FORMULAQUIMICA"] = $_REQUEST["FORMULAQUIMICA"];
		$recurso["FICHASEGURIDAD"] = $_REQUEST["FICHASEGURIDAD"];
		$recurso["UNIDADES"] = $_REQUEST["UNIDADES"];
		$recurso["CANTIDAD"] = $_REQUEST["CANTIDAD"];
		$recurso["RESERVAMINIMA"] = $_REQUEST["RESERVAMINIMA"];
		$recurso["TIPO"] = $_REQUEST["TIPO"];
		$recurso["ALMACEN"] = $_REQUEST["ALMACEN"];
		
		$_SESSION["recurso"] = $recurso;
			
		Header("Location: detalleRecursos.php"); 
	}else if (isset($_REQUEST["baja"])) {
		$recurso["nombre"] = $_REQUEST["NOMBRE"];
        $recurso["almacen"] = $_REQUEST["ALMACEN"];
        $_SESSION["baja_rec"] = $recurso;
		Header("Location: accion_borrar_recurso.php");
	}
	else if (isset($_REQUEST["editar"])) {
        $_SESSION["editando"] = "";
		Header("Location: detalleRecursos.php");
	}
	else if (isset($_REQUEST["guardar"])) {
		unset($_SESSION["editando"]);
		$recurso["NOMBRE"] = $_REQUEST["NOMBRE"];
		$recurso["ALMACEN"] = $_REQUEST["ALMACEN"];
		$recurso["UNIDADES"] = $_REQUEST["UNIDADES"];
		$_SESSION["editar_rec"] = $recurso;
		Header("Location: accion_modificar_recurso.php");
	}
	else {
        Header("Location: listaResultados.php");
    }
	
?>