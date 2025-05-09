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
        <section id="user-offer-modal">
            <div id="modal">
                <div>
                    <p>Arranguez, Darryl Y.</p>
                    <div class="close-btn">
                        <img src="../src/assets/images/close.png" height="100%" width="100%" alt="">
                    </div>
                </div>
                <table>
                    <tr>
                        <td>Tithes and Offering</td>
                        <td>1000</td>
                    </tr>
                    <tr>
                        <td>Mission</td>
                        <td>500</td>
                    </tr>
                    <tr>
                        <td>OMG</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td>Pledges</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Donation</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>1600</td>
                    </tr>
                </table>
            </div>
        </section>
        <section id="shares-modal">
            <div id="modal">
                <div>
                    <p>Shares</p>
                    <div class="close-btn">
                        <img src="../src/assets/images/close.png" height="100%" width="100%" alt="">
                    </div>
                </div>
                <table>
                    <tr>
                        <th>Pastors</th>
                        <th>Pastor Share</th>
                        <th>Total</th>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>478</td>
                        <td>1915</td>
                    </tr>
                </table>
            </div>
        </section>
        <section id="total-tithes-offering-section">
            <div id="back-btn">
                <a href="./giving.php">Back</a>
            </div>
            <p><?php echo $start_date . " - " . $end_date;?></p>
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
                <a href="./add-tithes.php?<?php echo "d_id=". $date_id ."&start_date=". $start_date ."&end_date=". $end_date; ?>">Add Tithes and Offerings</a>
            </button>
            <button id="view-shares-btn">
                <a href="">View shares</a>
            </butti>
        </section>
        <section id="members-section">  
            <p>Members</p>
            <div id="members">
            </div>
        </section>
    </div>
    <script src="../src/js/toggleNavigation.js" type="module"></script>
    <script src="../src/js/members.js" type="module"></script>
</body>
</html>