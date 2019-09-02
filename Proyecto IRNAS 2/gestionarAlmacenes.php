<?php

function alta_almacen($conexion,$almacen) {

	try {
			$consulta = "CALL INSERTAR_Almacenes(:nombre, :temp, :ilum, :tipo)";
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
 
function consultarAlmacen($conexion,$nombre) {
	try{
 	$consulta = "SELECT COUNT(*) AS TOTAL FROM USUARIOS WHERE NOMBRE=:nombre AND PASS=:pass";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':nombre',$nombre);
	$stmt->bindParam(':pass',$pass);
	$stmt->execute();
	return $stmt->fetchColumn();
} catch(PDOException $e) {
	return $e->getMessage();
	}
}

?>