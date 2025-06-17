<?php 
    class Login extends Database { 
        public function loginUser($username, $password){
            $connection = $this->getConnection();

            try {
                $stmt = $connection->prepare("select username, password from users where username=?");
                $stmt->bind_param("s", $username);
                $stmt->execute();

                $result = $stmt->get_result();
                if (mysqli_num_rows($result) > 0){
                    $password_hash = mysqli_fetch_assoc($result)['password'];
                    if (password_verify($password, $password_hash)){
                        header("Location: ./homepage.php");
                    }else {
                        session_start();
                        $_SESSION['login_error'] = true;
                        header("Location: ../login.php");
                        return;
                    }
                }else {
                    session_start();
                    $_SESSION['login_error'] = true;
                    header("Location: ../login.php");
                    return;
                }
            } catch (\Throwable $th) {
                echo $th;
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