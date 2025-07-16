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
                $update_savings_stmt->bind_param('di', $total_amount, $id);
                $update_savings_stmt->execute();
                $update_savings_stmt->close(); 
            }

            $conn->close();
            $stmt->close();
        }
        
        public function getUserContributions(){
            session_start();
            $id = $_SESSION['user_id'];
            $conn = $this->getConnection();
            $query = "
                select d.*, coalesce(sum(uo.tithes + uo.mission + uo.omg + uo.pledges + uo.donation), 0) as total_amount from user_offers uo
                inner join dates d 
                on uo.date_id = d.id 
                where user_id = ?   
                group by uo.date_id
                order by d.start_date
            ";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if(mysqli_num_rows($result) == 0){
                echo '<p style="text-align: center; margin-top:20px;">No contributions added yet.</p>';
            }else {
                while ($row = mysqli_fetch_assoc($result)){
                    $date_id = $row['id'];
                    $start_date = new DateTime($row['start_date']);
                    $end_date = new DateTime($row['end_date']);

                    $formatted_sd = $start_date->format("F j, Y"); 
                    $formatted_ed = $end_date->format("F j, Y"); 
                    $amount = number_format($row['total_amount']);

                    $formatted = $formatted_sd . " - " . $formatted_ed;
                    echo '<div class="date">
                            <div>
                                <p>'. $formatted .'</p>
                                <p><span>Amount: </span><span>PHP '. $amount .'</span></p>
                            </div>
                        </div>';
                }
            }
            
            $conn->close();
        }

        public function filterUserContribution($month, $year){
            $month_number = date("n", strtotime($month));

            session_start();
            $id = $_SESSION['user_id'];
            $conn = $this->getConnection();
            $query = "
                select d.*, coalesce(sum(uo.tithes + uo.mission + uo.omg + uo.pledges + uo.donation), 0) as total_amount from user_offers uo
                inner join dates d 
                on uo.date_id = d.id 
                where user_id = ? and (MONTH(d.start_date)=? and YEAR(d.start_date)=?)     
                group by uo.date_id
                order by d.start_date
            ";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("iii",$id, $month_number, $year);
            $stmt->execute();
            $result = $stmt->get_result();

            if(mysqli_num_rows($result) == 0){
                echo '<p style="text-align: center; margin-top:20px;">No contributions added yet.</p>';
            }else {
                while ($row = mysqli_fetch_assoc($result)){
                    $date_id = $row['id'];
                    $start_date = new DateTime($row['start_date']);
                    $end_date = new DateTime($row['end_date']);

                    $formatted_sd = $start_date->format("F j, Y"); 
                    $formatted_ed = $end_date->format("F j, Y"); 
                    $amount = number_format($row['total_amount']);

                    $formatted = $formatted_sd . " - " . $formatted_ed;
                    echo '<div class="date">
                            <div>
                                <p>'. $formatted .'</p>
                                <p><span>Amount: </span><span>PHP '. $amount .'</span></p>
                            </div>
                        </div>';
                }
            }
            
            $conn->close();
        }
    }
?>