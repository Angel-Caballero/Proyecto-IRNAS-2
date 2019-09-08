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

<h1>Información general:</h1>

<p style="padding: 0 10%">Esta es una página web que sirve como base de datos para la gestión de recursos y almacenes del Centro de investigación IRNAS.</br></p>

<h1>Uso del buscador de recursos y almacenes:</h1>

<p style="padding: 0 10%">Para empezar a usar la base de datos, ingrese en el buscador el almacén o recurso que desee buscar, y seleccione el tipo del mismo.
O si quiere obtener todos los recursos o almacenes, solamente debe dejar el buscador vacío para obtener todos los resultados de manera paginada.</br>
Una vez la búsqueda se realice, aparecerá una lista de resultados con las características más destacadas de cada uno según su eleción de almacenes o recursos. 
En el caso de los almacenes, 
si decide acceder a uno de ellos le aparecerán todos los recursos que hay en dicho almacén. Cuando esté en la lista de recursos, sea por haber seleccionado su opción 
en el buscador o por haber accedido desde un almacén, habrá un botón de "Información" al lado de cada recurso que le redirigirá a otra página con información
detallada del recurso seleccionado.</br></p>

<h1>Funciones especiales para administradores:</h1>

<p style="padding: 0 10%">En caso de ser administrador, a parte de poder realizar las búsquedas básicas, podrá añadir y eliminar recursos, almacenes, mobiliario, 
proveedores o usuarios desde la 
opción "Insertar elementos" y "Eliminar elementos" , respectivamente, que se encuentran en el menú en la parte superior derecha. Así mismo, podrá 
modificar las unidades de los recursos "Reactivos" y "Fungibles y kits" desde la página en la que se detallan los recursos después de una búsqueda.</br></p>

<h3>Uso de "Insertar elementos":</h3>

<p style="padding: 0 10%">Para insertar un elemento solamente hay que seleccionar el tipo que queremos insertar de los que se nos ofrecen en la parte superior izquierda,
 rellenar el formulario que nos muestran sin ningún error y pulsar el botón de creación.</br></p>

<h3>Uso de "Eliminar elementos":</h3>

<p style="padding: 0 10%">Para eliminar un elemento solamente hay que seleccionar el tipo de elemento que queremos eliminar de los 
que se nos ofrecen en la parte superior izquierda, seleccionar el elemento que queremos eliminar y pulsar el botón de eliminación.</br></p>

<?php	
	include_once("pie.php");
?>		
</div>
</body>
</html>