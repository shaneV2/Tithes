<?php
    require '../../controllers/Database.php';
    require '../../controllers/Date.php';

    $date = new Date();

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
        $action = $_GET['action'];
        
        switch($action){
            case 'add-date':
                $start_date = $_POST['start-date'];        
                $end_date = $_POST['end-date'];        
                $date->createDate($start_date, $end_date);
                header("Location: ./giving.php");
                exit();
        }

    }elseif ($_SERVER['REQUEST_METHOD'] == "GET"){
        $action = $_GET['action'];
        
        switch($action) {
            case 'get-date':
                return "this is a test for getting the date";
        }
    }

?>