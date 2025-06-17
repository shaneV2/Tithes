<?php

    require '../../../controllers/Database.php';
    require '../../../controllers/Login.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $action = $_GET['action'];

        switch ($action){
            case 'login':
                $username = $_POST['username'];
                $password = $_POST['password'];

                $login = new Login();
                $login->loginUser($username, $password);
                return;
        }

    }else if($_SERVER['REQUEST_METHOD'] == "GET"){
        echo "get req.";
    }