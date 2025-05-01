<?php 
    class Offerings extends Database {
        public function addUserOffering($username, $date_id, $tithes_and_offerings){
            $conn = $this->getConnection();
            [$tithes, $mission, $omg, $pledges, $donation] = $tithes_and_offerings;

            $stmt = $conn->prepare("insert into user_offers(`user_name`, `tithes`, `mission`, `omg`, `pledges`, `donation`, `date_id`) values(?,?,?,?,?,?,?);");
            $stmt->bind_param("siiiiii", $username, $tithes, $mission, $omg, $pledges, $donation, $date_id);
            $stmt->execute();

            $conn->close();
        }
    }
?>