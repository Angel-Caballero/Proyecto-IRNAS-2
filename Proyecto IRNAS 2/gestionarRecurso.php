<?php

function alta_recurso($conexion,$recurso) {

	try {
		if($recurso["tipo"] == "REACTIVO"){

			$consulta = "CALL INSERTAR_RECURSOS(:nombre, :form, :ficha, :uni, :cant, :res, :tipo, :alm)";
			$stmt=$conexion->prepare($consulta);
			$stmt->bindParam(':nombre',$recurso["nombre"]);
			$stmt->bindParam(':form',$recurso["formula"]);
            $stmt->bindParam(':ficha',$recurso["ficha"]);
            $stmt->bindParam(':uni',$recurso["unidades"]);
            $stmt->bindParam(':cant',$recurso["cantidad"]);
            $stmt->bindParam(':res',$recurso["reserva"]);
            $stmt->bindParam(':tipo',$recurso["tipo"]);
            $stmt->bindParam(':alm',$recurso["almacen"]);

			$stmt->execute();

		}else if ($recurso["tipo"] == "FUNGIBLE") {

			$consulta = "CALL INSERTAR_RECURSOS(:nombre, :form, :ficha, :uni, :cant, :res, :tipo, :alm)";
			$stmt=$conexion->prepare($consulta);
			$stmt->bindParam(':nombre',$recurso["nombre"]);
			$stmt->bindParam(':form', "");
            $stmt->bindParam(':ficha', "");
            $stmt->bindParam(':uni',$recurso["unidades"]);
            $stmt->bindParam(':cant',$recurso["cantidad"]);
            $stmt->bindParam(':res',$recurso["reserva"]);
            $stmt->bindParam(':tipo',$recurso["tipo"]);
            $stmt->bindParam(':alm',$recurso["almacen"]);

			$stmt->execute();

		}else {
			
			$consulta = "CALL INSERTAR_RECURSOS(:nombre, :form, :ficha, :uni, :cant, :res, :tipo, :alm)";
			$stmt=$conexion->prepare($consulta);
			$stmt->bindParam(':nombre',$recurso["nombre"]);
			$stmt->bindParam(':form', "NULL");
            $stmt->bindParam(':ficha', "NULL");
            $stmt->bindParam(':uni', "NULL");
            $stmt->bindParam(':cant', "NULL");
            $stmt->bindParam(':res', "NULL");
            $stmt->bindParam(':tipo',$recurso["tipo"]);
            $stmt->bindParam(':alm',$recurso["almacen"]);

			$stmt->execute();

		}
			
		return true;
	} catch(PDOException $e) {
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
    }
}

function alta_posicion($conexion, $posicion, $recurso, $almacen) {

	try {

			$consulta = "CALL INSERTAR_POSICIONES(:pos, :rec, :alm)";
			$stmt=$conexion->prepare($consulta);
			$stmt->bindParam(':pos',$posicion);
			$stmt->bindParam(':rec',$recurso["nombre"]);
            $stmt->bindParam(':alm',$almacen);

			$stmt->execute();

		return true;
	} catch(PDOException $e) {
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
    }
}

function alta_rec_prov($conexion, $recurso, $almacen, $proveedor) {

	try {

			$consulta = "CALL INSERTAR_PROV_REC (:prov, :rec, :alm)";
			$stmt=$conexion->prepare($consulta);
			$stmt->bindParam(':prov',$proveedor);
			$stmt->bindParam(':rec',$recurso["nombre"]);
			$stmt->bindParam(':alm',$almacen);

			$stmt->execute();

		return true;
	} catch(PDOException $e) {
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
    }
}

?>