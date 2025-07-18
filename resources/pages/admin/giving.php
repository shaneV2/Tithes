<?php session_start();
    require "../user-checker.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../src/css/main.css">
    <link rel="stylesheet" href="../../src/css/giving.css">

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
                    <a href="#">Giving</a>
                    <a href="./members.php">Members</a>
                    <button id="logout-btn">Logout</button>
                </div>
            </div>
        </aside>
        <section id="add-date-section">
            <div class="modal">
                <div id="add-date-header">
                    <p>Add Date</p>
                    <button id="close-btn"><img src="../../src/assets/images/close.png" height="100%" width="100%" alt=""></button>
                </div>
                <div>
                    <form action="./queries.php?action=add-date" method="post">
                        <div>
                            <label for="start-date">Start Date</label>
                            <input type="date" id="start-date" name="start-date" placeholder="Select Start Date" required>
                        </div>
                        <div>
                            <label for="end-date">End Date</label>
                            <input type="date" id="end-date" name="end-date" placeholder="Select End Date" required>
                        </div>
                        <button id="add-date-submit-btn" name="submit" value="true">Add Date</button>
                    </form>
                </div>
            </div>
        </section>
        <section id="tithes-offering-section">
            <h2>Tithes and Offering</h2>
            <div id="add-date-btn">
                <button>Add Date</button>
                <div id="add-btn-img">
                    <img height="20px" width="20px" src="../../src/assets/images/plus.png" alt="">
                </div>
            </div>
        </section>
        <section id="date-section">
            <div id="months-options">
                <button class="month-btn">January</button>
                <button class="month-btn">February</button>
                <button class="month-btn">March</button>
                <button class="month-btn">April</button>
                <button class="month-btn">May</button>
                <button class="month-btn">June</button>
                <button class="month-btn">July</button>
                <button class="month-btn">August</button>
                <button class="month-btn">September</button>
                <button class="month-btn">October</button>
                <button class="month-btn">November</button>
                <button class="month-btn">December</button>
            </div>
            <div id="years-options">
                <div id="years-options-wrapper">
                    <!-- Years set here -->
                </div>
            </div>
            <div id="select-date-header">
                <p>Select Date</p>
                <div id="clear-filter-btn">
                    <button>clear filter</button>
                </div>
            </div>
            <form action="#" method="get">
                <div class="select-container">
                    <input class="input-field" type="text" name="month" id="month" value="<?php 
                        if (isset(($_SESSION['filter_month']))){
                            echo $_SESSION['filter_month'];
                        }
                    ?>" placeholder="Month" readonly>
                    <div class="dropdown-icon">
                        <img src="../../src/assets/images/down.png" width="100%" height="100%" alt="">
                    </div>
                </div>
                <div class="select-container">
                    <input class="input-field" type="text" name="year" id="year" value="<?php 
                        if (isset(($_SESSION['filter_year']))){
                            echo $_SESSION['filter_year'];
                        }
                    ?>" placeholder="Year" readonly>
                    <div class="dropdown-icon">
                        <img src="../../src/assets/images/down.png" width="100%" height="100%" alt="">
                    </div>
                </div>
                <div id="submit-btn">
                    <p>
                        <img  height="20px" width="20px" src="../../src/assets/images/Filter.png" alt="filter image">
                    </p>
                </div>
            </form>
        </section>
        <div id="warning-modal">
            <div id="warning-div">
                <h4>WARNING:</h4>
                <p>This action will permanently remove records associated with this date. Are you sure you want to proceed?</p>
                <div id="warning-action-btns">
                    <button id="warning-cancel-btn">Cancel</button>
                    <button id="warning-delete-btn">Delete</button>
                </div>
            </div>
        </div>
        <section id="date-list-section">  
            <p>Date List</p>
            <div id="date-list">
                <!-- dates reflects here -->
            </div>
        </section>
    </div>
    <script src="../../src/js/selectMonth.js" type="module"></script>
    <script src="../../src/js/selectYear.js" type="module"></script>
    <script src="../../src/js/toggleNavigation.js" type="module"></script>
    <script src="../../src/js/logout.js" type="module"></script>
    <script src="../../src/js/giving/addDate.js" type="module"></script>
    <script src="../../src/js/selectDate.js" type="module"></script>
    <script src="../../src/js/giving/useDateActions.js" type="module"></script>
    <script src="../../src/js/closeDateOptionsOnDocumentClick.js" type="module"></script>
    <script src="../../src/js/giving/useFilter.js" type="module"></script>
</body>
</html>