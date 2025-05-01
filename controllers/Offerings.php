<?php 
    class Offerings extends Database {
        public function addUserOffer($username, $date_id, $tithes_and_offerings){
            $conn = $this->getConnection();

            $username = "john doe";
            $date_id = 23;
            [$tithes, $mission, $omg, $pledges, $donation] = [1000, 500, 0, 0, 0];

            $stmt = $conn->prepare("insert into user_offers(`user_name`, `tithes`, `mission`, `omg`, `pledges`, `donation`, `date_id`) values(?,?,?,?,?,?,?);");
            $stmt->bind_param("siiiiii", $username, $tithes, $mission, $omg, $pledges, $donation, $date_id);
            $stmt->execute();
        }
    }
?>