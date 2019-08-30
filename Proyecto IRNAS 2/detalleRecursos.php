<?php
session_start();

if (!isset($_SESSION['login'])) {
  Header("Location: login.php");
} else {
  $usuario = $_SESSION['login'];
}

if (isset($_SESSION["recurso"])) {
  $recurso = $_SESSION["recurso"];
} else {
  Header("Location: listaResultados.php");
}

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
        <?php if ($recurso["TIPO"] == "REACTIVO") { ?>
          Nombre: <?php echo $recurso["NOMBRE"] ?><br />
          <br />
          Posición: <?php echo $recurso["NOMBRE"] ?><br />
          <br />
          Almacén: <?php echo $recurso["ALMACEN"] ?><br />
          <br />
          Unidades: <?php echo $recurso["UNIDADES"] ?><br />
          <br />
          Cantidad: <?php echo $recurso["CANTIDAD"] ?><br />
          <br />
          Reserva Mínima: <?php echo $recurso["RESERVAMINIMA"] ?><br />
          <br />
          Proveedores: <?php echo $recurso["NOMBRE"] ?><br />
          <br />
          Fórmula Química: <?php echo $recurso["FORMULAQUIMICA"] ?>

        <?php } elseif ($recurso["TIPO"] == "FUNGIBLE") { ?>
          Nombre: <?php echo $recurso["NOMBRE"] ?><br />
          <br />
          Posición: <?php echo $recurso["NOMBRE"] ?><br />
          <br />
          Almacén: <?php echo $recurso["ALMACEN"] ?><br />
          <br />
          Unidades: <?php echo $recurso["UNIDADES"] ?><br />
          <br />
          Cantidad: <?php echo $recurso["CANTIDAD"] ?><br />
          <br />
          Reserva Mínima: <?php echo $recurso["RESERVAMINIMA"] ?><br />
          <br />
          Proveedores: <?php echo $recurso["NOMBRE"] ?><br />

        <?php } else { ?>
          Nombre: <?php echo $recurso["NOMBRE"] ?><br />
          <br />
          Posición: <?php echo $recurso["NOMBRE"] ?><br />
          <br />
          Almacén: <?php echo $recurso["ALMACEN"] ?><br />

        <?php } ?>
      </div>
    </div>
  </div>
  <?php
  include_once("pie.php");
  ?>
</body>

</html>