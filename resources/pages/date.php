<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../src/css/main.css">
    <link rel="stylesheet" href="../src/css/date.css">

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
                    <a href="./giving.php">Giving</a>
                    <a href="#">Members</a>
                </div>
                <button>Logout</button>
            </div>
        </aside>
        <section id="total-tithes-offering-section">
            <p>March 20, 2025 - April 6, 2025</p>
            <table id="tithes-table">
                <tr>
                    <td>1000</td>
                    <td>2</td>
                    <td>2,000</td>
                </tr>
                <tr>
                    <td>500</td>
                    <td>2</td>
                    <td>1,000</td>
                </tr>
                <tr>
                    <td>200</td>
                    <td>2</td>
                    <td>400</td>
                </tr>
                <tr>
                    <td>100</td>
                    <td>2</td>
                    <td>100</td>
                </tr>
                <tr>
                    <td>50</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>20</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>10</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Total</td>
                    <td>4,000</td>
                </tr>
            </table>
            <button id="add-tithes-btn">
                <a href="">Add Tithes and Offerings</a>
            </button>
        </section>
        <section id="members-section">  
            <p>Members</p>
            <div id="members">
                <div class="member">
                    <a href="">
                        <p>Arranguez, Darryl Y.</p>
                        <div class="arrow-icon">
                            <img src="../src/assets/images/arrow_back.png" alt="arrow">
                        </div>
                    </a>
                </div>
                <div class="member">
                    <a href="">
                        <p>Arranguez, Darryl Y.</p>
                        <div class="arrow-icon">
                            <img src="../src/assets/images/arrow_back.png" alt="arrow">
                        </div>
                    </a>
                </div>
                <div class="member">
                    <a href="">
                        <p>Arranguez, Darryl Y.</p>
                        <div class="arrow-icon">
                            <img src="../src/assets/images/arrow_back.png" alt="arrow">
                        </div>
                    </a>
                </div>
                <div class="member">
                    <a href="">
                        <p>Arranguez, Darryl Y.</p>
                        <div class="arrow-icon">
                            <img src="../src/assets/images/arrow_back.png" alt="arrow">
                        </div>
                    </a>
                </div>
                <div class="member">
                    <a href="">
                        <p>Arranguez, Darryl Y.</p>
                        <div class="arrow-icon">
                            <img src="../src/assets/images/arrow_back.png" alt="arrow">
                        </div>
                    </a>
                </div>
                <div class="member">
                    <a href="">
                        <p>Arranguez, Darryl Y.</p>
                        <div class="arrow-icon">
                            <img src="../src/assets/images/arrow_back.png" alt="arrow">
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </div>
    <script src="../src/js/toggleNavigation.js" type="module"></script>
</body>
</html>