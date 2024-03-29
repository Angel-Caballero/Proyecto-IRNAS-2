<?php

function alta_usuario($conexion,$usuario) {

	try {
			$consulta = "CALL INSERTAR_USUARIO(:nombre, :pass, :email, :tipo)";
			$stmt=$conexion->prepare($consulta);
			$stmt->bindParam(':nombre',$usuario["nombre"]);
			$stmt->bindParam(':pass',$usuario["pass"]);
			$stmt->bindParam(':email',$usuario["email"]);
			$stmt->bindParam(':tipo',$usuario["tipo"]);
			
			$stmt->execute();
		return true;
	} catch(PDOException $e) {
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
    }
}
 
function consultarUsuario($conexion,$nombre,$pass) {
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

function consultarTipoUsuario($conexion,$nombre,$pass) {
	try{
$consulta = "SELECT TIPO FROM USUARIOS WHERE NOMBRE=:nombre AND PASS=:pass";
 $stmt = $conexion->prepare($consulta);
 $stmt->bindParam(':nombre',$nombre);
	$stmt->bindParam(':pass',$pass);
 $stmt->execute();
 $result = $stmt->fetch();
 return $result["TIPO"];
} catch(PDOException $e) {
 return $e->getMessage();
 }
}

function quitar_usuario($conexion,$nombre) {
	try {
		$stmt=$conexion->prepare('CALL QUITAR_USUARIO(:nombre)');
		$stmt->bindParam(':nombre',$nombre);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->GetMessage();
    }
}

?>