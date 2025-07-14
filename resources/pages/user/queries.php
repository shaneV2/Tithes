<?php
    require '../../../controllers/Database.php';
    require '../../../controllers/Date.php';
    require '../../../controllers/Offerings.php';
    require '../../../controllers/User.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $action = $_GET['action'];
        
        switch($action){
            case 'get-user-code':
                $user = new User();
                $user->getUserCode();
                break;
        }

    }elseif ($_SERVER['REQUEST_METHOD'] == "GET"){
        $action = $_GET['action'];
        $date_id = $_GET['d_id'] ?? null ;
        
        switch($action) {
            case 'get-user-contributions':
                $offerings = new Offerings();
                $offerings->getUserContributions();
                break;
            
            case 'get-user-savings':
                $user = new User();
                $user->getUserSavings();
                break;
            
            case 'filter-date':
                $month = $_GET['month'];
                $year = $_GET['year'];
            
                $offerings = new Offerings();
                $offerings->filterUserContribution($month, $year);
                break;

            case 'clear-session-for-filter':
                session_start();
                if (isset($_SESSION['filter_month'])){
                    session_unset();
                    session_destroy();
                }
                session_destroy();
                break;
        }
    }

?>