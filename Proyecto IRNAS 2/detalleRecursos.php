<?php
session_start();

require_once("gestionBD.php");
require_once("gestionarRecurso.php");
require_once("gestionarProveedores.php");

if (!isset($_SESSION['login'])) {
  Header("Location: login.php");
} else {
  $usuario = $_SESSION['login'];
}

if (isset($_SESSION["recurso"])) {
  $recurso = $_SESSION["recurso"];
} else {
  Header("Location: interfazBuscador.php");
}

$conexion = crearConexionBD();

$posicion = buscarPosicion($conexion, $recurso);
$id_prov = buscarProveedor($conexion, $recurso);
$proveedores = obtenerProveedor($conexion, $id_prov);

cerrarConexionBD($conexion);

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/general.css" />
  <link rel="stylesheet" type="text/css" href="css/menu.css" />
  <script src="js/validacion_modificar_recurso.js" type="text/javascript"></script>
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
        <form method="post" action="controlador_recursos.php">
          <?php if ($recurso["TIPO"] == "Reactivo") { ?>
            Nombre: <?php echo $recurso["NOMBRE"] ?><br />
            <input id="NOMBRE" name="NOMBRE" type="hidden" value="<?php echo $recurso["NOMBRE"]; ?>" />
            <br />
            Tipo: <?php echo "Reactivo" ?><br />
            <br />
            Posición: <?php echo $posicion ?><br />
            <br />
            Almacén: <?php echo $recurso["ALMACEN"] ?><br />
            <input id="ALMACEN" name="ALMACEN" type="hidden" value="<?php echo $recurso["ALMACEN"]; ?>" />
            <br />
            <?php
              if (isset($_SESSION["editando"])) { ?>

              <!-- Editando unidades -->
              Unidades antiguas: <?php echo $recurso["UNIDADES"] ?><br />
              <input id="UNIDADES_ANTIGUAS" name="UNIDADES_ANTIGUAS" type="hidden" value="<?php echo $recurso["UNIDADES"]; ?>" />
              <h3><input id="UNIDADES" name="UNIDADES" type="text" value="<?php echo $recurso["UNIDADES"]; ?>" oninput="unidadesValidation();"/> </h3>

            <?php } else { ?>
              <!-- mostrando unidades -->

              Unidades: <?php echo $recurso["UNIDADES"] ?><br />

            <?php } ?>
            <br />
            Cantidad: <?php echo $recurso["CANTIDAD"] ?><br />
            <br />
            Reserva Mínima: <?php echo $recurso["RESERVAMINIMA"] ?><br />
            <br />
            <?php foreach ($proveedores as $proveedor) { ?>
              Proveedor: <?php echo $proveedor["NOMBREEMPRESA"] . " - " .  $proveedor["NOMBRECOMERCIAL"] ?><br />
            <?php } ?>
            <br />
            Fórmula Química: <?php echo $recurso["FORMULAQUIMICA"] ?>
            <?php if (isset($_SESSION["editando"])) { ?>

              <input id="guardar" name="guardar" type="submit" value="Guardar unidades">

            <?php } else { ?>

              <input id="editar" name="editar" type="submit" value="Editar unidades">

            <?php } ?>

          <?php } elseif ($recurso["TIPO"] == "Fungible") { ?>
            Nombre: <?php echo $recurso["NOMBRE"] ?><br />
            <input id="NOMBRE" name="NOMBRE" type="hidden" value="<?php echo $recurso["NOMBRE"]; ?>" />
            <br />
            Tipo: <?php echo "Fungibles y kits" ?><br />
            <br />
            Posición: <?php echo $posicion ?><br />
            <br />
            Almacén: <?php echo $recurso["ALMACEN"] ?><br />
            <input id="ALMACEN" name="ALMACEN" type="hidden" value="<?php echo $recurso["ALMACEN"]; ?>" />
            <br />
            <?php
              if (isset($_SESSION["editando"])) { ?>

              <!-- Editando unidades -->
              Unidades antiguas: <?php echo $recurso["UNIDADES"] ?><br />
              <input id="UNIDADES_ANTIGUAS" name="UNIDADES_ANTIGUAS" type="hidden" value="<?php echo $recurso["UNIDADES"]; ?>" />
              <h3><input id="UNIDADES" name="UNIDADES" type="text" value="<?php echo $recurso["UNIDADES"]; ?>" oninput="unidadesValidation();"/> </h3>

            <?php } else { ?>
              <!-- mostrando unidades -->

              Unidades: <?php echo $recurso["UNIDADES"] ?><br />

            <?php } ?>
            <br />
            Cantidad: <?php echo $recurso["CANTIDAD"] ?><br />
            <br />
            Reserva Mínima: <?php echo $recurso["RESERVAMINIMA"] ?><br />
            <br />
            <?php foreach ($proveedores as $proveedor) { ?>
              Proveedor: <?php echo $proveedor["NOMBREEMPRESA"]  . " - " .  $proveedor["NOMBRECOMERCIAL"] ?><br />
            <?php } ?>
            <?php if (isset($_SESSION["editando"])) { ?>

              <input id="guardar" name="guardar" type="submit" value="Guardar unidades">

            <?php } else { ?>

              <input id="editar" name="editar" type="submit" value="Editar unidades">

            <?php } ?>

          <?php } else { ?>
            Nombre: <?php echo $recurso["NOMBRE"] ?><br />
            <br />
            Tipo: <?php echo "Material biológico" ?><br />
            <br />
            Posición: <?php echo $posicion ?><br />
            <br />
            Almacén: <?php echo $recurso["ALMACEN"] ?><br />
          <?php } ?>
        </form>
      </div>
    </div>
  </div>
  <?php
  include_once("pie.php");
  ?>
</body>

</html>