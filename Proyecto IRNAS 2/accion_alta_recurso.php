<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarRecurso.php");
		
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formularioRecurso"])) {
		$nuevoRecurso = $_SESSION["formularioRecurso"];
		$_SESSION["formularioRecurso"] = null;
		$_SESSION["erroresRecurso"] = null;
	}
	else{
		Header("Location: formulario_alta.php");	
    }

    $conexion = crearConexionBD(); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/general.css" />
  <link rel="stylesheet" type="text/css" href="css/menu.css" />
  <script type="text/javascript" src="./js/menu.js"></script>
  <link rel="icon" href="images/icono.png" />
  <title>Base de Datos: Recurso creado con éxito</title>
</head>

<body>
	<?php
		include_once("cabecera.php");
	?>

	<main>
		<?php if($nuevoRecurso["tipo"] == "BIOLOGICO"){ ?>
			<?php if (alta_recurso($conexion, $nuevoRecurso) 
			|| alta_posicion($conexion, $nuevoRecurso["posicion"], $nuevoRecurso, $nuevoRecurso["almacen"])) {?>
					<h1>Creado el recurso <?php echo $nuevoRecurso["nombre"]; ?> correctamente</h1>
					<div >	
						Pulsa <a href="interfazBuscador.php">aquí</a> volver al buscador.</br>
						O pulsa <a href="formulario_alta.php">aquí</a> para volver al formulario.
					</div>
			<?php } else { ?>
					<h1>El recurso ya existe en la base de datos.</h1>
					<div >	
						Pulsa <a href="formulario_alta.php">aquí</a> para volver al formulario.
					</div>
			<?php } ?>
		<?php }else { ?>
			<?php if (alta_recurso($conexion, $nuevoRecurso) 
			&& alta_posicion($conexion, $nuevoRecurso["posicion"], $nuevoRecurso, $nuevoRecurso["almacen"])
			&& alta_rec_prov($conexion, $nuevoRecurso, $nuevoRecurso["almacen"], $nuevoRecurso["proveedor"])) {?>
					<h1>Creado el recurso <?php echo $nuevoRecurso["nombre"]; ?> correctamente</h1>
					<div >	
						Pulsa <a href="interfazBuscador.php">aquí</a> volver al buscador.</br>
						O pulsa <a href="formulario_alta.php">aquí</a> para volver al formulario.
					</div>
			<?php } else { ?>
					<h1>El recurso ya existe en la base de datos.</h1>
					<div >	
						Pulsa <a href="formulario_alta.php">aquí</a> para volver al formulario.
					</div>
			<?php } ?>
		<?php } ?>
			

	</main>

	<?php
		include_once("pie.php");
	?>
</body>
</html>
<?php
	cerrarConexionBD($conexion);
?>