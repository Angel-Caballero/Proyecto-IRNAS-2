<?php

function alta_recurso($conexion,$recurso) {

	try {
			$consulta = "CALL INSERTAR_RECURSOS(:nombre, :form, :ficha, :uni, :cant, :res, :tipo, :alm)";
			$stmt=$conexion->prepare($consulta);
			$stmt->bindParam(':nombre',$almacen["nombre"]);
			$stmt->bindParam(':temp',$almacen["temperatura"]);
			$stmt->bindParam(':ilum',$almacen["tipo-iluminacion"]);
			$stmt->bindParam(':tipo',$almacen["tipo-camara"]);
			
			$stmt->execute();
		return true;
	} catch(PDOException $e) {
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
    }
}

function consultarProveedores($conexion,$id) {
	try{
 	$consulta = "SELECT COUNT(*) AS TOTAL FROM PROVEEDORES WHERE ID_PR=:id";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':id',$id);
	$stmt->execute();
	return $stmt->fetchColumn();
} catch(PDOException $e) {
	return $e->getMessage();
	}
}

?>