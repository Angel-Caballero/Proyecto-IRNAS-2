<?php

function alta_proveedor($conexion,$proveedor) {
    try {
            $consulta = "CALL INSERTAR_PROVEEDOR(:nombre-emp, :nombre-com, :email, :tel1, :tel2, :tel3)";
            $stmt=$conexion->prepare($consulta);
            $stmt->bindParam(':nombre-emp',$proveedor["nombre-empresa"]);
            $stmt->bindParam(':nombre-com',$proveedor["nombre-comercial"]);
            $stmt->bindParam(':email',$proveedor["email"]);
            $stmt->bindParam(':tel1',$proveedor["telefono1"]);
            $stmt->bindParam(':tel2',$usuario["telefono2"]);
            $stmt->bindParam(':tel3',$usuario["telefono3"]);

            $stmt->execute();
		return true;
    }

    catch(PDOException $e) {
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