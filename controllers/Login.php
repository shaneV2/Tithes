<?php 
    class Login extends Database { 
        public function loginUser($username, $password){
            $connection = $this->getConnection();

            try {
                $stmt = $connection->prepare("select username, password, user_type from users where username=?");
                $stmt->bind_param("s", $username);
                $stmt->execute();

                $result = $stmt->get_result();
                if (mysqli_num_rows($result) > 0){
                    while ($row = mysqli_fetch_assoc($result)){
                        $password_hash = $row['password'];
                        $user_type = $row['user_type'];

                        // Verify if user input, password, is correct
                        if (password_verify($password, $password_hash)){
                            // if user type is standard, go to user page
                            // otherwise, go to admin page 
                            if (strtolower($user_type) != 'admin'){
                                header("Location: ./user/homepage.php");
                            } else if (strtolower($user_type) == 'admin'){
                                header("Location: ./admin/homepage.php");
                            }
                        }else {
                            session_start();
                            $_SESSION['login_error'] = true;
                            header("Location: ./login.php");
                            return;
                        }
                    }
                }else {
                    session_start();
                    $_SESSION['login_error'] = true;
                    header("Location: ./login.php");
                    return;
                }
            } catch (\Throwable $th) {
                echo "an error has occured.";
            }finally {
                if (isset($stmt) && $stmt instanceof mysqli_stmt){
                    $stmt->close();
                }
                if (isset($connection) && $connection instanceof mysqli){
                    $connection->close();
                }
            }
            
        }
    }