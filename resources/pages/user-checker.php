<?php
    if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    $uri = $_SERVER['REQUEST_URI'];
    if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){
        if (preg_match("/\/user\//i", $uri)){
            header("Location: ../admin/homepage.php");
            exit();
        }
    } else if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'standard'){
        if (preg_match("/\/admin\/.*\.php/i", $uri)){
            header("Location: ../user/homepage.php");
            exit();
        }
    } else {
        return;       
    }
?>