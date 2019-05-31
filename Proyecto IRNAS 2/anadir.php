<?php
session_start();

require_once ("gestionBD.php");
require_once ("gestionarBusquedas.php");
require_once ("gestionarUsuarios.php");

if (!isset($_SESSION['login'])){
    Header("Location: login.php");
}else{
    $usuario = $_SESSION['login'];
}


	$conexion = crearConexionBD();

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
  <link rel="icon" href="images/icono.png"/>
  <title>Añadir Recursos</title>
</head>
<body onload="recurso()">
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
  <li onclick="recurso()" class="activo">Recurso</li>
  <li onclick="proveedor()">Proveedor</li>
  <li onclick="almacen()">Almacén</li>
  <li onclick="mobiliario()">Mobiliario</li>
  <li onclick="usuario()">Usuario</li>
</ul>
</div>
<div id="recurso">
  <form action="" method="post" class="formulario" name="recurso">
    <div><label for="nombre">Nombre</label><input type="text" name="nombre"></div>
<div><label for="almacen">Almacén</label><select name="almacen">
    <option value="almacen1">Almacén 1</option>
    <option value="almacen2">Almacén 2</option>
    <option value="laboratorio1">Laboratorio 1</option>
    <option value="laboratorio2">Laboratorio 2</option>
</select></div>
   <div> <label for="tipo-recurso">Tipo recurso</label><select id="tiporecurso" name="tipo-recurso">
      <option value="Compuesto quimico">Compuesto químico</option>
      <option value="Fungible y kits">Fungible y kits</option>
      <option value="Material biologico">Material biológico</option>
</select></div>
    <div><label for="posicion">Posición</label><input type="text" name="posicion"></div>
    <div><label for="unidades">Unidades</label><input id="unidades" type="number" name="unidades"></div>
    <div><label for="formula">Fórmula química</label><input id="formula" type="text" name="formula"></div>
    <div><label for="cantidad">Cantidad</label><input id="cantidad" type="number" name="cantidad"></div>
    <div><label for="reserva">Reserva mínima</label><input id="reserva" type="number" name="reserva"></div>
    <div><label for="ficha">Ficha seguridad</label><input id="ficha" type="file" name="ficha"></div>
    <div><label for="proveedores">Proveedores</label><select id="proveedores" name="proveedores" multiple>
      <option value="proveedor1">Proveedor 1</option>
      <option value="proveedor2">Proveedor 2</option>
      <option value="proveedor3">Proveedor 3</option>
      <option value="proveedor4">Proveedor 4</option>
</select></div>
    <input type="submit" name="enviar" value="Enviar">
</form>
</div>
<div id="proveedor">
<form action="" method="post" class="formulario" name="proveedor">
<div><label for="nombre-empresa">Nombre empresa</label><input type="text" name="nombre-empresa"></div>
<div><label for="nombre-comercial">Nombre comercial</label><input type="text" name="nombre-comercial"></div>
<div><label for="email">Email</label><input type="email" name="email"></div>
<div><label for="telefono1">Teléfono 1</label><input type="text" name="teléfono1"></div>
<div><label for="telefono2">Teléfono 2</label><input type="text" name="teléfono2"></div>
<div><label for="telefono3">Teléfono 3</label><input type="text" name="teléfono3"></div>
<input type="submit" name="enviar" value="Enviar">
</form>
</div>
<div id="almacen">
<form action="" method="post" class="formulario" name="almacen">
<div><label for="nombre">Nombre</label><input type="text" name="nombre"></div>
<div><label for="tipo-iluminacion">Tipo iluminación</label><input type="text" name="tipo-iluminacion"></div>
<div><label for="temperatura">Temperatura</label><input type="number" name="temperatura"></div>
<div><label for="tipo-camara">Tipo cámara</label><select name="tipo-camara">
<option value="Almacen">Almacén</option>
<option value="invitro">Cámara in vitro</option>
<option value="frio">Cámara frío</option>
</select></div>
<input type="submit" name="enviar" value="Enviar">
</form>
</div>
<div id="mobiliario">
<form action="" method="post" class="formulario" name="mobiliario">
<div class="centrado" style="margin-bottom:8px;">Temperatura ambiente<input id="ambiente" type="radio" name="tipo-mobiliario" value="ambiente"></div>
<div class="centrado" style="margin-bottom:8px;">Equipo de frío<input id="frio" type="radio" name="tipo-mobiliario" value="frio"></div>
<div><label for="almacen">Almacén</label><select name="almacen">
    <option value="almacen1">Almacén 1</option>
    <option value="almacen2">Almacén 2</option>
    <option value="laboratorio1">Laboratorio 1</option>
    <option value="laboratorio2">Laboratorio 2</option>
</select></div>
<div><label for="nombre">Nombre</label><input type="text" name="nombre"></div>
<div><label for="tipo">Tipo</label><select id="tipo" name="tipo">
<option value="estanteria">Estanteria</option>
<option value="cajonera">Cajonera</option>
</select></div>
<div><label for="temperatura">Temperatura</label><input id="temperatura" type="number" name="temperatura"></div>
<input type="submit" name="enviar" value="Enviar">
</form>
</div>
<div id="usuario">
<form action="" method="post" class="formulario" name="usuario">
<div><label for="nombre">Nombre</label><input type="text" name="nombre" required></div>
<div><label for="password">Contraseña</label><input type="password" name="password" required></div>
<div><label for="email">Email</label><input type="email" name="email" required></div>
<div class="centrado"><label for="responsable">Responsable de compra</label><input type="checkbox" name="responsable"></div>
<input type="submit" name="enviar" value="Enviar">
</form>
</div>
</div>
<?php
	include_once("pie.php");
?>
</body>
</html>