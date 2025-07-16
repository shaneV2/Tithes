<?php 
    session_start();
    require "../user-checker.php";

    $firstname = "--";
    $lastname = "--";
    $initials = "";
    if (isset($_SESSION['firstname'])){
        $firstname = $_SESSION['firstname'];
        $initials .= $firstname[0];
    }
    if (isset($_SESSION['lastname'])){
        $lastname = $_SESSION['lastname'];
        $initials .= $lastname[0];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../src/css/main.css">
    <link rel="stylesheet" href="../../src/css/user-homepage.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main">
        <header>
            <div id="user-info-section">
                <p><?php echo $initials;?></p>
                <div>
                    <h1><?php echo $firstname . " " . $lastname;?></h1>
                    <div id="code-section">
                        <p id="user-code">--</p>
                        <img id="copy-img-element"  src="../../src/assets/svg/copy.svg" width="14" height="14" alt="">
                    </div>
                </div>
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
                    <a href="#">Home</a>
                    <button id="logout-btn">Logout</button>
                </div>
            </div>
        </aside>
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
                    <!-- years reflects here -->
                </div>
            </div>
            <div id="select-date-header">
                <p>Select Date</p>
                <div id="clear-filter-btn">
                    <button>clear filter</button>
                </div>
            </div>
            <form action="test.php" method="get">
                <div class="select-container">
                    <input class="input-field" type="text" name="month" id="month" value="" placeholder="Month" readonly>
                    <div class="dropdown-icon">
                        <img src="../../src/assets/images/down.png" width="100%" height="100%" alt="">
                    </div>
                </div>
                <div class="select-container">
                    <input class="input-field" type="text" name="year" id="year" value="" placeholder="Year" readonly>
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
        <main>
            <!-- <section id="recent-section">
                <p>Recent</p>
                <div>
                    <p>Tithes and Offering: <span>1,000</span></p>
                    <p>Mission: <span>500</span></p>
                    <p>OMG: <span>100</span></p>
                    <p>Pledges: <span></span></p>
                    <p>Donation: <span></span></p>
                    <p>Total: <span>1,600</span></p>
                </div>
            </section> -->
            <section id="date-list-section">  
                <p>Contribution List</p>
                <div id="date-list">
                    <!-- dates reflects here -->
                </div>
            </section>
            <section id="savings-section">
                <p>Savings</p>
                <div id="amount-section">
                    <p>&#x20B1; <span id="amount">--</span></p>
                    <p id="amount-spell">--</p>
                </div>
            </section>
        </main>
        <script src="../../src/js/selectMonth.js" type="module"></script>
        <script src="../../src/js/selectYear.js" type="module"></script>
        <script src="../../src/js/toggleNavigation.js" type="module"></script>
        <script src="../../src/js/logout.js" type="module"></script>
        <script src="../../src/js/selectDate.js" type="module"></script>
        <script src="../../src/js/user-homepage/useDateActions.js" type="module"></script>
        <script src="../../src/js/user-homepage/useFilter.js" type="module"></script>
        <script src="../../src/js/user-homepage/getUserSavings.js" type="module"></script>
        <script src="../../src/js/user-homepage/getUserCode.js" type="module"></script>
        <script src="../../src/js/user-homepage/addToClipboard.js" type="module"></script>
        <script src="../../src/js/closeDateOptionsOnDocumentClick.js" type="module"></script>
        </script>
    </div>
</body>
</html>