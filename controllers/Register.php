<?php 
    class Register extends Database {
        public function validateInput($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);

            return $data;
        }

        public function registerUser($firstname, $lastname, $username, $password){
            // Validate input
            $username = $this->validateInput($username);
            $firstname = ucfirst($this->validateInput($firstname));
            $lastname = ucfirst($this->validateInput($lastname));
            $password = $this->validateInput($password );

            $connection = $this->getConnection();

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

            try {
                $stmt = $connection->prepare("insert into users(user_code, username, firstname, lastname, password) values(?,?,?,?,?)");
                $stmt->bind_param("sssss",$code, $username, $firstname, $lastname, $password);
                $stmt->execute();
            } catch (\Throwable $th) {
                session_start();
                echo $th;
                $_SESSION['username_error'] = true; 
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