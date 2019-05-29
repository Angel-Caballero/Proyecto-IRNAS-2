<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/almacen.css" />
  <link rel="stylesheet" type="text/css" href="css/menu.css" />
	<script type="text/javascript" src="./js/menu.js"></script>
  <link rel="icon" href="images/icono.png"/>
  <title>Base de Datos: Recurso Detallado</title>
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
<div class="centrado" style="max-width:500px; flex-direction:column">
Nombre: <?php echo ?><br/>
<br/>
Posición: <?php echo ?><br/>
<br/>
Almacén: <?php echo ?><br/>
<br/>
Unidades: <?php echo ?><br/>
<br/>
Cantidad: <?php echo ?><br/>
<br/>
Reserva Mínima: <?php echo ?><br/>
<br/>
Proveedores: <?php echo ?><br/>
<br/>
Fórmula Química: <?php echo ?>
</div>
   </div>
</div>
<?php
	include_once("pie.php");
?>
</body>
</html>