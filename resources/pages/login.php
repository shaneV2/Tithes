<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../src/css/login.css">
</head>
<body>
    <main>
        <div id="header">
            <p><span>JESUS</span> <span>REIGNS</span></p>
            <p>COMMUNITY CHURCH</p>
        </div>
        <div id="input-section">
            <div>
                <div class="hr-line"></div>
                <p>Login</p>
                <div class="hr-line"></div>
            </div>
            <?php 
                if (isset($_SESSION['login_error'])){
                    echo '<div class="login-error"><p>Invalid username or password.</p></div>';
                    session_unset();
                    session_destroy();
                }
            ?>
            <div>
                <form action="./queries.php?action=login" method="post">
                    <div>
                        <label for="username">Username</label>
                        <input id="username" type="text" name="username" required>
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" autocomplete="off" required>
                    </div>
                    <button type="submit" id="submit-btn">
                        Login
                    </button>
                </form>
            </div>
        </div>
        <div id="register-section">No account yet? <a href="./register.php">register</a></div>
    </main>
</body>
</html>