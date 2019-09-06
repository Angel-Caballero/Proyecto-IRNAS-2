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
                <form action="" id="recurso-form" method="post" class="formulario">
                    <div><label for="recurso-elemento">Recurso</label>
                        <select id="recurso-elemento" name="recurso-elemento">
                        <option value=""></option>
                        <?php foreach($recursos as $recurso){
                            echo "<option value='".$recurso["ALMACEN"]."-".$recurso["NOMBRE"]."'>".$recurso["NOMBRE"]."</option>";
                        } ?>
                        </select></div>
                    <input type="submit" name="enviar" value="Enviar">
                </form>
            </div>
            <div id="proveedor">
                <form action="" id="proveedor-form" method="post" class="formulario">
                    <div><label for="proveedor-elemento">Proveedor</label>
                        <select id="proveedor-elemento" name="proveedor-elemento">
                        <option value=""></option>
                        <?php foreach($proveedores as $proveedor){
                            echo "<option value='".$proveedor["ID_PR"]."'>".$proveedor["NOMBREEMPRESA"]." - ".$proveedor["NOMBRECOMERCIAL"]."</option>";
                        } ?>
                        </select></div>
                    <input type="submit" name="enviar" value="Enviar">
                </form>
            </div>
            <div id="almacen">
                <form action="" id="almacen-form" method="post" class="formulario">
                    <div><label for="almacen-elemento">Almacén</label>
                        <select id="almacen-elemento" name="almacen-elemento">
                        <option value=""></option>
                        <?php foreach($almacenes as $almacen){
                            echo "<option value='".$almacen["NOMBRE"]."'>".$almacen["NOMBRE"]."</option>";
                        } ?>
                        </select></div>
                    <input type="submit" name="enviar" value="Enviar">
                </form>
            </div>
            <div id="mobiliario">
                <form action="" id="mobiliario-form" method="post" class="formulario">
                    <div><label for="mobiliario-temperatura_ambiente">Temperatura ambiente</label>
                        <select id="mobiliario-temperatura_ambiente" name="mobiliario-temperatura_ambiente">
                        <option value=""></option>
                        <?php foreach($temperaturaAmbiente as $temperaturaAmbiente){
                            echo "<option value='".$temperaturaAmbiente["ID_TA"]."'>".$temperaturaAmbiente["NOMBRE"]."</option>";
                        } ?>
                        </select></div>
                        <div><label for="mobiliario-equipo_frio">Equipo de frío</label>
                        <select id="mobiliario-equipo_frio" name="mobiliario-equipo_frio">
                        <option value=""></option>
                        <?php foreach($equiposFrio as $equipoFrio){
                            echo "<option value='".$equipoFrio["ID_EF"]."'>".$equipoFrio["NOMBRE"]."</option>";
                        } ?>
                        </select></div>
                    <input type="submit" name="enviar" value="Enviar">
                </form>
            </div>
            <div id="usuario">
                <form action="" id="usuario-form" method="post" class="formulario">
                    <div><label for="usuario-elemento">Usuario</label>
                        <select id="usuario-elemento" name="usuario-elemento">
                        <option value=""></option>
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