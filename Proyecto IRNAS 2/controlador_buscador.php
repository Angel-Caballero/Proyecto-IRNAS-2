<?php	
	session_start();
	if(isset($_REQUEST["tipo"])){
        $tipo = $_REQUEST["tipo"];
        if ($tipo == "Almacen"){
            $almacen = $_REQUEST["search"];
            
            $_SESSION["almacen"] = $almacen;
                
            Header("Location: listaResultados.php"); 
        }
        elseif ($tipo == "Recurso") {
            $recurso = $_REQUEST["search"];
            
            $_SESSION["recurso"] = $recurso;
            Header("Location: listaResultados.php");
        }
    }
	else {
        Header("Location: interfazBuscador.php");
    }
		

?>