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

if(!isset($_SESSION['privilegios'])){
  Header("Location: interfazBuscador.php");
}

if (!isset($_SESSION["formularioUsuario"])) {
  $nuevoUsuario["nombre"] = '';
  $nuevoUsuario["email"] = '';
  $nuevoUsuario["pass"] = '';
  $nuevoUsuario["confirm_pass"] = '';
  $nuevoUsuario["tipo"] = '';
  $_SESSION["formularioUsuario"] = $nuevoUsuario;
} else {
  $nuevoUsuario = $_SESSION["formularioUsuario"];
}

if (isset($_SESSION["erroresUsuario"])) {
  $erroresUsuario = $_SESSION["erroresUsuario"];
  unset($_SESSION["erroresUsuario"]);
}

if (!isset($_SESSION["formularioRecurso"])) {
  $nuevoRecurso["nombre"] = '';
  $nuevoRecurso["almacen"] = '';
  $nuevoRecurso["tipo"] = '';
  $nuevoRecurso["posicion"] = '';
  $nuevoRecurso["unidades"] = '';
  $nuevoRecurso["formula"] = '';
  $nuevoRecurso["cantidad"] = '';
  $nuevoRecurso["reserva"] = '';
  $nuevoRecurso["proveedor"] = '';
  $_SESSION["formularioRecurso"] = $nuevoRecurso;
} else {
  $nuevoRecurso = $_SESSION["formularioRecurso"];
}

if (isset($_SESSION["erroresRecurso"])) {
  $erroresRecurso = $_SESSION["erroresRecurso"];
  unset($_SESSION["erroresRecurso"]);
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
  if(!isset($nuevoProveedor["telefono2"])){
    $nuevoProveedor["telefono2"] = "";
  }
  if(!isset($nuevoProveedor["telefono3"])){
    $nuevoProveedor["telefono3"] = "";
  }
}

if (isset($_SESSION["erroresProveedor"])) {
  $erroresProveedor = $_SESSION["erroresProveedor"];
  unset($_SESSION["erroresProveedor"]);
}

if (!isset($_SESSION["formularioMobiliario"])) {
  $nuevoMobiliario["tipo-mob"] = '';
  $nuevoMobiliario["almacen"] = '';
  $nuevoMobiliario["nombre"] = '';
  $nuevoMobiliario["tipo-temp-amb"] = '';
  $nuevoMobiliario["temperatura"] = '';
  $_SESSION["formularioMobiliario"] = $nuevoMobiliario;
} else {
  $nuevoMobiliario = $_SESSION["formularioMobiliario"];
}

if (isset($_SESSION["erroresMobiliario"])) {
  $erroresMobiliario = $_SESSION["erroresMobiliario"];
  unset($_SESSION["erroresMobiliario"]);
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

if (isset($_SESSION["erroresAlmacen"])) {
  $erroresAlmacen = $_SESSION["erroresAlmacen"];
  unset($_SESSION["erroresAlmacen"]);
}

$conexion = crearConexionBD();

$almacenes = todosLosAlmacenes($conexion);
$almacenesRecursos = $almacenesMobiliario = "";
foreach ($almacenes as $almacen) {
  if ($almacen["NOMBRE"] == $nuevoRecurso["almacen"]) {
    $almacenesRecursos = $almacenesRecursos . "<option value='" . $almacen["NOMBRE"] . "' label='" . $almacen["NOMBRE"] . "' selected/>";
  } else {
    $almacenesRecursos = $almacenesRecursos . "<option value='" . $almacen["NOMBRE"] . "' label='" . $almacen["NOMBRE"] . "'/>";
  }

  if ($almacen["NOMBRE"] == $nuevoRecurso["almacen"]) {
    $almacenesMobiliario = $almacenesMobiliario . "<option value='" . $almacen["NOMBRE"] . "' label='" . $almacen["NOMBRE"] . "' selected/>";
  } else {
    $almacenesMobiliario = $almacenesMobiliario . "<option value='" . $almacen["NOMBRE"] . "' label='" . $almacen["NOMBRE"] . "'/>";
  }
}
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
  <script src="js/validacion_formulario_alta.js" type="text/javascript"></script>
  <script type="text/javascript" src="./js/menu.js"></script>
  <script type="text/javascript" src="./js/formularios.js"></script>
  <link rel="icon" href="images/icono.png" />
  <title>Base de Datos: Añadir elementos</title>
</head>

<body onload="recursoform()">
  <script>
      // Inicialización de elementos y eventos cuando el documento se carga completamente
      $(document).ready(function() {
        // EJERCICIO 3: Manejador de evento del color de la contraseña
        $("#usuario-password").on("keyup", function() {
          // Calculo el color
          passwordColor();
        });
      });
    </script>
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
        <?php
        if (isset($erroresRecurso) && count($erroresRecurso) > 0) {
          echo "<div id=\"div_errores_recurso\" class=\"error\">";
          echo "<h4> Errores en el formulario de Recurso:</h4>";
          foreach ($erroresRecurso as $errorRecurso) {
            echo $errorRecurso;
          }
          echo "</div>";
        }
        ?>
        <form action="validacionRecurso.php" id="recurso-form" method="post" class="formulario">

          <div><label for="recurso-nombre">Nombre</label>
            <input id="recurso-nombre" name="recurso-nombre" type="text" value="<?php echo $nuevoRecurso['nombre']; ?>" required></div>

          <div><label for="recurso-almacen">Almacén</label>
            <select id="recurso-almacen" name="recurso-almacen">
              <?php echo $almacenesRecursos ?>
            </select></div>

          <div><label for="recurso-tipo">Tipo recurso</label>
            <select id="recurso-tipo" name="recurso-tipo">
              <?php if ($nuevoRecurso["tipo"] == "REACTIVO") { ?>
                <option value="REACTIVO" selected>Compuesto químico</option>
                <option value="FUNGIBLE">Fungible y kits</option>
                <option value="BIOLOGICO">Material biológico</option>
              <?php } elseif ($nuevoRecurso["tipo"] == "FUNGIBLE") { ?>
                <option value="REACTIVO">Compuesto químico</option>
                <option value="FUNGIBLE" selected>Fungible y kits</option>
                <option value="BIOLOGICO">Material biológico</option>
              <?php } elseif ($nuevoRecurso["tipo"] == "BIOLOGICO") { ?>
                <option value="REACTIVO">Compuesto químico</option>
                <option value="FUNGIBLE">Fungible y kits</option>
                <option value="BIOLOGICO" selected>Material biológico</option>
              <?php } else { ?>
                <option value="REACTIVO">Compuesto químico</option>
                <option value="FUNGIBLE">Fungible y kits</option>
                <option value="BIOLOGICO">Material biológico</option>
              <?php } ?>
            </select></div>

          <div><label for="recurso-posicion">Posición</label>
            <input id="recurso-posicion" name="recurso-posicion" type="text" value="<?php echo $nuevoRecurso['posicion']; ?>" required oninput="posicionValidation();"></div>

          <div><label for="recurso-unidades">Unidades</label>
            <input id="recurso-unidades" name="recurso-unidades" type="number" value="<?php echo $nuevoRecurso['unidades']; ?>"></div>

          <div><label for="recurso-formula">Fórmula química</label>
            <input id="recurso-formula" name="recurso-formula" type="text" value="<?php echo $nuevoRecurso['formula']; ?>"></div>

          <div><label for="recurso-cantidad">Cantidad</label>
            <input id="recurso-cantidad" name="recurso-cantidad" type="number" value="<?php echo $nuevoRecurso['cantidad']; ?>"></div>

          <div><label for="recurso-reserva">Reserva mínima</label>
            <input id="recurso-reserva" name="recurso-reserva" type="number" value="<?php echo $nuevoRecurso['reserva']; ?>"></div>

          <div><label for="recurso-proveedores">Proveedores</label>
            <select id="recurso-proveedores" name="recurso-proveedores">
              <?php foreach ($proveedores as $proveedor) {
                if ($nuevoRecurso["proveedor"] == $proveedor["ID_PR"]) {
                  echo "<option value='" . $proveedor["ID_PR"] . "' label='" . $proveedor["NOMBREEMPRESA"] . " - " .  $proveedor["NOMBRECOMERCIAL"] ."' selected/>";
                } else {
                  echo "<option value='" . $proveedor["ID_PR"] . "' label='" . $proveedor["NOMBREEMPRESA"] . " - " .  $proveedor["NOMBRECOMERCIAL"] ."'/>";
                }
              } ?>
            </select></div>

          <input type="submit" name="enviar" value="Enviar">
        </form>
      </div>

      <!--Formulario de proveedor-->
      <div id="proveedor">
        <?php
        if (isset($erroresProveedor) && count($erroresProveedor) > 0) {
          echo "<div id=\"div_errores_proveedor\" class=\"error\">";
          echo "<h4> Errores en el formulario de Proveedor:</h4>";
          foreach ($erroresProveedor as $errorProveedor) {
            echo $errorProveedor;
          }
          echo "</div>";
        }
        ?>
        <form action="validacionProveedor.php" id="proveedor-form" method="post" class="formulario">

          <div><label for="proveedor-nombre-empresa">Nombre empresa</label>
            <input id="proveedor-nombre-empresa" name="proveedor-nombre-empresa" type="text" value="<?php echo $nuevoProveedor['nombre-empresa']; ?>" required></div>

          <div><label for="proveedor-nombre-comercial">Nombre comercial</label>
            <input id="proveedor-nombre-comercial" name="proveedor-nombre-comercial" type="text" value="<?php echo $nuevoProveedor['nombre-comercial']; ?>" required></div>

          <div><label for="proveedor-email">Email</label>
            <input id="proveedor-email" name="proveedor-email" type="email" value="<?php echo $nuevoProveedor['email']; ?>" required></div>

          <div><label for="proveedor-proveedor-telefono1">Teléfono 1</label>
            <input id="proveedor-telefono1" name="proveedor-telefono1" type="text" pattern="^[6|7|8|9][0-9]{8}$" value="<?php echo $nuevoProveedor['telefono1']; ?>" oninput="telefono1Validation();" required></div>

          <div><label for="proveedor-telefono2">Teléfono 2</label>
            <input id="proveedor-telefono2" name="proveedor-telefono2" type="text" pattern="^[6|7|8|9][0-9]{8}$" value="<?php echo $nuevoProveedor['telefono2']; ?>" oninput="telefono2Validation();" placeholder="Teléfono opcional"></div>

          <div><label for="proveedor-telefono3">Teléfono 3</label>
            <input id="proveedor-telefono3" name="proveedor-telefono3" type="text" pattern="^[6|7|8|9][0-9]{8}$" value="<?php echo $nuevoProveedor['telefono3']; ?>" oninput="telefono3Validation();" placeholder="Teléfono opcional"></div>

          <input type="submit" name="enviar" value="Enviar">
        </form>
      </div>

      <!--Formulario de almacen-->
      <div id="almacen">
        <?php
        if (isset($erroresAlmacen) && count($erroresAlmacen) > 0) {
          echo "<div id=\"div_errores_almacen\" class=\"error\">";
          echo "<h4> Errores en el formulario de Almacen:</h4>";
          foreach ($erroresAlmacen as $errorAlmacen) {
            echo $errorAlmacen;
          }
          echo "</div>";
        }
        ?>
        <form action="validacionAlmacen.php" id="almacen-form" method="post" class="formulario">

          <div><label for="almacen-nombre">Nombre</label>
            <input id="almacen-nombre" name="almacen-nombre" type="text" value="<?php echo $nuevoAlmacen['nombre']; ?>" required></div>

          <div><label for="almacen-iluminacion">Tipo iluminación</label>
            <input id="almacen-iluminacion" name="almacen-iluminacion" type="text" value="<?php echo $nuevoAlmacen['tipo-iluminacion']; ?>" oninput="iluminacionValidation();" required></div>

          <div><label for="almacen-temperatura">Temperatura</label>
            <input id="almacen-temperatura" name="almacen-temperatura" type="number" value="<?php echo $nuevoAlmacen['temperatura']; ?>"></div>

          <div><label for="almacen-tipo-camara">Tipo cámara</label>
            <select id="almacen-tipo-camara" name="almacen-tipo-camara">
              <?php if ($nuevoAlmacen["tipo-camara"] == "NORMAL") { ?>
                <option value="NORMAL" selected>Almacén</option>
                <option value="CAMARA IN-VITRO">Cámara in vitro</option>
                <option value="CAMARA FRIO">Cámara frío</option>
              <?php } elseif ($nuevoAlmacen["tipo-camara"] == "CAMARA IN-VITRO") { ?>
                <option value="NORMAL">Almacén</option>
                <option value="CAMARA IN-VITRO" selected>Cámara in vitro</option>
                <option value="CAMARA FRIO">Cámara frío</option>
              <?php } elseif ($nuevoAlmacen["tipo-camara"] == "CAMARA FRIO") { ?>
                <option value="NORMAL">Almacén</option>
                <option value="CAMARA IN-VITRO">Cámara in vitro</option>
                <option value="CAMARA FRIO" selected>Cámara frío</option>
              <?php } else { ?>
                <option value="NORMAL">Almacén</option>
                <option value="CAMARA IN-VITRO">Cámara in vitro</option>
                <option value="CAMARA FRIO">Cámara frío</option>
              <?php } ?>
            </select></div>

          <input type="submit" name="enviar" value="Enviar">
        </form>
      </div>

      <!--Formulario de mobiliario-->
      <div id="mobiliario">
        <?php
        if (isset($erroresMobiliario) && count($erroresMobiliario) > 0) {
          echo "<div id=\"div_errores_mobiliario\" class=\"error\">";
          echo "<h4> Errores en el formulario de Mobiliario:</h4>";
          foreach ($erroresMobiliario as $errorMobiliario) {
            echo $errorMobiliario;
          }
          echo "</div>";
        }
        ?>
        <form action="validacionMobiliario.php" id="mobiliario-form" method="post" class="formulario">

        <div><label for="tipo-mobiliario">Tipo mobiliario</label>
            <select id="tipo-mobiliario" name="tipo-mobiliario">
              <?php if ($nuevoMobiliario["tipo-mob"] == "ambiente") { ?>
                <option value="ambiente" selected>Temperatura ambiente</option>
                <option value="frio">Equipo de frío</option>
              <?php } else if ($nuevoMobiliario["tipo-mob"] == "frio") { ?>
                <option value="ambiente">Temperatura ambiente</option>
                <option value="frio" selected>Equipo de frío</option>
              <?php } else { ?>
                <option value="ambiente">Temperatura ambiente</option>
                <option value="frio">Equipo de frío</option>
              <?php } ?>
            </select>
          </div>

  <div><label for="mobiliario-almacen">Almacén</label>
    <select id="mobiliario-almacen" name="mobiliario-almacen">
      <?php echo $almacenesMobiliario; ?>
    </select></div>

  <div><label for="mobiliario-nombre">Nombre</label>
    <input id="mobiliario-nombre" name="mobiliario-nombre" type="text" value="<?php echo $nuevoMobiliario['nombre']; ?>" required></div>

  <div><label for="mobiliario-temp-amb">Tipo de temperatura ambiente</label>
    <select id="mobiliario-temp-amb" name="mobiliario-temp-amb">
      <?php if ($nuevoMobiliario["tipo-temp-amb"] == "estanteria") { ?>
        <option value="estanteria" selected>Estanteria</option>
        <option value="cajonera">Cajonera</option>
      <?php } elseif ($nuevoMobiliario["tipo-temp-amb"] == "cajonera") { ?>
        <option value="estanteria">Estanteria</option>
        <option value="cajonera" selected>Cajonera</option>
      <?php } else { ?>
        <option value="estanteria">Estanteria</option>
        <option value="cajonera">Cajonera</option>
      <?php } ?>
    </select></div>

  <div><label for="mobiliario-temperatura">Temperatura</label>
    <input id="mobiliario-temperatura" name="mobiliario-temperatura" type="number" value="<?php echo $nuevoMobiliario['temperatura'];?>" oninput="temperaturaValidation();" disabled></div>

  <input type="submit" name="enviar" value="Enviar">
  </form>
  </div>

  <!--Formulario de usuario-->
  <div id="usuario">
    <?php
    if (isset($erroresUsuario) && count($erroresUsuario) > 0) {
      echo "<div id=\"div_errores_usuario\" class=\"error\">";
      echo "<h4> Errores en el formulario de Usuario:</h4>";
      foreach ($erroresUsuario as $errorUsuario) {
        echo $errorUsuario;
      }
      echo "</div>";
    }
    ?>
    <form action="validacionUsuario.php" id="usuario-form" method="post" class="formulario">

      <div><label for="usuario-nombre">Nombre</label>
        <input id="usuario-nombre" name="usuario-nombre" type="text" maxlength="40" value="<?php echo $nuevoUsuario['nombre']; ?>" required></div>

      <div><label for="usuario-password">Contraseña</label>
        <input id="usuario-password" name="usuario-password" type="password" placeholder="Contraseña entre 8 y 16 caracteres" maxlength="16" required oninput="passwordValidation(); "></div>

      <div><label for="usuario-email">Email</label>
        <input id="usuario-email" name="usuario-email" type="email" value="<?php echo $nuevoUsuario['email']; ?>" required></div>

      <div><label for="usuario-confirm-password">Confirmar contraseña</label>
        <input id="usuario-confirm-password" name="usuario-confirm-password" type="password" placeholder="Confirmación de la contraseña" maxlength="16" oninput="passwordConfirmation();" required></div>


      <div class="centrado"><label for="usuario-responsable">Responsable de compra</label>
        <?php if ($nuevoUsuario["tipo"] == "ADMINISTRADOR") { ?>
          <input id="usuario-responsable" name="usuario-responsable" type="checkbox" checked="checked"></div>
    <?php } else { ?>
      <input id="usuario-responsable" name="usuario-responsable" type="checkbox"></div>
<?php } ?>

<input type="submit" name="enviar" value="Enviar">
</form>
</div>

</div>
<?php
include_once("pie.php");
?>
</body>

</html>