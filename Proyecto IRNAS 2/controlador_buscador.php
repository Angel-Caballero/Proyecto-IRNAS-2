<?php	
	session_start();
	
	if (isset($_REQUEST["Almacenes"])){
		$almacen["search"] = $_REQUEST["search"];
		
		$_SESSION["almacen"] = $almacen;
			
		Header("Location: consulta_libros.php"); 
    }
    elseif (isset($_REQUEST["Recursos"])) {
        # code...
    }
	else 
		Header("Location: interfaz_buscador.php");

?>