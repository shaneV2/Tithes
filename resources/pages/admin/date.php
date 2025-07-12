<?php 
    $date_id = $_GET['d_id'];
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
    $month_filter_name = $_GET['month'] ?? null;
    $year_filter = $_GET['year'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../src/css/main.css">
    <link rel="stylesheet" href="../../src/css/date.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main">
        <header>
            <div>
                <p>AP</p>
                <h1>ADMIN PANEL</h1>
            </div>
            <nav>
                <div id="menu-icon">
                    <img src="../../src/assets/images/Menu.png" height="38" width="38" alt="">
                </div>
            </nav>
        </header>
        <aside id="navigation-pane">
            <div>
                <div id="close-menu-icon"><img src="../../src/assets/images/close.png" width="100%" height="100%" alt=""></div>
                <div>
                    <a href="./homepage.php">Home</a>
                    <a href="./giving.php">Giving</a>
                    <a href="./members.php">Members</a>
                    <a href="#">Logout</a>
                </div>
            </div>
        </aside>
        <section id="shares-modal">
            <div id="inner-modal">
                <div>
                    <p>Shares</p>
                    <div id="shares-close-btn">
                        <img src="../../src/assets/images/close.png" height="100%" width="100%" alt="">
                    </div>
                </div>
                <div id="shares-table"></div>
            </div>
        </section>
        <section id="total-tithes-offering-section">
            <div id="back-btn">
                <a href="./giving.php">Back</a>
            </div>
            <p><?php echo $start_date . " - " . $end_date;?></p>
            <div id="tithes-table-wrapper">
                <!-- Denominations table reflects here -->
            </div>
            <button id="add-tithes-btn">
                <a href="./add-tithes.php?<?php echo "d_id=". $date_id ."&start_date=". $start_date ."&end_date=". $end_date; ?>">Add Tithes and Offerings</a>
            </button>
            <button id="view-shares-btn">
                View shares
            </butti>
        </section>
        <div id="warning-modal">
            <div id="warning-div">
                <h4>WARNING!!!</h4>
                <p>This action will permanently remove records associated with this date. Are you sure you want to proceed?</p>
                <div id="warning-action-btns">
                    <button id="warning-cancel-btn">Cancel</button>
                    <button id="warning-delete-btn">Delete</button>
                </div>
            </div>
        </div>
        <section id="members-section">  
            <p>Contributors</p>
            <div id="members">
            </div>
        </section>
    </div>
    <script src="../../src/js/toggleNavigation.js" type="module"></script>
    <script src="../../src/js/dates/members.js" type="module"></script>
    <script src="../../src/js/dates/loadDenominationsAndShares.js" type="module"></script>
    <script src="../../src/js/dates/useMemberActions.js" type="module"></script>
</body>
</html>