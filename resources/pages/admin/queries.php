<?php
    require '../../../controllers/Database.php';
    require '../../../controllers/Register.php';
    require '../../../controllers/Date.php';
    require '../../../controllers/Members.php';
    require '../../../controllers/Offerings.php';

    $register = new Register();
    $date = new Date();
    $members = new Members();
    $offerings = new Offerings();

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $action = $_GET['action'];
        
        switch($action){
            case 'add-member':
                $id = $_POST['id'];
                $members->addMember($id);
                header("Location: ./members.php");
                exit();

            case 'remove-member':
                $id = $_POST['m_id'];
                $members->removeMember($id);
                header("Location: ./members.php");
                exit();
            
            case 'register-user':
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm-password'];

                $register->registerUser($firstname, $lastname, $username, $password, $confirm_password);
                header("Location: ../register.php");
                exit();

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
            
            case 'delete-date':
                $date_id = $_POST['date_id'];
                $date->deleteDate($date_id);
                exit();
            
            case 'delete-date-member':
                $md_id = $_POST['md_id'];
                $members->deleteMemberBasedOnDate($md_id);
                exit();
        }

    }elseif ($_SERVER['REQUEST_METHOD'] == "GET"){
        $action = $_GET['action'];
        $date_id = $_GET['d_id'] ?? null ;
        
        switch($action) {
            case 'get-dates':
                $date->getDates();
                break;
            
            case 'get-all-members':
                $members->getAllMembers();
                break;

            case 'get-members-based-on-date':
                $members->getMembersBasedOnDate($date_id);
                break;
            
            case 'view-shares':
                $date->getShares($date_id);
                break;

            case 'get-denominations-total':
                $date->getDenominationsTotal($date_id);
                break;
            
            case 'filter-date':
                $month = $_GET['month'];
                $year = $_GET['year'];
                $date->filterDate($month, $year);
                break;

            case 'clear-session-for-filter':
                session_start();
                if (isset($_SESSION['filter_month'])){
                    session_unset();
                    session_destroy();
                }
                break;
        }
    }

?>