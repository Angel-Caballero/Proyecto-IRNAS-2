<?php

session_start();

require_once("gestionBD.php");
require_once("gestionarAlmacenes.php");

if (isset($_SESSION["formularioRecurso"])) {

    $nuevoRecurso["nombre"] = $_REQUEST["recurso-nombre"];
    $nuevoRecurso["almacen"] = $_REQUEST["recurso-almacen"];
    $nuevoRecurso["tipo"] = $_REQUEST["recurso-tipo"];
    $nuevoRecurso["posicion"] = $_REQUEST["recurso-posicion"];

    if($nuevoRecurso["tipo"] == "FUNGIBLE" || $nuevoRecurso["tipo"] == "REACTIVO"){

        $nuevoRecurso["unidades"] = $_REQUEST["recurso-unidades"];
        $nuevoRecurso["cantidad"] = $_REQUEST["recurso-cantidad"];
        $nuevoRecurso["reserva"] = $_REQUEST["recurso-reserva"];
        $nuevoRecurso["proveedores"] = $_REQUEST["recurso-proveedores"];

        if($nuevoRecurso["tipo"] == "REACTIVO"){

            $nuevoRecurso["ficha"] = $_REQUEST["recurso-ficha"];
            $nuevoRecurso["formula"] = $_REQUEST["recurso-formula"];

        }
    }
    
    $_SESSION["formularioRecurso"] = $nuevoRecurso;		
} else{
    Header("Location: formulario_alta.php");
}
    $conexion = crearConexionBD(); 
	$errores = validarDatosProveedor($conexion, $nuevoRecurso);
    cerrarConexionBD($conexion);
    
if (count($errores)>0) {
	$_SESSION["errores"] = $errores;
	Header('formulario_alta.php');
} else{	
    Header('Location: accion_alta_recurso.php');
} 

function validarDatosProveedor($conexion, $nuevoRecurso){
    $errores=array();

    //Validación de datos general para todos los tipos
    if($nuevoRecurso["nombre"] == "") {
        $errores[] = "<p>El nombre no puede estar vacío</p>";
    }

    $error = validarAlmacen($conexion, $nuevoRecurso["almacen"]);
    if($error != ""){
		$errores[] = $error;
    }
    
    if($nuevoRecurso["tipo"] != "REACTIVO" && $nuevoRecurso["tipo"] != "FUNGIBLE" 
    &&  $nuevoRecurso["tipo"] != "BIOLOGICO") {
        $errores[] = "<p>El tipo de recurso debe ser Compuesto quimico, Fungible y kits o Material biologico</p>";
    }

    if($nuevoRecurso["posicion"] == "") {
        $errores[] = "<p>La posicion no puede estar vacía</p>";
    }

    //Validación de datos general de Fungibles y kits y de Compuestos químicos
    if($nuevoRecurso["tipo"] != "BIOLOGICO"){

        if($nuevoRecurso["unidades"] == "") {
            $errores[] = "<p>Las unidades no puede estar vacías</p>";
        }
    
        if($nuevoRecurso["cantidad"] == "") {
            $errores[] = "<p>La cantidad no puede estar vacía</p>";
        }
    
        if($nuevoRecurso["reserva"] == "") {
            $errores[] = "<p>La reserva no puede estar vacía</p>";
        }
    
        if($nuevoRecurso["proveedores"] == "") {
            $errores[] = "<p>Los proveedores no puede estar vacíos</p>";
        }

        //Validación de datos específica de Compuestos químicos
        if($nuevoRecurso["tipo"] == "REACTIVO"){

            if($nuevoRecurso["formula"] == "") {
                $errores[] = "<p>La fórmula no puede estar vacía</p>";
            }

            if($nuevoRecurso["ficha"] == "") {
                $errores[] = "<p>La ficha no puede estar vacía</p>";
            }
        }

        
    }
    
    return $errores;
}

function validarAlmacen($conexion, $almacen){
    $error = "";
    $num_alm = consultarAlmacen($conexion, $almacen);
    
    if($num_alm == 0){
        $error = "<p>El almacén utilizado debe ser uno existente</p>";
    }

    return $error;
}
?>