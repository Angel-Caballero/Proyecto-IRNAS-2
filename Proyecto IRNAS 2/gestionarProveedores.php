<?php

function alta_proveedor($conexion,$proveedor) {
    try {
      $consulta = "CALL INSERTAR_PROVEEDORES(:emp, :com, :email)";
      $stmt=$conexion->prepare($consulta);
      $stmt->bindParam(':emp',$proveedor["nombre-empresa"]);
      $stmt->bindParam(':com',$proveedor["nombre-comercial"]);
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

function consultarProveedoresPorAtributos($conexion,$proveedor) {
	try{
 	$consulta = "SELECT COUNT(*) AS TOTAL FROM PROVEEDORES WHERE NOMBREEMPRESA=:emp AND NOMBRECOMERCIAL=:com AND EMAIL=:email";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':emp',$proveedor["nombre-empresa"]);
  $stmt->bindParam(':com',$proveedor["nombre-comercial"]);
  $stmt->bindParam(':email',$proveedor["email"]);
	$stmt->execute();
	return $stmt->fetchColumn();
} catch(PDOException $e) {
	return $e->getMessage();
	}
}

function busquedaProveedor($conexion,$proveedor) {
	try{
 	$consulta = "SELECT ID_PR FROM PROVEEDORES WHERE NOMBREEMPRESA=:emp AND NOMBRECOMERCIAL=:com AND EMAIL=:email";
	$stmt = $conexion->prepare($consulta);
  $stmt->bindParam(':emp',$proveedor["nombre-empresa"]);
  $stmt->bindParam(':com',$proveedor["nombre-comercial"]);
  $stmt->bindParam(':email',$proveedor["email"]);
	$stmt->execute();
	return $stmt->fetchColumn();
} catch(PDOException $e) {
	return $e->getMessage();
	}
}

function bucle_alta_telefonos($conexion, $proveedor) {
  $id = busquedaProveedor($conexion, $proveedor);

  $tef1 = alta_telefono($conexion, $proveedor["telefono1"], $id);

  if(isset($proveedor["telefono2"])){
    $tef2 = alta_telefono($conexion, $proveedor["telefono2"], $id);
  }

  if(isset($proveedor["telefono3"])){
    $tef3 = alta_telefono($conexion, $proveedor["telefono3"], $id);
  }
    return false;
  

  if(isset($tef2) && isset($tef3)){
    return $tef1 && $tef2 && $tef3;
  }else if(isset($tef2)){
    return $tef1 && $tef2;
  }else if(isset($tef3)){
    return $tef1 && $tef3;
  }else{
    return $tef1;
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

function obtenerProveedor($conexion,$id) {
	try{
 	$consulta = "SELECT * FROM PROVEEDORES WHERE ID_PR=:id";
	$stmt = $conexion->prepare($consulta);
  $stmt->bindParam(':id',$id);
  $stmt->execute();
  
	return $stmt;
} catch(PDOException $e) {
	$_SESSION['excepcion'] = $e->GetMessage();
	header("Location: excepcion.php");
	}
}

?>