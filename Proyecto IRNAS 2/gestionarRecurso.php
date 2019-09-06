<?php

function alta_recurso($conexion,$recurso) {

	try {
		$nulo = null;

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
			$stmt->bindParam(':form', $nulo);
            $stmt->bindParam(':ficha', $nulo);
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
			$stmt->bindParam(':form', $nulo);
            $stmt->bindParam(':ficha', $nulo);
            $stmt->bindParam(':uni', $nulo);
            $stmt->bindParam(':cant', $nulo);
            $stmt->bindParam(':res', $nulo);
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

function buscarPosicion($conexion, $recurso){
    try{
		$consulta = "SELECT POSICION FROM POSICIONES WHERE RECURSO=:nombre AND ALMACEN=:alm";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombre',$recurso["NOMBRE"]);	
		$stmt->bindParam(':alm',$recurso["ALMACEN"]);
		$stmt->execute();
		$result = $stmt->fetch();
		
		return $result["POSICION"];
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
    }
}

function buscarProveedor($conexion, $recurso){
    try{
		$consulta = "SELECT PROVEEDOR FROM PROVEEDORES_RECURSOS WHERE RECURSO=:nombre AND ALMACEN=:alm";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombre',$recurso["NOMBRE"]);	
		$stmt->bindParam(':alm',$recurso["ALMACEN"]);	
		$stmt->execute();
		$result = $stmt->fetch();
		
		return $result["PROVEEDOR"];
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
    }
}

function modificar_unidades($conexion,$unidades,$recurso) {
	try {
		$stmt=$conexion->prepare('CALL MODIFICAR_UNIDADES_RECURSO(:nombre,:alm,:uni)');
		$stmt->bindParam(':uni',$unidades);
		$stmt->bindParam(':nombre',$recurso["NOMBRE"]);
		$stmt->bindParam(':alm',$recurso["ALMACEN"]);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
    }
}

function quitar_recurso($conexion,$recurso) {
	try {
		$stmt=$conexion->prepare('CALL QUITAR_RECURSO(:nombre,:alm)');
		$stmt->bindParam(':nombre',$recurso["NOMBRE"]);
		$stmt->bindParam(':alm',$recurso["ALMACEN"]);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
    }
}

?>