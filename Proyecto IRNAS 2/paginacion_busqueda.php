<?php
function consulta_paginada($conexion, $query, $pag_num, $pag_size)
{
	try {
		$primera = ( $pag_num - 1 ) * $pag_size + 1;
		$ultima  = $pag_num * $pag_size;
		$consulta_paginada = 
			 "SELECT * FROM ( "
				."SELECT ROWNUM RNUM, AUX.* FROM (SELECT * FROM RECURSOS WHERE NOMBRE LIKE :nombre ORDER BY NOMBRE) AUX "
				."WHERE ROWNUM <= :ultima"
			.") "
			."WHERE RNUM >= :primera";

        $stmt = $conexion->prepare( $consulta_paginada);
        $stmt->bindParam( ':nombre', $query );
		$stmt->bindParam( ':primera', $primera );
		$stmt->bindParam( ':ultima',  $ultima  );
		$stmt->execute();
		return $stmt;
	}	
	catch ( PDOException $e ) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
} 

function total_consulta($conexion, $query)
{
	try {
		$total_consulta = "SELECT COUNT(*) AS TOTAL FROM (SELECT * FROM RECURSOS WHERE NOMBRE LIKE :nombre ORDER BY NOMBRE)";

        $stmt = $conexion->prepare($total_consulta);
        $stmt->bindParam( ':nombre', $query );
		$result = $stmt->fetch();
		$total = $result['TOTAL'];
		return  $total;
	}
	catch ( PDOException $e ) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
} 
?>