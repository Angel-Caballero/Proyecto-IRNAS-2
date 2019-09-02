<?php

 function alta_mobiliario($conexion,$mobiliario) {

	try {
			$consulta = "CALL INSERTAR_USUARIO(:nombre, :pass, :email, :tipo)";
			$stmt=$conexion->prepare($consulta);
			$stmt->bindParam(':nombre',$mobiliario["nombre"]);
			$stmt->bindParam(':pass',$mobiliario["pass"]);
			$stmt->bindParam(':email',$mobiliario["email"]);
			$stmt->bindParam(':tipo',$mobiliario["tipo"]);
			
			$stmt->execute();
		return true;
	} catch(PDOException $e) {
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
    }
}

?>