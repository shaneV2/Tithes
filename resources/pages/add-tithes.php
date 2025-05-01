<?php 
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
    <link rel="stylesheet" href="../src/css/main.css">
    <link rel="stylesheet" href="../src/css/add-tithes-offering.css">

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
                    <a href="#">Home</a>
                    <a href="./giving.php">Giving</a>
                    <a href="./members.php">Members</a>
                </div>
                <button>Logout</button>
            </div>
        </aside>
        <section id="add-tithes-section">
            <div id="back-btn">
                <a href="./date.php">Back</a>
            </div>
            <p>Add Tithes and Offerings</p>
            <form id="add-tithes-form" action="./queries.php?action=add-user-offer" method="post">
                <div>
                    <input style="display: none;" type="text" name="date_id" value="<?php echo $date_id;?>">
                    <input style="display: none;" type="text" name="start_date" value="<?php echo $start_date;?>">
                    <input style="display: none;" type="text" name="end_date" value="<?php echo $end_date;?>">
                </div>
                <div>
                    <label for="">Name</label>
                    <input type="text" name="username">
                </div>
                <div>
                    <label for="">Tithes</label>
                    <input type="number" name="tithes">
                </div>
                <div>
                    <label for="">Mission</label>
                    <input type="number" name="mission">
                </div>
                <div>
                    <label for="">OMG</label>
                    <input type="number" name="omg">
                </div>
                <div>
                    <label for="">Pledges</label>
                    <input type="number" name="pledges">
                </div>
                <div>
                    <label for="">Donation</label>
                    <input type="number" name="donation">
                </div>
                <div id="add-tithes-btn">
                    <div>
                        <label>Total</label>
                        <p>PHP 1000</p>
                    </div>
                    <button type="submit">Add Data</button>
                </div>
            </form>
        </section>
    </div>
    <script src="../src/js/selectDate.js" type="module"></script>
    <script src="../src/js/selectMonth.js" type="module"></script>
    <script src="../src/js/selectYear.js" type="module"></script>
    <script src="../src/js/toggleNavigation.js" type="module"></script>
</body>
</html>