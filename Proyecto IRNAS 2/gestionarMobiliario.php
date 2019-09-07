<?php

 function alta_mobiliario($conexion,$mobiliario) {
	try {
        if($mobiliario["tipo-mob"] == "ambiente"){
            $consulta = "CALL INSERTAR_TEMP_AMB(:nombre, :tipo, :almacen)";
			$stmt=$conexion->prepare($consulta);
			$stmt->bindParam(':nombre',$mobiliario["nombre"]);
			$stmt->bindParam(':tipo',$mobiliario["tipo-temp-amb"]);
			$stmt->bindParam(':almacen',$mobiliario["almacen"]);
			
			$stmt->execute();
        }else if($mobiliario["tipo-mob"] == "frio"){
            $consulta = "CALL INSERTAR_EQU_FR(:nombre, :temp, :almacen)";
			$stmt=$conexion->prepare($consulta);
			$stmt->bindParam(':nombre',$mobiliario["nombre"]);
			$stmt->bindParam(':temp',$mobiliario["temperatura"]);
			$stmt->bindParam(':almacen',$mobiliario["almacen"]);
			
			$stmt->execute();
        }
		
		return true;
	} catch(PDOException $e) {
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
    }
}function quitar_equipo_frio($conexion, $id_fr){
	try{
		$stmt=$conexion->prepare('CALL QUITAR_EQUIPOS_FRIO(:id_fr)');
		$stmt->bindParam(':id_fr',$id_fr);
		$stmt->execute();
		return "";
	}catch(PDOException $e) {
		return $e->GetMessage();
    }
}

function quitar_temperatura_ambiente($conexion, $id_ta){
	try{
		$stmt=$conexion->prepare('CALL QUITAR_TEMPERATURA_AMBIENTE(:id_ta)');
		$stmt->bindParam(':id_ta',$id_ta);
		$stmt->execute();
		return "";
	}catch(PDOException $e) {
		return $e->GetMessage();
    }
}

?>