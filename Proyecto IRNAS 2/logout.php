<?php
	session_start();
    
    if (isset($_SESSION['login'])){
        unset($_SESSION['login']);
    }
    if(isset($_SESSION['privilegios'])){
        unset($_SESSION['privilegios']);
    }

    header("Location: index.php");
?>