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

            $delete_date_stmt = $connection->prepare("delete from dates where id=?");
            $delete_date_stmt->bind_param("i", $date_id);
            $delete_date_stmt->execute();

            $delete_user_offer_stmt = $connection->prepare("delete from user_offers where date_id=?");
            $delete_user_offer_stmt->bind_param("i", $date_id);
            $delete_user_offer_stmt->execute();

            $delete_denominations_stmt = $connection->prepare("delete from denominations where date_id=?");
            $delete_denominations_stmt->bind_param("i", $date_id);
            $delete_denominations_stmt->execute();

            $delete_date_stmt->close();
            $delete_user_offer_stmt->close();
            $delete_denominations_stmt->close();
            $connection->close();
        }
        
        public function getDates(){
            $conn = $this->getConnection();
            $query = "select * from dates order by id desc";
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

                    $formatted = $formatted_sd . " - " . $formatted_ed;
                    echo '<div class="date">
                            <a href="./date.php?d_id='. $date_id .'&start_date='. $formatted_sd .'&end_date='. $formatted_ed .'">
                                <p>'. $formatted .'</p>
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
            $stmt = $conn->prepare("select * from dates where MONTH(start_date)=? and YEAR(start_date)=? group by start_date asc");
            $stmt->bind_param("ii", $month_number, $year);
            $stmt->execute();

            $result = $stmt->get_result();
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $date_id = $row['id'];
                    $start_date = new DateTime($row['start_date']);
                    $end_date = new DateTime($row['end_date']);

                    $formatted_sd = $start_date->format("F j, Y"); 
                    $formatted_ed = $end_date->format("F j, Y"); 

                    $formatted = $formatted_sd . " - " . $formatted_ed;
                    echo '<div class="date">
                            <a href="./date.php?d_id='. $date_id .'&start_date='. $formatted_sd .'&end_date='. $formatted_ed .'">
                                <p>'. $formatted .'</p>
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
                    <td>'. ($thousands ?? 0) .'</td>
                    <td>'. $thousands_total .'</td>
                </tr>
                <tr>
                    <td>500</td>
                    <td>'. ($five_hundreds ?? 0) .'</td>
                    <td>'. $five_hundreds_total .'</td>
                </tr>
                <tr>
                    <td>200</td>
                    <td>'. ($two_hundreds ?? 0).'</td>
                    <td>'. $two_hundreds_total .'</td>
                </tr>
                <tr>
                    <td>100</td>
                    <td>'. ($hundreds ?? 0) .'</td>
                    <td>'. $hundreds_total .'</td>
                </tr>
                <tr>
                    <td>50</td>
                    <td>'. ($fifties ?? 0) .'</td>
                    <td>'. $fifties_total .'</td>
                </tr>
                <tr>
                    <td>20</td>
                    <td>'. ($twenties ?? 0) .'</td>
                    <td>'. $twenties_total .'</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>'. ($tens ?? 0) .'</td>
                    <td>'. $tens_total .'</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>'. ($fives ?? 0) .'</td>
                    <td>'. $fives_total .'</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>'. ($ones ?? 0) .'</td>
                    <td>'. $ones_total .'</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Total</td>
                    <td>'. ($total ?? 0) .'</td>
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
                
                $total_share = $row['tithes_total'] + $row['mission_total'] + $row['omg_total'] + $row['pledges_total'] + $row['donation_total'];
                $pastor_share = $total_share / 4;
            }   
            echo '<table>
                    <tr>
                        <th>Pastors</th>
                        <th>Pastor Share</th>
                        <th>Total</th>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>'. $pastor_share .'</td>
                        <td>'. $total_share .'</td>
                    </tr>
                </table>';

            $conn->close();
            $stmt->close();
        }
    }
?>