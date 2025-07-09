<?php 
    class Date extends Database {

        public function createDate($start_date, $end_date) {
            $conn = $this->getConnection();
            $smt = $conn->prepare("insert into dates(`start_date`, `end_date`) values(?,?)");
            $smt->bind_param("ss", $start_date, $end_date);
            $smt->execute();
            
            $conn->close();
        }

        public function deleteDate($date_id){
            $connection = $this->getConnection();

            // Get user id's 
            $get_user_id_stmt = $connection->prepare("select distinct(user_id) from user_offers where date_id= ?");
            $get_user_id_stmt->bind_param("i", $date_id);
            $get_user_id_stmt->execute();
            $user_ids = $get_user_id_stmt->get_result();
            
            // Update user savings
            foreach($user_ids as $row){
                $user_id = $row['user_id'];
                
                $update_saving_stmt = $connection->prepare("
                    UPDATE savings s 
                    INNER JOIN (
                        SELECT 
                            sm.member_code, 
                            uo.user_id,
                            SUM(
                                COALESCE(uo.tithes, 0) + 
                                COALESCE(uo.mission, 0) + 
                                COALESCE(uo.omg, 0) + 
                                COALESCE(uo.pledges, 0) + 
                                COALESCE(uo.donation, 0)
                            ) * 0.2 AS share
                        FROM members sm
                        INNER JOIN user_offers uo ON sm.user_id = uo.user_id
                        WHERE uo.date_id = ?
                        GROUP BY sm.member_code, uo.user_id
                    ) m ON s.user_code = m.member_code
                    SET s.amount = s.amount - m.share
                    WHERE m.user_id = ?
                ");

                $update_saving_stmt->bind_param("ii", $date_id, $user_id);
                $update_saving_stmt->execute();
            }

            // Delete date
            $delete_date_stmt = $connection->prepare("delete from dates where id=?");
            $delete_date_stmt->bind_param("i", $date_id);
            $delete_date_stmt->execute();

            // delete user offers based on date
            $delete_user_offer_stmt = $connection->prepare("delete from user_offers where date_id=?");
            $delete_user_offer_stmt->bind_param("i", $date_id);
            $delete_user_offer_stmt->execute();

            // Delete contribution denomination based on date
            $delete_denominations_stmt = $connection->prepare("delete from denominations where date_id=?");
            $delete_denominations_stmt->bind_param("i", $date_id);
            $delete_denominations_stmt->execute();

            $get_user_id_stmt->close();
            $update_saving_stmt->close();
            $delete_date_stmt->close();
            $delete_user_offer_stmt->close();
            $delete_denominations_stmt->close();
            $connection->close();
        }
        
        public function getDates(){
            $conn = $this->getConnection();
            $query = "select d.*, coalesce(sum(uo.tithes + uo.mission + uo.omg + uo.pledges + uo.donation), 0) 
                        as total_amount from dates as d 
                        left join user_offers as uo on d.id = uo.date_id 
                        group by d.id 
                        order by d.id desc";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) == 0){
                echo '<p style="text-align: center; margin-top:20px;">No date added yet.</p>';
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
                            <a href="./date.php?d_id='. $date_id .'&start_date='. $formatted_sd .'&end_date='. $formatted_ed .'">
                                <p>'. $formatted .'</p>
                                <p><span>Amount: </span><span>PHP '. $amount .'</span></p>
                            </a>
                            <div>
                                <p class="delete-btn" did="'. $date_id .'" type="date">Delete</p>
                            </div>
                        </div>';
                }
            }
            
            $conn->close();
        }

        public function filterDate($month, $year){
            $month_number = date("n", strtotime($month));

            $conn = $this->getConnection();
            $stmt = $conn->prepare("select d.*, coalesce(sum(uo.tithes + uo.mission + uo.omg + uo.pledges + uo.donation), 0) as total_amount from dates as d left join user_offers as uo on d.id = uo.date_id where MONTH(d.start_date)=? and YEAR(d.start_date)=? group by d.id order by start_date asc");
            $stmt->bind_param("ii", $month_number, $year);
            $stmt->execute();

            $result = $stmt->get_result();
            if(mysqli_num_rows($result) > 0){
                session_start();

                $_SESSION['filter_month'] = $month;
                $_SESSION['filter_year'] = $year;

                while($row = mysqli_fetch_assoc($result)){
                    $date_id = $row['id'];
                    $start_date = new DateTime($row['start_date']);
                    $end_date = new DateTime($row['end_date']);

                    $formatted_sd = $start_date->format("F j, Y"); 
                    $formatted_ed = $end_date->format("F j, Y"); 

                    $amount = number_format($row['total_amount']);

                    $formatted = $formatted_sd . " - " . $formatted_ed;
                    echo '<div class="date">
                            <a href="./date.php?d_id='. $date_id .'&start_date='. $formatted_sd .'&end_date='. $formatted_ed .'&fromFilter=true&month='. $month .'&year='. $year .'">
                                <p>'. $formatted .'</p>
                                <p><span>Amount: </span><span>PHP '. $amount .'</span></p>
                            </a>
                            <div>
                                <p class="delete-btn" did="'. $date_id .'" type="date">Delete</p>
                            </div>
                        </div>';
                }
            }else {
                echo '<p style="text-align: center; margin-top:20px;">No date found.</p>';  
            }

            $conn->close();
            $stmt->close();
        }

        public function getDenominationsTotal($date_id){
            $conn = $this->getConnection();

            $query = "select 
                        SUM(thousands) as thousands, 
                        SUM(five_hundreds) as five_hundreds,
                        SUM(two_hundreds) as two_hundreds,
                        SUM(hundreds) as hundreds,
                        SUM(fifties) as fifties,
                        SUM(twenties) as twenties,
                        SUM(tens) as tens,
                        SUM(fives) as fives,
                        SUM(ones) as ones
                        FROM denominations
                        WHERE date_id = ?";

            $stmt = $conn->prepare($query);
            $stmt->bind_param('i', $date_id);
            $stmt->execute();

            // Total number of each denonimation
            $thousands = 0;
            $five_hundreds = 0;
            $two_hundreds = 0;
            $hundreds = 0;
            $fifties = 0;
            $twenties = 0;
            $tens = 0;
            $fives = 0;
            $ones = 0;

            $result = $stmt->get_result();
            if (mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $thousands = $row['thousands'];
                $five_hundreds = $row['five_hundreds'];
                $two_hundreds = $row['two_hundreds'];
                $hundreds = $row['hundreds'];
                $fifties = $row['fifties'];
                $twenties = $row['twenties'];
                $tens = $row['tens'];
                $fives = $row['fives'];
                $ones = $row['ones'];
            }  

            // Total
            $thousands_total = $thousands * 1000;
            $five_hundreds_total = $five_hundreds * 500;
            $two_hundreds_total = $two_hundreds * 200;
            $hundreds_total = $hundreds * 100;
            $fifties_total = $fifties * 50;
            $twenties_total = $twenties * 20;
            $tens_total = $tens * 10;
            $fives_total = $fives * 5;
            $ones_total = $ones * 1;

            $total = $thousands_total + $five_hundreds_total + $two_hundreds_total + $hundreds_total + $fifties_total + $twenties_total + $tens_total + $fives_total + $ones_total;

            echo '<table id="tithes-table">
                <tr>
                    <td>1000</td>
                    <td>'. number_format(($thousands ?? 0)) .'</td>
                    <td>'. number_format($thousands_total) .'</td>
                </tr>
                <tr>
                    <td>500</td>
                    <td>'. number_format(($five_hundreds ?? 0)) .'</td>
                    <td>'. number_format($five_hundreds_total) .'</td>
                </tr>
                <tr>
                    <td>200</td>
                    <td>'. number_format(($two_hundreds ?? 0)).'</td>
                    <td>'. number_format($two_hundreds_total) .'</td>
                </tr>
                <tr>
                    <td>100</td>
                    <td>'. number_format(($hundreds ?? 0)) .'</td>
                    <td>'. number_format($hundreds_total) .'</td>
                </tr>
                <tr>
                    <td>50</td>
                    <td>'. number_format(($fifties ?? 0)) .'</td>
                    <td>'. number_format($fifties_total) .'</td>
                </tr>
                <tr>
                    <td>20</td>
                    <td>'. number_format(($twenties ?? 0)) .'</td>
                    <td>'. number_format($twenties_total) .'</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>'. number_format(($tens ?? 0)) .'</td>
                    <td>'. number_format($tens_total) .'</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>'. number_format(($fives ?? 0)) .'</td>
                    <td>'. number_format($fives_total) .'</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>'. number_format(($ones ?? 0)) .'</td>
                    <td>'. number_format($ones_total) .'</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Total</td>
                    <td>'. number_format(($total ?? 0)) .'</td>
                </tr></table>';
            
            $conn->close();
            $stmt->close();
        }

        public function getShares($date_id){
            $conn = $this->getConnection();

            $query = "select 
                        SUM(tithes) as tithes_total,
                        SUM(mission) as mission_total,
                        SUM(omg) as omg_total,
                        SUM(pledges) as pledges_total,
                        SUM(donation) as donation_total
                        from user_offers where date_id = ?";

            $stmt = $conn->prepare($query);
            $stmt->bind_param('i', $date_id);
            $stmt->execute();
            $result = $stmt->get_result();

            $total_share = 0;
            $pastor_share = 0;
            
            if (mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                
                $total_share = 
                    (float) ($row['tithes_total'] ?? 0) +
                    (float) ($row['mission_total'] ?? 0) +
                    (float) ($row['omg_total'] ?? 0) +
                    (float) ($row['pledges_total'] ?? 0) +
                    (float) ($row['donation_total'] ?? 0);
                $pastor_share = $total_share * 0.20;
                $church_share = $total_share - $pastor_share;
            }   
            echo '<table >
                    <tr>
                        <th colspan="3">Church\'s Share</th>
                        <th>Total</th>
                    </tr>
                    <tr>
                        <td colspan="3">'. number_format($church_share) .'</td>
                        <td rowspan="3">'. number_format($total_share) .'</td>
                    </tr>
                    <tr>
                        <th>Pastors</th>
                        <th>Pastor Share</th>
                        <th>Pastor Share Total</th>
                    </tr>
                    <tr>
                        <td><input type="number" id="input-pastor-number" value="0"></td>
                        <td><p id="pastor_shares">'. number_format($pastor_share) .'</p></td>
                        <td><p id="pastor_shares_total">'. number_format($pastor_share) .'</p></td>
                    </tr>
                </table>';

            $conn->close();
            $stmt->close();
        }
    }
?>