<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../src/css/main.css">
    <link rel="stylesheet" href="../src/css/giving.css">

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
                    <img src="../src/assets/images/Menu.png" height="38" width="38" alt="">
                </div>
            </nav>
        </header>
        <aside id="navigation-pane">
            <div>
                <div id="close-menu-icon"><img src="../src/assets/images/close.png" width="100%" height="100%" alt=""></div>
                <div>
                    <a href="./homepage.php">Home</a>
                    <a href="#">Giving</a>
                    <a href="./members.php">Members</a>
                </div>
                <button>Logout</button>
            </div>
        </aside>
        <section id="add-date-section">
            <div class="modal">
                <div id="add-date-header">
                    <p>Add Date</p>
                    <button><img src="../src/assets/images/close.png" height="100%" width="100%" alt=""></button>
                </div>
                <div>
                    <form action="">
                        <div>
                            <label for="start-date">Start Date</label>
                            <input type="date" id="start-date" name="start-date" placeholder="Select Start Date">
                        </div>
                        <div>
                            <label for="end-date">End Date</label>
                            <input type="date" id="end-date" name="end-date" placeholder="Select End Date">
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
                    <img src="../src/assets/images/plus.png" alt="">
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
                <div>
                    <button class="year-btn">2001</button>
                    <button class="year-btn">2002</button>
                    <button class="year-btn">2003</button>
                    <button class="year-btn">2004</button>
                    <button class="year-btn">2005</button>
                    <button class="year-btn">2006</button>
                    <button class="year-btn">2007</button>
                    <button class="year-btn">2008</button>
                    <button class="year-btn">2009</button>
                    <button class="year-btn">2010</button>
                </div>
            </div>
            <p>Select Date</p>
            <form action="test.php" method="get">
                <div class="select-container">
                    <input class="input-field" type="text" name="month" id="month" value="" placeholder="Month" readonly>
                    <div class="dropdown-icon">
                        <img src="../src/assets/images/down.png" width="100%" height="100%" alt="">
                    </div>
                </div>
                <div class="select-container">
                    <input class="input-field" type="text" name="year" id="year" value="" placeholder="Year" readonly>
                    <div class="dropdown-icon">
                        <img src="../src/assets/images/down.png" width="100%" height="100%" alt="">
                    </div>
                </div>
                <div id="submit-btn">
                    <button type="submit">
                        <img src="../src/assets/images/Filter.png" alt="filter image">
                    </button>
                </div>
            </form>
        </section>
        <section id="date-list-section">  
            <p>Date List</p>
            <div id="date-list">
                <div class="date">
                    <a href="./add-tithes.php">
                        <p>March, 20, 2025 - April, 6, 2025</p>
                        <div class="arrow-icon">
                            <img src="../src/assets/images/arrow_back.png" alt="arrow">
                        </div>
                    </a>
                </div>
                <div class="date">
                    <a href="./add-tithes.php">
                        <p>March, 20, 2025 - April, 6, 2025</p>
                        <div class="arrow-icon">
                            <img src="../src/assets/images/arrow_back.png" alt="arrow">
                        </div>
                    </a>
                </div>
                <div class="date">
                    <a href="./add-tithes.php">
                        <p>March, 20, 2025 - April, 6, 2025</p>
                        <div class="arrow-icon">
                            <img src="../src/assets/images/arrow_back.png" alt="arrow">
                        </div>
                    </a>
                </div>
                <div class="date">
                    <a href="./add-tithes.php">
                        <p>March, 20, 2025 - April, 6, 2025</p>
                        <div class="arrow-icon">
                            <img src="../src/assets/images/arrow_back.png" alt="arrow">
                        </div>
                    </a>
                </div>
                <div class="date">
                    <a href="./add-tithes.php">
                        <p>March, 20, 2025 - April, 6, 2025</p>
                        <div class="arrow-icon">
                            <img src="../src/assets/images/arrow_back.png" alt="arrow">
                        </div>
                    </a>
                </div>
                <div class="date">
                    <a href="./add-tithes.php">
                        <p>March, 20, 2025 - April, 6, 2025</p>
                        <div class="arrow-icon">
                            <img src="../src/assets/images/arrow_back.png" alt="arrow">
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </div>
    <script src="../src/js/selectDate.js" type="module"></script>
    <script src="../src/js/selectMonth.js" type="module"></script>
    <script src="../src/js/selectYear.js" type="module"></script>
    <script src="../src/js/toggleNavigation.js" type="module"></script>
</body>
</html>