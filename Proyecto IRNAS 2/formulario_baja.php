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

if (isset($_SESSION["mensjRecurso"])) {
    $mensjRecurso = $_SESSION["mensjRecurso"];
    unset($_SESSION["mensjRecurso"]);
}

if (isset($_SESSION["mensjProveedor"])) {
    $mensjProveedor = $_SESSION["mensjProveedor"];
    unset($_SESSION["mensjProveedor"]);
}
if (isset($_SESSION["mensjAlmacen"])) {
    $mensjAlmacen = $_SESSION["mensjAlmacen"];
    unset($_SESSION["mensjAlmacen"]);
}

if (isset($_SESSION["mensjMobiliario"])) {
    $mensjMobiliario = $_SESSION["mensjMobiliario"];
    unset($_SESSION["mensjMobiliario"]);
}

if (isset($_SESSION["mensjUsuario"])) {
    $mensjUsuario = $_SESSION["mensjUsuario"];
    unset($_SESSION["mensjUsuario"]);
}

$conexion = crearConexionBD();

$recursos = todosLosRecursos($conexion);
$almacenes = todosLosAlmacenes($conexion);
$proveedores = todosLosProveedores($conexion);
$temperaturaAmbiente = todosLosTemperaturaAmbiente($conexion);
$equiposFrio = todosLosEquipoFrio($conexion);
$usuarios = todosLosUsuarios($conexion);

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
  <title>Base de Datos: Eliminar elementos</title>
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
            <div id="recurso">
            <?php
                    if (isset($mensjRecurso)) {
                        echo "<div id=\"div_mensj_recurso\" class=\"mensaje\">";
                        echo $mensjRecurso;
                        echo "</div>";
                    }
                ?> 
                <form action="accion_borrar_recurso.php" id="recurso-form" method="post" class="formulario">
                    <div><label for="recurso-elemento">Recurso</label>
                    <input id="ALMACEN" name="ALMACEN" type="hidden" value="<?php echo $recurso["ALMACEN"]; ?>" />
                        <select id="recurso-elemento" name="recurso-elemento">
                        <option value="">--Elija el recurso que quiera eliminar--</option>
                        <?php foreach($recursos as $recurso){
                            echo "<option value='".$recurso["NOMBRE"]."'>".$recurso["NOMBRE"]."</option>";
                        } ?>
                        </select>
                    </div>
                    <input type="submit" name="enviar" value="Enviar">
                </form>
            </div>
            <div id="proveedor">
            <?php
                    if (isset($mensjProveedor)) {
                        echo "<div id=\"div_mensj_proveedor\" class=\"mensaje\">";
                        echo $mensjProveedor;
                        echo "</div>";
                    }
                ?> 
                <form action="accion_borrar_proveedor.php" id="proveedor-form" method="post" class="formulario">
                    <div><label for="proveedor-elemento">Proveedor</label>
                        <select id="proveedor-elemento" name="proveedor-elemento">
                        <option value="">--Elija el proveedor que quiera eliminar--</option>
                        <?php foreach($proveedores as $proveedor){
                            echo "<option value='".$proveedor["ID_PR"]."'>".$proveedor["NOMBREEMPRESA"]." - ".$proveedor["NOMBRECOMERCIAL"]."</option>";
                        } ?>
                        </select></div>
                    <input type="submit" name="enviar" value="Enviar">
                </form>
            </div>
            <div id="almacen">
            <?php
                    if (isset($mensjAlmacen)) {
                        echo "<div id=\"div_mensj_almacen\" class=\"mensaje\">";
                        echo $mensjAlmacen;
                        echo "</div>";
                    }
                ?> 
                <form action="accion_borrar_almacen.php" id="almacen-form" method="post" class="formulario">
                    <div><label for="almacen-elemento">Almacén</label>
                        <select id="almacen-elemento" name="almacen-elemento">
                        <option value="">--Elija el almacen que quiera eliminar--</option>
                        <?php foreach($almacenes as $almacen){
                            echo "<option value='".$almacen["NOMBRE"]."'>".$almacen["NOMBRE"]."</option>";
                        } ?>
                        </select></div>
                    <input type="submit" name="enviar" value="Enviar">
                </form>
            </div>
            <div id="mobiliario">
            <?php
                    if (isset($mensjMobiliario)) {
                        echo "<div id=\"div_mensj_mobiliario\" class=\"mensaje\">";
                        echo $mensjMobiliario;
                        echo "</div>";
                    }
                ?> 
                <form action="accion_borrar_mobiliario.php" id="mobiliario-form" method="post" class="formulario">
                    <div><label for="mobiliario_temperatura_ambiente">Temperatura ambiente</label>
                        <select id="mobiliario_temperatura_ambiente" name="mobiliario_temperatura_ambiente">
                        <option value="">--Elija el mobiliario que quiera eliminar--</option>
                        <?php foreach($temperaturaAmbiente as $temperaturaAmbiente){
                            echo "<option value='".$temperaturaAmbiente["ID_TA"]."'>".$temperaturaAmbiente["NOMBRE"]."</option>";
                        } ?>
                        </select></div>
                        <div><label for="mobiliario-equipo_frio">Equipo de frío</label>
                        <select id="mobiliario_equipo_frio" name="mobiliario_equipo_frio">
                        <option value="">--Elija el mobiliario que quiera eliminar--</option>
                        <?php foreach($equiposFrio as $equipoFrio){
                            echo "<option value='".$equipoFrio["ID_EF"]."'>".$equipoFrio["NOMBRE"]."</option>";
                        } ?>
                        </select></div>
                    <input type="submit" name="enviar" value="Enviar">
                </form>
            </div>
            <div id="usuario">
                <?php
                    if (isset($mensjUsuario)) {
                        echo "<div id=\"div_mensj_usuario\" class=\"mensaje\">";
                        echo $mensjUsuario;
                        echo "</div>";
                    }
                ?>        
                <form action="accion_borrar_usuario.php" id="usuario-form" method="post" class="formulario">
                    <div><label for="usuario-elemento">Usuario</label>
                        <select id="usuario-elemento" name="usuario-elemento">
                        <option value="">--Elija el usuario que quiera eliminar--</option>
                        <?php foreach($usuarios as $usuario){
                            echo "<option value='".$usuario["NOMBRE"]."'>".$usuario["NOMBRE"]."</option>";
                        } ?>
                        </select></div>
                    <input type="submit" name="enviar" value="Enviar">
                </form>
            </div>
    </div>
    <?php include_once("pie.php"); ?>
</body>
</html>