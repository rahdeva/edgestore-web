<?php 
    header("Location: login.php");
    
    session_start();
    $_SESSION = [];
    session_unset();
    session_destroy();

    exit;
?>