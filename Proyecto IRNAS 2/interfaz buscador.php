<?php
	session_start();
  	
  	include_once("gestionBD.php");
 	include_once("gestionarUsuarios.php");
	
    if(!isset($_SESSION['login'])){
        Header("Location: login.php");}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/almacen.css" />
  <title>Base de Datos: Buscador</title>
</head>

<body>
<?php
	include_once("cabecera.php");
?>
<section>
	<form action="gestionarBusquedas.php" method="GET">	    
		<input type="search" placeholder="Buscar...">
        <button type="submit">Buscar</button>
        <fieldset>
            <label>
                <input type="radio" name="tipo" value="Almacenes"> Almacenes
            </label>
            <label>
                <input type="radio" name="tipo" value="Recursos"> Recursos
            </label>
        </fieldset>
	</form>
</section>
<?php
	include_once("pie.php");
?>
</body>
</html>