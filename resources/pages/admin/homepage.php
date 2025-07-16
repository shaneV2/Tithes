<?php 
    session_start();
    require "../user-checker.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../src/css/main.css">
    <link rel="stylesheet" href="../../src/css/homepage.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <style>
        :root {
            --body-font: 'Inter', sans-serif;
        }
        #empty-homepage-section {
            font-family: var(--body-font);
            height: 500px;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #empty-homepage-section > h1 {
            font-weight: 500;
            font-size: 20px;
            position: absolute;
            color: gray;
        }
    </style>
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
        <section id="empty-homepage-section">
            <h1>No content yet.</h1>
        </section>
    </div>
    <script src="../../src/js/selectDate.js" type="module"></script>
    <script src="../../src/js/logout.js" type="module"></script>
    <script src="../../src/js/selectMonth.js" type="module"></script>
    <script src="../../src/js/selectYear.js" type="module"></script>
    <script src="../../src/js/toggleNavigation.js" type="module"></script>
</body>
</html>