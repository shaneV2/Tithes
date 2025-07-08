<?php 
    class Offerings extends Database {
        public function addUserOffering($id, $username, $date_id, $tithes_and_offerings, $denominations){
            $conn = $this->getConnection();
            [$tithes, $mission, $omg, $pledges, $donation] = $tithes_and_offerings;

            // User offers query
            $stmt = $conn->prepare("insert into user_offers(`user_id`, `user_name`, `tithes`, `mission`, `omg`, `pledges`, `donation`, `date_id`) values(?,?,?,?,?,?,?,?);");
            $stmt->bind_param("isiiiiii", $id, $username, $tithes, $mission, $omg, $pledges, $donation, $date_id);
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

            if ($id != null || !empty($id)){
                $total_amount = (($thousands * 1000) + ($five_hundreds * 500) + ($two_hundreds * 200) + ($hundreds * 100) + ($fifties * 50) + ($twenties * 20) + ($tens * 10) + ($fives * 5) + ($ones * 1)) * 0.20;
                $update_savings_stmt = $conn->prepare("update savings inner join members on savings.user_code = members.member_code set savings.amount = savings.amount + ? where members.user_id = ?");
                $update_savings_stmt->bind_param('ii', $total_amount, $id);
                $update_savings_stmt->execute();
                $update_savings_stmt->close(); 
            }

            $conn->close();
            $stmt->close();
        }
    }
?>