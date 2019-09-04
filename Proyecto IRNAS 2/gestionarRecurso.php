<?php

function alta_recurso($conexion,$recurso) {

	try {
			$consulta = "CALL INSERTAR_RECURSOS(:nombre, :form, :ficha, :uni, :cant, :res, :tipo, :alm)";
			$stmt=$conexion->prepare($consulta);
			$stmt->bindParam(':nombre',$recurso["nombre"]);
			$stmt->bindParam(':temp',$recurso["temperatura"]);
            $stmt->bindParam(':temp',$recurso["temperatura"]);
            $stmt->bindParam(':temp',$recurso["temperatura"]);
            $stmt->bindParam(':temp',$recurso["temperatura"]);
            $stmt->bindParam(':temp',$recurso["temperatura"]);
            $stmt->bindParam(':temp',$recurso["temperatura"]);
            $stmt->bindParam(':temp',$recurso["temperatura"]);

			$stmt->execute();
		return true;
	} catch(PDOException $e) {
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
    }
}

?>