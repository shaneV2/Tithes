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
                return "No date added yet";
            }else {
                while ($row = mysqli_fetch_assoc($result)){
                    $start_date = new DateTime($row['start_date']);
                    $end_date = new DateTime($row['end_date']);

                    $formatted = $start_date->format("F, j, Y") . " - " . $end_date->format("F, j, Y");

                    echo '<div class="date">
                            <a href="./date.php">
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