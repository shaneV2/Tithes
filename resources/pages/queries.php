<?php
    require '../../controllers/Database.php';
    require '../../controllers/Date.php';
    require '../../controllers/Members.php';
    require '../../controllers/Offerings.php';

    $date = new Date();
    $members = new Members();
    $offerings = new Offerings();

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $action = $_GET['action'];
        
        switch($action){
            case 'add-date':
                $start_date = $_POST['start-date'];        
                $end_date = $_POST['end-date'];        
                $date->createDate($start_date, $end_date);
                header("Location: ./giving.php");
                exit();
            
            case 'add-user-offer':
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];

                $tithes = empty($_POST['tithes']) ? 0 : $_POST['tithes'];
                $mission = empty($_POST['mission']) ? 0 : $_POST['mission'];
                $omg = empty($_POST['omg']) ? 0 : $_POST['omg'];
                $pledges = empty($_POST['pledges']) ? 0 : $_POST['pledges'];
                $donation = empty($_POST['donation']) ? 0 : $_POST['donation'];
                
                $username = $_POST['username'];
                $tithes_and_offerings = [$tithes, $mission, $omg, $pledges, $donation];
                $denominations = $_POST['denominations'];
                $date_id = $_POST['date_id'];

                $offerings->addUserOffering($username, $date_id, $tithes_and_offerings, $denominations);
                header("Location: date.php?d_id=". $date_id ."&start_date=". $start_date ."&end_date=". $end_date);
                exit();
        }

    }elseif ($_SERVER['REQUEST_METHOD'] == "GET"){
        $action = $_GET['action'];
        $date_id = $_GET['d_id'] ?? null ;
        
        switch($action) {
            case 'get-dates':
                $date->getDates();
                break;

            case 'get-members-based-on-date':
                $members->getMembersBasedOnDate($date_id);
                break;
            
            case 'view-shares':
                $date->getShares($date_id);
                break;
        }
    }

?>