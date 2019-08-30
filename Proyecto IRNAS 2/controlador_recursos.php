<?php	
	session_start();
	
	if (isset($_REQUEST["TIPO"])){
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
	}
	else {
        Header("Location: listaResultados.php");
    }
	
?>