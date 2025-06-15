<?php 
    class Register extends Database {
        public function validateInput($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);

            return $data;
        }

        private function checkIfPasswordMatch($password, $confirm_password){
            if ($password == $confirm_password){
                return true;
            }else {
                return false;
            }
        }

        public function checkIfUsernameExists($username){
            $connection = $this->getConnection();

            $stmt = $connection->prepare("select username from users where username=?");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            $result = $stmt->get_result();
            if (mysqli_num_rows($result) > 0){
                return true;
            }else {
                return false;
            }
        }

        private function placeInputValuesToSession($firstname, $lastname, $username, $password, $confirm_password){
                session_start();
                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $lastname;
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['confirm_password'] = $confirm_password;
        }

        public function registerUser($firstname, $lastname, $username, $password, $confirm_password){
            // Validate input
            $username = $this->validateInput($username);
            $firstname = ucfirst($this->validateInput($firstname));
            $lastname = ucfirst($this->validateInput($lastname));
            $password = $this->validateInput($password);
            $confirm_password = $this->validateInput($confirm_password);

            $connection = $this->getConnection();

            if ($this->checkIfUsernameExists($username) == true){
                $this->placeInputValuesToSession($firstname, $lastname, $username, $password, $confirm_password);
                $_SESSION['username_error'] = true;
            }

            if ($this->checkIfPasswordMatch($password, $confirm_password) == false){
                $_SESSION['password_mismatch'] = true;
                $this->placeInputValuesToSession($firstname, $lastname, $username, $password, $confirm_password);
            }

            if ($this->checkIfUsernameExists($username) || $this->checkIfPasswordMatch($password, $confirm_password)){
                return;
            }

            // Generate code
            try {
                $last_id_query = "select id from users order by id desc limit 1";
                $result = mysqli_query($connection, $last_id_query);
                $last_five_id = mysqli_fetch_assoc($result);
                
                $code = 'A';
                $pad_length = 4;
                if ($last_five_id == null){
                    $code .= str_pad((string) 1000000, $pad_length, '0', STR_PAD_LEFT);
                }else {
                    $new_code_id_string = $last_five_id['id'] + 1;
                    if ($new_code_id_string >= 100){
                        $pad_length = 5;
                    }
                    $code .= str_pad((string) $new_code_id_string, $pad_length, '0', STR_PAD_LEFT);
                }
            } catch (\Throwable $th) {
                return;            
            }

            // Insert new user
            try {
                $stmt = $connection->prepare("insert into users(user_code, username, firstname, lastname, password) values(?,?,?,?,?)");
                $stmt->bind_param("sssss",$code, $username, $firstname, $lastname, $password);
                $stmt->execute();
            } catch (\Throwable $th) {
                return;
            }finally {
                if (isset($stmt) && $stmt instanceof mysqli_stmt){
                    $stmt->close();
                }
                if (isset($connection) && $connection instanceof mysqli){
                    $connection->close();
                }
            }

            if ($password != $confirm_password){
                $this->placeInputValuesToSession($firstname, $lastname, $username, $password, $confirm_password);
                $_SESSION['password_mismatch'] = true;
            }
        }
    }