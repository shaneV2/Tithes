<?php 
    class Offerings extends Database {
        public function addUserOffering($username, $date_id, $tithes_and_offerings, $denominations){
            $conn = $this->getConnection();
            [$tithes, $mission, $omg, $pledges, $donation] = $tithes_and_offerings;

            // User offers query
            $stmt = $conn->prepare("insert into user_offers(`user_name`, `tithes`, `mission`, `omg`, `pledges`, `donation`, `date_id`) values(?,?,?,?,?,?,?);");
            $stmt->bind_param("siiiiii", $username, $tithes, $mission, $omg, $pledges, $donation, $date_id);
            $stmt->execute();

            // Denominations query
            $thousands = !empty($denominations['1000']) ? $denominations['1000'] : 0;
            $five_hundreds = !empty($denominations['500']) ? $denominations['500'] : 0;
            $two_hundreds = !empty($denominations['200']) ? $denominations['200'] : 0;
            $hundreds = !empty($denominations['100']) ? $denominations['100'] : 0;
            $fifties = !empty($denominations['50']) ? $denominations['50'] : 0;
            $twenties = !empty($denominations['20']) ? $denominations['20'] : 0;
            $tens = !empty($denominations['10']) ? $denominations['10'] : 0;
            $fives = !empty($denominations['5']) ? $denominations['5'] : 0;
            $ones = !empty($denominations['1']) ? $denominations['1'] : 0;

            $stmt = $conn->prepare("insert into denominations(`thousands`, `five_hundreds`, `two_hundreds`, `hundreds`, `fifties`, `twenties`, `tens`, `fives`, `ones`, `date_id`) values(?,?,?,?,?,?,?,?,?,?);");
            $stmt->bind_param("iiiiiiiiis", $thousands, $five_hundreds, $two_hundreds, $hundreds, $fifties, $twenties, $tens, $fives, $ones, $date_id);
            $stmt->execute();

            $conn->close();
            $stmt->close();
        }
    }
?>