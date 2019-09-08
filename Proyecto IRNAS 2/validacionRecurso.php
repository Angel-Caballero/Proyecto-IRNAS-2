<?php

session_start();

require_once("gestionBD.php");
require_once("gestionarAlmacenes.php");
require_once("gestionarProveedores.php");

if (isset($_SESSION["formularioRecurso"])) {

    $nuevoRecurso["nombre"] = $_REQUEST["recurso-nombre"];
    $nuevoRecurso["almacen"] = $_REQUEST["recurso-almacen"];
    $nuevoRecurso["tipo"] = $_REQUEST["recurso-tipo"];
    $nuevoRecurso["posicion"] = $_REQUEST["recurso-posicion"];

    if($nuevoRecurso["tipo"] == "Fungible" || $nuevoRecurso["tipo"] == "Reactivo"){

        $nuevoRecurso["unidades"] = $_REQUEST["recurso-unidades"];
        $nuevoRecurso["cantidad"] = $_REQUEST["recurso-cantidad"];
        $nuevoRecurso["reserva"] = $_REQUEST["recurso-reserva"];
        $nuevoRecurso["proveedor"] = $_REQUEST["recurso-proveedores"];

        if($nuevoRecurso["tipo"] == "Reactivo"){

            $nuevoRecurso["formula"] = $_REQUEST["recurso-formula"];

        }
    }
    
    $_SESSION["formularioRecurso"] = $nuevoRecurso;		
} else{
    Header("Location: formulario_alta.php");
}
    $conexion = crearConexionBD(); 
	$errores = validarDatosRecurso($conexion, $nuevoRecurso);
    cerrarConexionBD($conexion);
    
if (count($errores)>0) {
	$_SESSION["erroresRecurso"] = $errores;
	Header('Location: formulario_alta.php');
} else{	
    Header('Location: accion_alta_recurso.php');
} 

function validarDatosRecurso($conexion, $nuevoRecurso){
    $errores=array();

    //Validación de datos general para todos los tipos
    if($nuevoRecurso["nombre"] == "") {
        $errores[] = "<p>El nombre no puede estar vacío</p>";
    }

    $error = validarAlmacen($conexion, $nuevoRecurso["almacen"]);
    if($error != ""){
		$errores[] = $error;
    }
    
    if($nuevoRecurso["tipo"] != "Reactivo" && $nuevoRecurso["tipo"] != "Fungible" 
    &&  $nuevoRecurso["tipo"] != "Biológico") {
        $errores[] = "<p>El tipo de recurso debe ser Compuesto quimico, Fungible y kits o Material biologico</p>";
    }

    if($nuevoRecurso["posicion"] == "") {
        $errores[] = "<p>La posicion no puede estar vacía</p>";
    }

    //Validación de datos general de Fungibles y kits y de Compuestos químicos
    if($nuevoRecurso["tipo"] != "Biológico"){

        if($nuevoRecurso["unidades"] == "") {
            $errores[] = "<p>Las unidades no puede estar vacías</p>";
        }
    
        if($nuevoRecurso["cantidad"] == "") {
            $errores[] = "<p>La cantidad no puede estar vacía</p>";
        }
    
        if($nuevoRecurso["reserva"] == "") {
            $errores[] = "<p>La reserva no puede estar vacía</p>";
        }

        if($nuevoRecurso["unidades"] < $nuevoRecurso["reserva"]){
            $errores[] = "<p>No puede haber menos unidades que la reserva mínima</p>";
        }
    
        if($nuevoRecurso["proveedor"] == "") {
            $errores[] = "<p>El proveedor no puede estar vacío</p>";
        }

        $error = validarProveedor($conexion, $nuevoRecurso["proveedor"]);
        if($error != ""){
		    $errores[] = $error;
        }

        //Validación de datos específica de Compuestos químicos
        if($nuevoRecurso["tipo"] == "Reactivo"){

            if($nuevoRecurso["formula"] == "") {
                $errores[] = "<p>La fórmula no puede estar vacía</p>";
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

function validarProveedor($conexion, $proveedor){
    $error = "";
    $num_alm = consultarProveedores($conexion, $proveedor);
    
    if($num_alm == 0){
        $error = "<p>El almacén utilizado debe ser uno existente</p>";
    }

    return $error;
}

?>