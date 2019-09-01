<?php
session_start()
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/general.css" />
  <link rel="stylesheet" type="text/css" href="css/menu.css" />
  <script type="text/javascript" src="./js/menu.js"></script>
  <link rel="icon" href="images/icono.png"/>
  <title>Información</title>
</head>

<body>
<div class="contenido">
<?php
    include_once("cabecera.php");
?>
<div class="centrado" style="flex-direction:column">
<?php
    include_once("menu.php");
?>

<h3>Información</h3>

<p style="padding: 0 10%">Esta es una página web para la gestión de recursos del Centro de investigación IRNAS.</br>
Para empezar a usarla, ingrese en el buscador el almacén o recurso que desee buscar, y seleccione el tipo del mismo.
Una vez la búsqueda se realice, aparecerá una lista de resultados, en la cual podrá ver la lista de recursos o de
almacenes. Al acceder a un almacén, aparecerán todos los recursos que hay en dicho almacén. Al hacer click en el
botón de información aparecerá la información de dicho material. En caso de ser administrador, podrá añadir nuevos
recursos, almacenes, mobiliario, proveedores o usuarios desde la opción "Insertar Recursos" en el menú en la parte
superior derecha.</p>



<?php	
	include_once("pie.php");
?>		
</div>
</body>
</html>