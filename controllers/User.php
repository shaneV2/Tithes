<?php 

    class User extends Database {
        public function getUserSavings(){
            $id = 1;

            $conn = $this->getConnection();
            $stmt = $conn->prepare("select s.amount from savings s inner join users u on s.user_code = u.user_code where u.id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if (mysqli_num_rows($result) > 0){
                $savings_amount = mysqli_fetch_assoc($result)['amount'];
                echo number_format($savings_amount, 2); 
            }

            $conn->close();
        }
    }