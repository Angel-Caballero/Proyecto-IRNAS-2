<nav>
<div id="navegador">
  <ul>
    <li id="seccion1" onmouseover="ver()" onmouseout="ocultar()">
      <a href="#">Sección Uno</a>
      <div id="subseccion">
        <p><?php if (isset($_SESSION['privilegios'])) {	?>
				<a href="logout.php">Editar Recursos</a>
      <?php } ?>
    </p>
        <p><a href="logout.php">Desconectar</a></p>
      </div>
</nav>