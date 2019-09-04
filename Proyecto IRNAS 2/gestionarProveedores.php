<?php

function alta_proveedor($conexion,$proveedor) {
    try {
      $consulta = "CALL INSERTAR_PROVEEDOR(:nombre-emp, :nombre-com, :email)";
      $stmt=$conexion->prepare($consulta);
      $stmt->bindParam(':nombre-emp',$proveedor["nombre-empresa"]);
      $stmt->bindParam(':nombre-com',$proveedor["nombre-comercial"]);
      $stmt->bindParam(':email',$proveedor["email"]);

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

function alta_telefono($conexion, $telefono, $proveedor) {
  try {

    $consulta = "CALL INSERTAR_TELEFONOS(:tef, :id)";
    $stmt=$conexion->prepare($consulta);
    $stmt->bindParam(':tef',$telefono);
    $stmt->bindParam(':id',$proveedor);

    $stmt->execute();
  return true;
  }

  catch(PDOException $e) {
  return false;
  // Si queremos visualizar la excepción durante la depuración: $e->getMessage();
  }
}

?>