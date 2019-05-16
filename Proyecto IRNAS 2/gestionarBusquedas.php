<?php

function buscarRecursos($conexion, $nombre){
    try{
		$consulta = "SELECT * FROM RECURSOS WHERE NOMBRE LIKE :nombre";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombre',$nombre);	
		$stmt->execute();	
		
		return $stmt;
	}catch(PDOException $e) {
		return $e->getMessage();
    }
}

function buscarAlmacenes($conexion, $nombre){
    try{
		$consulta = "SELECT * FROM ALMACENES WHERE NOMBRE LIKE :nombre";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombre',$nombre);	
		$stmt->execute();	
		
		return $stmt;
	}catch(PDOException $e) {
		return $e->getMessage();
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
	return $e->getMessage();
	}
}
?>