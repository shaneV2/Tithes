<?php 
    session_start();
    require "../user-checker.php";

    $date_id = $_GET['d_id'];
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../src/css/main.css">
    <link rel="stylesheet" href="../../src/css/add-tithes-offering.css">

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
                    <a href="#">Home</a>
                    <a href="./giving.php">Giving</a>
                    <a href="./members.php">Members</a>
                    <button id="logout-btn">Logout</button>
                </div>
            </div>
        </aside>
        <section id="add-tithes-section">
            <div id="back-btn">
                <a href="./date.php?<?php echo "d_id=" . $date_id ."&start_date=". $start_date ."&end_date=" .$end_date;?>">Back</a>
            </div>
            <p>Add Tithes and Offerings</p>
            <form id="add-tithes-form" action="./queries.php?action=add-user-offer" method="post">
                <div>
                    <input style="display: none;" type="text" name="date_id" value="<?php echo $date_id;?>">
                    <input style="display: none;" type="text" name="start_date" value="<?php echo $start_date;?>">
                    <input style="display: none;" type="text" name="end_date" value="<?php echo $end_date;?>">
                    <input id="m_id" type="text" name="m_id">
                </div>
                <div id="offerings-input-field">
                    <div id="name-input-section">
                        <label for="name" id="name-container">Name <span id="status"><div id="dummy-status"> </div><img height="14" id="status-img-user-added" src="../../src/assets/svg/check.svg" alt=""></span></label>
                        <input id="name" type="text" name="username" required autofocus autocomplete="off">
                        <div id="name-fill-section">
                            <!-- suggested names appear here -->
                        </div>
                    </div>
                    <div>
                        <label for="tithes">Tithes</label>
                        <input id="tithes" type="number" name="tithes">
                    </div>
                    <div>
                        <label for="mission">Mission</label>
                        <input id="mission" type="number" name="mission">
                    </div>
                    <div>
                        <label for="omg">OMG</label>
                        <input id="omg" type="number" name="omg">
                    </div>
                    <div>
                        <label for="pledges">Pledges</label>
                        <input id="pledges" type="number" name="pledges">
                    </div>
                    <div>
                        <label for="donation">Donation</label>
                        <input id="donation" type="number" name="donation">
                    </div>
                </div>
                <div id="digits">
                    <div>
                        <div>
                            <label for="1000">1000s</label>
                            <input id="1000" type="number" name="denominations[1000]">
                        </div>
                        <div>
                            <label for="500">500s</label>
                            <input id="500" type="number" name="denominations[500]">
                        </div>
                        <div>
                            <label for="200">200s</label>
                            <input id="200" type="number" name="denominations[200]">
                        </div>
                        <div>
                            <label for="100">100s</label>
                            <input id="100" type="number" name="denominations[100]">
                        </div>
                        <div>
                            <label for="50">50s</label>
                            <input id="50" type="number" name="denominations[50]">
                        </div>
                        <div>
                            <label for="20">20s</label>
                            <input id="20" type="number" name="denominations[20]">
                        </div>
                        <div>
                            <label for="10">10s</label>
                            <input id="10" type="number" name="denominations[10]">
                        </div>
                        <div>
                            <label for="5">5s</label>
                            <input id="5" type="number" name="denominations[5]">
                        </div>
                        <div>
                            <label for="1">1s</label>
                            <input id="1" type="number" name="denominations[1]">
                        </div>
                    </div>
                </div>
                <div id="error"><p>Denominations does not equal to the total offering</p></div>
                <div id="add-tithes-btn">
                    <div>
                        <label>Total</label>
                        <p>PHP <span id="total">0</span></p>
                    </div>
                    <button id="submit-btn" type="submit">Add Data</button>
                </div>
            </form>
        </section>
    </div>
    <script src="../../src/js/toggleNavigation.js" type="module"></script>
    <script src="../../src/js/logout.js" type="module"></script>
    <script src="../../src/js/add-tithes/checkUserInputs.js" type="module"></script>
    <script src="../../src/js/add-tithes/getMembersSuggestionOnUserInput.js" type="module"></script>
</body>
</html>