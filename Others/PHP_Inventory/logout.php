<?php

    session_start();

    if(!isset($_SESSION["username"])){
        header("location: login.php");
        exit;
    }

    $_SESSION = array();
    session_destroy();
    unset($_SESSION);

    echo "<a href='login.php'>Login</a>";
?>