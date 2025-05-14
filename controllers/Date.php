<?php 
    class Date extends Database {

        public function createDate($start_date, $end_date) {
            $conn = $this->getConnection();
            $smt = $conn->prepare("insert into dates(`start_date`, `end_date`) values(?,?)");
            $smt->bind_param("ss", $start_date, $end_date);
            $smt->execute();
            
            $conn->close();
        }
        
        public function getDates(){
            $conn = $this->getConnection();
            $query = "select * from dates order by id desc";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) == 0){
                echo '<div class="date">
                        <p style="text-align: center; margin-top:20px;">No date added yet.</p>
                    </div>';
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
                                <div class="arrow-icon">
                                    <img src="../src/assets/svg/ellipses.svg" height="100%" width="100%" alt="arrow">
                                </div>
                            </a>
                        </div>';
                }
            }
            
            $conn->close();
        }

        public function getShares($date_id){
            $conn = $this->getConnection();

            $query = "select 
                        SUM(tithes) as tithes_total,
                        SUM(mission) as mission_total,
                        SUM(omg) as omg_total,
                        SUM(pledges) as pledges_total,
                        SUM(donation) as donation_total
                        from user_offers";

            $stmt = $conn->prepare($query);
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
        }
    }
?>