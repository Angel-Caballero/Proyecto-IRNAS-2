<?php

function buscarRecursos($conexion, $nombre){
    try{
		$consulta = "SELECT * FROM RECURSOS WHERE lower(NOMBRE) LIKE CONCAT('%',CONCAT(:nombre,'%')) OR lower(FORMULAQUIMICA) LIKE CONCAT('%',CONCAT(:nombre,'%'))";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombre',strtolower($nombre));	
		$stmt->execute();	
		
		return $stmt;
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
    }
}

function buscarAlmacenes($conexion, $nombre){
    try{
		$consulta = "SELECT * FROM ALMACENES WHERE lower(NOMBRE) LIKE CONCAT('%',CONCAT(:nombre,'%'))";
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
?>