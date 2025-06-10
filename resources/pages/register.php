<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../src/css/register.css">
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
                <p>Register</p>
                <div class="hr-line"></div>
            </div>
            <div>
                <form action="" method="post">
                    <div>
                        <div>
                            <label for="fname">First name</label>
                            <input id="fname" type="text" autocomplete="off">
                        </div>
                        <div>
                            <label for="lname">Lastname</label>
                            <input id="lname" type="text" autocomplete="off">
                        </div>
                    </div>
                    <div>
                        <label for="username">Username</label>
                        <input id="username" type="email"  autocomplete="on">
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input id="password" type="password"  autocomplete="off">
                    </div>
                    <div>
                        <label for="confirm-password">Confirm Password</label>
                        <input id="confirm-password" type="password" autocomplete="off">
                    </div>
                    <button type="submit" id="submit-btn">
                        Login
                    </button>
                </form>
            </div>
        </div>
        <div id="login-section">Already have an account? <a href="./login.php">login</a></div>
    </main>
</body>
</html>