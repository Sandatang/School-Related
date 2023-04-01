<?php

    session_start();
    if(!isset($_SESSION["username"])){header("location: userLogin.php"); exit;}

    if(isset($_POST["yes"])){
        $_SESSION = array();
        session_destroy();
        unset($_SESSION);
        header("location: userLogin.php");
        exit;
    }

    if(isset($_POST["no"])){
        header("location: list_all_items.php");
        exit;
    }
?>
