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
 
?>