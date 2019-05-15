<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de usuarios de la capa de acceso a datos
     * #==========================================================#
     */

 function alta_usuario($conexion,$usuario) {

	try {
		$consulta = "CALL INSERTAR_USUARIO(:nombre, :pass, :email, :tipo)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombre',$usuario["nombre"]);
		$stmt->bindParam(':pass',$usuario["pass"]);
		$stmt->bindParam(':email',$usuario["email"]);
		$stmt->bindParam(':tipo',$usuario["tipo"]);
		
		$stmt->execute();
		
		return asignar_generos_usuario($conexion, $usuario["nif"], $usuario["generoLiterario"]);
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

