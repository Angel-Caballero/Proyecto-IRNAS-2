<?php
//Seccion de Recursos
function buscarRecursos($conexion, $nombre){
    try{
		$consulta = "SELECT * FROM RECURSOS WHERE lower(NOMBRE) LIKE CONCAT('%',CONCAT(:nombre,'%')) 
		OR lower(FORMULAQUIMICA) LIKE CONCAT('%',CONCAT(:nombre,'%')) ORDER BY NOMBRE";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombre',strtolower($nombre));	
		$stmt->execute();	
		
		return $stmt;
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
    }
}

function todosLosRecursos($conexion){
	$consulta = "SELECT * FROM RECURSOS WHERE (NOMBRE = NOMBRE) ORDER BY NOMBRE";
    return $conexion->query($consulta);
}

//Seccion de Almacenes
function buscarAlmacenes($conexion, $nombre){
    try{
		$consulta = "SELECT * FROM ALMACENES WHERE lower(NOMBRE) LIKE CONCAT('%',CONCAT(:nombre,'%'))
		ORDER BY NOMBRE";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombre',strtolower($nombre));	
		$stmt->execute();	
		
		return $stmt;
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
    }
}

function recursosEnAlmacen($conexion, $almacen){
	try{
	$consulta = "SELECT * FROM RECURSOS WHERE ALMACEN LIKE :almacen";
	$stmt=$conexion->prepare($consulta);
	$stmt->bindParam(':almacen',$almacen);	
	$stmt->execute();	
	
	return $stmt;
}catch(PDOException $e) {
	$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
}

function todosLosAlmacenes($conexion){
	$consulta = "SELECT * FROM ALMACENES WHERE (NOMBRE = NOMBRE) ORDER BY NOMBRE";
    return $conexion->query($consulta);
}

//Seccion de Proveedores
function todosLosProveedores($conexion){
	$consulta = "SELECT * FROM PROVEEDORES WHERE (ID_PR = ID_PR) ORDER BY NOMBREEMPRESA";
    return $conexion->query($consulta);
}
?>