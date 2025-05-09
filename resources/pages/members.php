<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../src/css/main.css">
    <link rel="stylesheet" href="../src/css/members.css">

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
        <section id="add-member-section">
            <h2>Add member</h2>
            <div id="add-member-form">
                <form action="#">
                    <div id="user-code-field">
                        <label for="user-code-input">User Code</label>
                        <input type="text" id="user-code-input" class="user-code" name="user-code" placeholder="E.g A0001">
                    </div>
                    <button id="add-member-btn" type="submit" name="submit" value="true">Add Member</button>
                </form>
            </div>
        </section>
        <section id="search-member-section">
            <form action="#">
                <label for="search-member-input">Search Member</label>
                <div id="search-code-field">
                    <input type="text" id="search-member-input" class="user-code" name="user-code" placeholder="Name or user code">
                    <button id="search-member-btn" type="submit" name="submit" value="true">
                        <img src="../src/assets/images/Search.png" width="100%" height="100%" alt="search">
                    </button>
                </div>
            </form>
        </section>
        <section id="members-section">  
            <p>Members</p>
            <div id="members">
                <div class="member">
                    <a href="">
                        <p>Arranguez, Darryl Y.</p>
                        <div class="arrow-icon">
                            <img src="../src/assets/svg/ellipses.svg" alt="arrow">
                        </div>
                    </a>
                </div>
                <div class="member">
                    <a href="">
                        <p>Arranguez, Darryl Y.</p>
                        <div class="arrow-icon">
                            <img src="../src/assets/svg/ellipses.svg" alt="arrow">
                        </div>
                    </a>
                </div>
                <div class="member">
                    <a href="">
                        <p>Arranguez, Darryl Y.</p>
                        <div class="arrow-icon">
                            <img src="../src/assets/svg/ellipses.svg" alt="arrow">
                        </div>
                    </a>
                </div>
                <div class="member">
                    <a href="">
                        <p>Arranguez, Darryl Y.</p>
                        <div class="arrow-icon">
                            <img src="../src/assets/svg/ellipses.svg" alt="arrow">
                        </div>
                    </a>
                </div>
                <div class="member">
                    <a href="">
                        <p>Arranguez, Darryl Y.</p>
                        <div class="arrow-icon">
                            <img src="../src/assets/svg/ellipses.svg" alt="arrow">
                        </div>
                    </a>
                </div>
                <div class="member">
                    <a href="">
                        <p>Arranguez, Darryl Y.</p>
                        <div class="arrow-icon">
                            <img src="../src/assets/svg/ellipses.svg" alt="arrow">
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </div>
    <script src="../src/js/toggleNavigation.js" type="module"></script>
</body>
</html>