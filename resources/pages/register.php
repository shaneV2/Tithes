<?php session_start();?>

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
                <form action="./admin/queries.php?action=register-user" method="post">
                    <div>
                        <div>
                            <label for="fname">First name</label>
                            <input 
                                id="fname" 
                                name="firstname" 
                                type="text" 
                                autocomplete="off" 
                                value="<?php 
                                    if ((isset($_SESSION['username_error']) || isset($_SESSION['password_mismatch'])) && isset($_SESSION['firstname'])){
                                        echo $_SESSION['firstname'];
                                    }
                                ?>"
                                required>
                        </div>
                        <div>
                            <label for="lname">Lastname</label>
                            <input 
                                id="lname" 
                                name="lastname" 
                                type="text" 
                                autocomplete="off"
                                value="<?php 
                                    if ((isset($_SESSION['username_error']) || isset($_SESSION['password_mismatch'])) && isset($_SESSION['lastname'])){
                                        echo $_SESSION['lastname'];
                                    }
                                ?>" 
                                required>
                        </div>
                    </div>
                    <div>
                        <label for="username">
                            Username 
                            <?php echo isset($_SESSION['username_error']) ? "<span style='color: #eb0e0e;'>* is already taken.</span>" : "" ;?>
                        </label>
                        <input 
                            id="username" 
                            name="username" 
                            type="text" 
                            autocomplete="on" 
                            pattern="[A-Za-z0-9]+\.jrcc" 
                            title="Valid username should only include letters and/or numbers and must end with .jrcc (e.g exampleusername.jrcc, exampleusername09.jrcc or 09.jrcc)" 
                            class="<?php echo isset($_SESSION['username_error'])? "input-error" : "" ;?>"
                            value="<?php 
                                if ((isset($_SESSION['username_error']) || isset($_SESSION['password_mismatch'])) && isset($_SESSION['username'])){
                                    echo $_SESSION['username'];
                                }
                            ?>"
                            required 
                        >
                    </div>
                    <div>
                        <label for="password">Password <?php echo isset($_SESSION['password_mismatch']) ? "<span style='color: #eb0e0e;'>* does not match.</span>" : "" ;?></label>
                        <input 
                            id="password" 
                            name="password" 
                            type="password"  
                            autocomplete="off" 
                            value="<?php 
                                if ((isset($_SESSION['username_error']) || isset($_SESSION['password_mismatch'])) && isset($_SESSION['password'])){
                                    echo $_SESSION['password'];
                                }
                            ?>"
                            required>
                    </div>
                    <div>
                        <label for="confirm-password">Confirm Password</label>
                        <input 
                            id="confirm-password" 
                            name="confirm-password"
                            type="password" 
                            autocomplete="off"
                            value="<?php 
                                if(isset($_SESSION['password_mismatch']) && isset($_SESSION['password'])){
                                    echo "";
                                }else if (isset($_SESSION['username_error']) && isset($_SESSION['password'])){
                                    echo $_SESSION['password'];
                                }
                            ?>" 
                            required>
                    </div>
                    <button type="submit" id="submit-btn">
                        Register
                    </button>
                    <?php 
                        if (isset($_SESSION['username_error']) || isset($_SESSION['password_mismatch'])){
                            session_unset();
                            session_destroy();
                        } 
                    ?>
                </form>
            </div>
        </div>
        <div id="register-section">Already have an account? <a href="./login.php">login</a></div>
    </main>
</body>
</html>