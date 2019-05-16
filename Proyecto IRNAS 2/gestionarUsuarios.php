<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de usuarios de la capa de acceso a datos
     * #==========================================================#
     */

 function alta_usuario($conexion,$usuario) {

	try {
		if ($usuario["tipo"] == 'TRABAJADOR') {
			$consulta = "CALL INSERTAR_USUARIO(:nombre, :pass, :email, :tipo)";
			$stmt=$conexion->prepare($consulta);
			$stmt->bindParam(':nombre',$usuario["nombre"]);
			$stmt->bindParam(':pass',$usuario["pass"]);
			$stmt->bindParam(':email',$usuario["email"]);
			$stmt->bindParam(':tipo',$usuario["tipo"]);
			
			$stmt->execute();
		}else{
			$consulta = "CALL INSERTAR_USUARIO(:nombre, :pass, :tipo)";
			$stmt=$conexion->prepare($consulta);
			$stmt->bindParam(':nombre',$usuario["nombre"]);
			$stmt->bindParam(':pass',$usuario["pass"]);
			$stmt->bindParam(':tipo',$usuario["tipo"]);
			
			$stmt->execute();
		}
		return true;
	} catch(PDOException $e) {
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
    }
}
 

function consultarUsuario($conexion,$nombre,$pass) {
 	$consulta = "SELECT COUNT(*) AS TOTAL FROM USUARIOS WHERE NOMBRE=:nombre AND PASS=:pass";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':nombre',$nombre);
	$stmt->bindParam(':pass',$pass);
	$stmt->execute();
	return $stmt->fetchColumn();
}

