<?php

 function alta_mobiliario($conexion,$mobiliario) {
	try {
        $almacen = $mobiliario["almacen"];
        if($mobiliario["tipo-mob"] == "ambiente"){
            $consulta = "CALL INSERTAR_TEMP_AMB(:nombre, :tipo, :almacen)";
			$stmt=$conexion->prepare($consulta);
			$stmt->bindParam(':nombre',$mobiliario["nombre"]);
			$stmt->bindParam(':tipo',$mobiliario["tipo-temp-amb"]);
			$stmt->bindParam(':almacen',$almacen["NOMBRE"]);
			
			$stmt->execute();
        }else if($mobiliario["tipo-mob"] == "frio"){
            $consulta = "CALL INSERTAR_EQU_FR(:nombre, :temp, :almacen)";
			$stmt=$conexion->prepare($consulta);
			$stmt->bindParam(':nombre',$mobiliario["nombre"]);
			$stmt->bindParam(':temp',$mobiliario["tipo-temp-amb"]);
			$stmt->bindParam(':almacen',$almacen["NOMBRE"]);
			
			$stmt->execute();
        }
		
		return true;
	} catch(PDOException $e) {
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
    }
}

?>