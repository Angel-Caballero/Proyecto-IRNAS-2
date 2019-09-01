<?php
session_start();

require_once("gestionBD.php");
require_once("gestionarBusquedas.php");
require_once("gestionarUsuarios.php");

if (!isset($_SESSION['login'])) {
  Header("Location: login.php");
} else {
  $usuario = $_SESSION['login'];
}

if (!isset($_SESSION["formularioUsuario"])) {
  $nuevoUsuario["nombre"] = '';
  $nuevoUsuario["email"] = '';
  $nuevoUsuario["pass"] = '';
  $nuevoUsuario["tipo"] = '';
  $_SESSION["formularioUsuario"] = $nuevoUsuario;
} else {
  $nuevoUsuario = $_SESSION["formularioUsuario"];
}

if (!isset($_SESSION["formularioRecurso"])) {
  $nuevoRecurso["nombre"] = '';
  $nuevoRecurso["almacen"] = '';
  $nuevoRecurso["tipo-recurso"] = '';
  $nuevoRecurso["posicion"] = '';
  $nuevoRecurso["unidades"] = '';
  $nuevoRecurso["formula"] = '';
  $nuevoRecurso["cantidad"] = '';
  $nuevoRecurso["reserva"] = '';
  $nuevoRecurso["ficha"] = '';
  $nuevoRecurso["proveedores"] = '';
  $_SESSION["formularioRecurso"] = $nuevoRecurso;
} else {
  $nuevoRecurso = $_SESSION["formularioRecurso"];
}

if (!isset($_SESSION["formularioProveedor"])) {
  $nuevoProveedor["nombre-empresa"] = '';
  $nuevoProveedor["nombre-comercial"] = '';
  $nuevoProveedor["email"] = '';
  $nuevoProveedor["telefono1"] = '';
  $nuevoProveedor["telefono2"] = '';
  $nuevoProveedor["telefono3"] = '';
  $_SESSION["formularioProveedor"] = $nuevoProveedor;
} else {
  $nuevoProveedor = $_SESSION["formularioProveedor"];
}

if (!isset($_SESSION["formularioMobiliario"])) {
  $nuevoMobiliario["tipo-mobiliario"] = '';
  $nuevoMobiliario["almacen"] = '';
  $nuevoMobiliario["nombre"] = '';
  $nuevoMobiliario["tipo"] = '';
  $nuevoMobiliario["temperatura"] = '';
  $_SESSION["formularioMobiliario"] = $nuevoMobiliario;
} else {
  $nuevoMobiliario = $_SESSION["formularioMobiliario"];
}

if (!isset($_SESSION["formularioAlmacen"])) {
  $nuevoAlmacen["nombre"] = '';
  $nuevoAlmacen["tipo-iluminacion"] = '';
  $nuevoAlmacen["temperatura"] = '';
  $nuevoAlmacen["tipo-camara"] = '';
  $_SESSION["formularioAlmacen"] = $nuevoAlmacen;
} else {
  $nuevoAlmacen = $_SESSION["formularioAlmacen"];
}

$conexion = crearConexionBD();

$almacenes = todosLosAlmacenes($conexion);
$proveedores = todosLosProveedores($conexion);

cerrarConexionBD($conexion);

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/general.css" />
  <link rel="stylesheet" type="text/css" href="css/menu.css" />
  <link rel="stylesheet" type="text/css" href="css/formularios.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script type="text/javascript" src="./js/menu.js"></script>
  <script type="text/javascript" src="./js/formularios.js"></script>
  <link rel="icon" href="images/icono.png" />
  <title>Base de Datos: Añadir Recursos</title>
</head>

<body onload="recursoform()">
  <div class="contenido">
    <?php
    include_once("cabecera.php");
    ?>
    <div class="centrado" style="flex-direction:column">
      <?php
      include_once("menu.php");
      ?>
      <div style="width:100%">
        <ul>
          <li onclick="recursoform()" class="activo">Recurso</li>
          <li onclick="proveedorform()">Proveedor</li>
          <li onclick="almacenform()">Almacén</li>
          <li onclick="mobiliarioform()">Mobiliario</li>
          <li onclick="usuarioform()">Usuario</li>
        </ul>
      </div>
      <!--Formulario de recurso-->
      <div id="recurso">
        <form action="validacionRecurso.php" id="recurso-form" method="post" class="formulario">

          <div><label for="recurso-nombre">Nombre</label>
            <input id="recurso-nombre" name="recurso-nombre" type="text" value="<?php echo $nuevoRecurso['nombre']; ?>" required></div>

          <div><label for="recurso-almacen">Almacén</label>
            <select id="recurso-almacen" name="recurso-almacen">
              <?php foreach ($almacenes as $almacen) {
                if ($almacen["NOMBRE"] == $nuevoRecurso["almacen"]) {
                  echo "<option value='" . $almacen["NOMBRE"] . "' label='" . $almacen["NOMBRE"] . "' selected/>";
                } else {
                  echo "<option value='" . $almacen["NOMBRE"] . "' label='" . $almacen["NOMBRE"] . "'/>";
                }
              } ?>
            </select></div>

          <div><label for="recurso-tipo">Tipo recurso</label>
            <select id="recurso-tipo" name="recurso-tipo">
              <?php if ($nuevoRecurso["tipo-recurso"] == "Compuesto quimico") { ?>
                <option value="Compuesto quimico" selected>Compuesto químico</option>
                <option value="Fungible y kits">Fungible y kits</option>
                <option value="Material biologico">Material biológico</option>
              <?php } elseif ($nuevoRecurso["tipo-recurso"] == "Fungible y kits") { ?>
                <option value="Compuesto quimico">Compuesto químico</option>
                <option value="Fungible y kits" selected>Fungible y kits</option>
                <option value="Material biologico">Material biológico</option>
              <?php } elseif ($nuevoRecurso["tipo-recurso"] == "Material biologico") { ?>
                <option value="Compuesto quimico">Compuesto químico</option>
                <option value="Fungible y kits">Fungible y kits</option>
                <option value="Material biologico" selected>Material biológico</option>
              <?php } else { ?>
                <option value="Compuesto quimico">Compuesto químico</option>
                <option value="Fungible y kits">Fungible y kits</option>
                <option value="Material biologico">Material biológico</option>
              <?php } ?>
            </select></div>

          <div><label for="recurso-posicion">Posición</label>
            <input id="recurso-posicion" name="recurso-posicion" type="text" value="<?php echo $nuevoRecurso['posicion']; ?>" required></div>

          <div><label for="recurso-unidades">Unidades</label>
            <input id="recurso-unidades" name="recurso-unidades" type="number" value="<?php echo $nuevoRecurso['unidades']; ?>"></div>

          <div><label for="recurso-formula">Fórmula química</label>
            <input id="recurso-formula" name="recurso-formula" type="text" value="<?php echo $nuevoRecurso['formula']; ?>"></div>

          <div><label for="recurso-cantidad">Cantidad</label>
            <input id="recurso-cantidad" name="recurso-cantidad" type="number" value="<?php echo $nuevoRecurso['cantidad']; ?>"></div>

          <div><label for="recurso-reserva">Reserva mínima</label>
            <input id="recurso-reserva" name="recurso-reserva" type="number" value="<?php echo $nuevoRecurso['reserva']; ?>"></div>

          <div><label for="recurso-ficha">Ficha seguridad</label>
            <input id="recurso-ficha" name="recurso-ficha" type="file" value="<?php echo $nuevoRecurso['ficha']; ?>"></div>

          <div><label for="recurso-proveedores">Proveedores</label>
            <select id="recurso-proveedores" name="recurso-proveedores" multiple>
              <?php foreach ($proveedores as $proveedor) {
                if ($nuevoRecurso["proveedores"] == $proveedor["ID_PR"]) {
                  echo "<option value='" . $proveedor["ID_PR"] . "' label='" . $proveedor["NOMBREEMPRESA"] . "' selected/>";
                } else {
                  echo "<option value='" . $proveedor["ID_PR"] . "' label='" . $proveedor["NOMBREEMPRESA"] . "'/>";
                }
              } ?>
            </select></div>

          <input type="submit" name="enviar" value="Enviar">
        </form>
      </div>

      <!--Formulario de proveedor-->
      <div id="proveedor">
        <form action="validacionProveedor.php" id="proveedor-form" method="post" class="formulario">

          <div><label for="proveedor-nombre-empresa">Nombre empresa</label>
            <input id="proveedor-nombre-empresa" name="proveedor-nombre-empresa" type="text"></div>

          <div><label for="proveedor-nombre-comercial">Nombre comercial</label>
            <input name="proveedor-nombre-comercial" name="proveedor-nombre-comercial" type="text" required></div>

          <div><label for="proveedor-email">Email</label>
            <input name="proveedor-email" name="proveedor-email" type="email" required></div>

          <div><label for="proveedor-proveedor-telefono1">Teléfono 1</label>
            <input name="proveedor-telefono1" name="proveedor-telefono1" type="text" pattern="[0-9]{9}" required></div>

          <div><label for="proveedor-telefono2">Teléfono 2</label>
            <input name="proveedor-telefono2" name="proveedor-telefono2" type="text" pattern="[0-9]{9}"></div>

          <div><label for="proveedor-telefono3">Teléfono 3</label>
            <input name="proveedor-telefono3" name="proveedor-telefono3" type="text" pattern="[0-9]{9}"></div>

          <input type="submit" name="enviar" value="Enviar">
        </form>
      </div>

      <!--Formulario de almacen-->
      <div id="almacen">
        <form action="validacionAlmacen.php" id="almacen-form" method="post" class="formulario">

          <div><label for="almacen-nombre">Nombre</label>
            <input id="almacen-nombre" name="almacen-nombre" type="text" required></div>

          <div><label for="almacen-tipo-iluminacion">Tipo iluminación</label>
            <input id="almacen-tipo-iluminacion" name="almacen-tipo-iluminacion" type="text" pattern="[a-z]+" required></div>

          <div><label for="almacen-temperatura">Temperatura</label>
            <input id="almacen-temperatura" name="almacen-temperatura" type="number"></div>

          <div><label for="almacen-tipo-camara">Tipo cámara</label>
            <select id="almacen-tipo-camara" name="tipo-camara">
              <option value="Almacen">Almacén</option>
              <option value="invitro">Cámara in vitro</option>
              <option value="frio">Cámara frío</option>
            </select></div>

          <input type="submit" name="enviar" value="Enviar">
        </form>
      </div>

      <!--Formulario de mobiliario-->
      <div id="mobiliario">
        <form action="validacionMobiliario.php" id="mobiliario-form" method="post" class="formulario">

          <div class="centrado" style="margin-bottom:8px;">Temperatura ambiente
            <input id="mobiliario-tipo-ambiente" name="tipo-mobiliario" type="radio" value="ambiente"></div>

          <div class="centrado" style="margin-bottom:8px;">Equipo de frío
            <input id="mobiliario-tipo-frio" name="tipo-mobiliario" type="radio" value="frio"></div>

          <div><label for="mobiliario-almacen">Almacén</label>
            <select id="mobiliario-almacen" name="mobiliario-almacen">
              <?php foreach ($almacenes as $almacen) {
                echo "<option value='" . $almacen["NOMBRE"] . "' label='" . $almacen["NOMBRE"] . "'/>";
              } ?>
            </select></div>

          <div><label for="mobiliario-nombre">Nombre</label>
            <input id="mobiliario-nombre" name="mobiliario-nombre" type="text"></div>

          <div><label for="mobiliario-tipo">Tipo</label>
            <select id="mobiliario-tipo" name="mobiliario-tipo">
              <option value="estanteria">Estanteria</option>
              <option value="cajonera">Cajonera</option>
            </select></div>

          <div><label for="mobiliario-temperatura">Temperatura</label>
            <input id="mobiliario-temperatura" name="mobiliario-temperatura" type="number"></div>

          <input type="submit" name="enviar" value="Enviar">
        </form>
      </div>

      <!--Formulario de usuario-->
      <div id="usuario">
        <form action="validacionUsuario.php" id="usuario-form" method="post" class="formulario">

          <div><label for="usuario-nombre">Nombre</label>
            <input id="usuario-nombre" name="usuario-nombre" type="text" minlength="5" maxlength="40" required></div>

          <div><label for="usuario-password">Contraseña</label>
            <input id="usuario-password" name="usuario-password" type="password" placeholder="Mínimo 8 caracteres" minlength="5" required></div>

          <div><label for="usuario-email">Email</label>
            <input id="usuario-email" name="usuario-email" type="email" required></div>

          <div class="centrado"><label for="usuario-responsable">Responsable de compra</label>
            <input id="usuario-responsable" name="usuario-responsable" type="checkbox"></div>

          <input type="submit" name="enviar" value="Enviar">
        </form>
      </div>

    </div>
    <?php
    include_once("pie.php");
    ?>
</body>

</html>