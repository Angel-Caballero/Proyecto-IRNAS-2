<div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">Menu</button>
  <div id="myDropdown" class="dropdown-content">
    <?php if(isset($_SESSION['privilegios'])){ ?>
        <a href="#home">Insertar Recursos</a>
    <?php } ?>
    <a href="logout.php">Logout</a>
  </div>
</div>

