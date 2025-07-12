<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../src/css/main.css">
    <link rel="stylesheet" href="../../src/css/members.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main">
        <div id="warning-modal">
            <div id="warning-div">
                <h4>Note:</h4>
                <p>Confirm removal of this member from the list?</p>
                <div id="warning-action-btns">
                    <button id="warning-cancel-btn">No</button>
                    <button id="warning-delete-btn">Yes</button>
                </div>
            </div>
        </div>
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
                    <a href="#">Members</a>
                    <a href="#">Logout</a>
                </div>
            </div>
        </aside>
        <section id="add-member-section">
            <h2>Add member</h2>
            <div id="add-member-form">
                <form action="./queries.php?action=add-member" method="post">
                    <div id="user-code-field">
                        <label for="user-code-input">User code or username 
                            <?php 
                                if (isset($_SESSION['user_exist_error'])){
                                    echo "<span style='color: #eb0e0e; font-size: 14px;'>* is already added as member.</span>";
                                } else if(isset($_SESSION['id_not_found_error'])) {
                                    echo "<span style='color: #eb0e0e; font-size: 14px;'>* is not found.</span>";
                                }
                            ?>
                        </label>
                        <input type="text" id="user-code-input" class="user-code" name="id" placeholder="e.g. A0001 or exampleusername.jrcc" value="<?php echo ((isset($_SESSION['user_exist_error']) && isset($_SESSION['identification'])) || isset($_SESSION['id_not_found_error'])) ? $_SESSION['identification'] : "";?>">
                    </div>
                    <button id="add-member-btn" type="submit" name="submit" value="true">Add Member</button>
                    <?php 
                        if (isset($_SESSION['user_exist_error']) || isset($_SESSION['id_not_found_error'])){
                            session_unset();
                            session_destroy();
                        }
                    ?>
                </form>
            </div>
        </section>
        <section id="search-member-section">
            <form action="#" id="search-member-form">
                <label for="search-member-input">Search Member</label>
                <div id="search-code-field">
                    <input type="text" id="search-member-input" class="user-code" name="user-code" placeholder="Firstname or lastname">
                    <div id="icon-wrapper">
                        <div id="search-member-btn">
                            <img src="../../src/assets/images/Search.png" width="100%" height="100%" alt="search">
                        </div>
                        <div id="close-member-btn">
                            <img src="../../src/assets/svg/close-search.svg" width="100%" height="100%" alt="search">
                        </div>
                    </div>
                </div>
            </form>
        </section>
        <section id="members-section">  
            <p>Members</p>
            <div id="members">
                <!-- members reflects here -->
            </div>
        </section>
    </div>
    <script src="../../src/js/toggleNavigation.js" type="module"></script>
    <script src="../../src/js/members/setupMembersActions.js" type="module"></script>
    <script src="../../src/js/members/toggleIconInSearch.js" type="module"></script>
</body>
</html>