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
                                    <img src="../src/assets/images/arrow_back.png" alt="arrow">
                                </div>
                            </a>
                        </div>';
                }
            }
        }
    }
?>