<?php
session_start();
if (isset($_SESSION["formularioRecurso"])) {
    $nuevoRecurso["nombre"] = $_REQUEST["nombre"];
    $nuevoRecurso["almacen"] = $_REQUEST["almacen"];
    $nuevoRecurso["tipo-recurso"] = $_REQUEST["tipo-recurso"];
    $nuevoRecurso["posicion"] = $_REQUEST["posicion"];
    $nuevoRecurso["unidades"] = $_REQUEST["unidades"];
    $nuevoRecurso["formula"] = $_REQUEST["formula"];
    $nuevoRecurso["cantidad"] = $_REQUEST["cantidad"];
    $nuevoRecurso["reserva"] = $_REQUEST["reserva"];
    $nuevoRecurso["ficha"] = $_REQUEST["ficha"];
    $nuevoRecurso["proveedores"] = $_REQUEST["proveedores"];
    $_SESSION["formularioRecurso"] = $nuevoRecurso;		
}

else 
    Header("Location: añadir.php");

    $conexion = crearConexionBD(); 
	$errores = validarDatosProveedor($conexion, $nuevoRecurso);
    cerrarConexionBD($conexion);
    
if (count($errores)>0) {
	
	$_SESSION["errores"] = $errores;
	Header('añadir.php');
} else
	
    Header('Location: accion_alta_usuario.php');
        
function validarDatosProveedor($conexion, $nuevoRecurso){
    $errores=array();

    if($nuevoRecurso["nombre"]=="") 
    $errores[] = "<p>El nombre no puede estar vacío</p>";

    if($nuevoRecurso["tipo-recurso"] != "Compuesto quimico" &&
    $nuevoRecurso["tipo-recurso"] != "Fungible y kits" && 
    $nuevoRecurso["tipo-recurso"] != "Material biologico") {
    $errores[] = "<p>El tipo de recurso debe ser Compuesto quimico, Fungible y kits o Material biologico</p>";
        
    if($nuevoRecurso["posicion"]=="") 
    $errores[] = "<p>La posicion no puede estar vacía</p>";
    }
}
?>