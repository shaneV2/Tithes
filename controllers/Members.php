<?php 
    class Members extends Database {
        public function getMembersBasedOnDate($date_id){
            $conn = $this->getConnection();
            $stmt = $conn->prepare('select * from user_offers where date_id = ? order by id desc');
            $stmt->bind_param('i', $date_id);
            $stmt->execute();

            $result = $stmt->get_result();
            if (mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){
                    echo '<div class="member">
                            <a href="">
                                <p>'. $row['user_name'] .'</p>
                                <div class="arrow-icon">
                                    <img src="../src/assets/svg/ellipses.svg" height="100%" width="100%" alt="arrow">
                                </div>
                            </a>
                        </div>';
                }
            }else {
                echo '<div class="member">
                        <p style="text-align: center; margin-top:20px;">No added tithes and offerings from users yet.</p>
                    </div>';
            }

            $conn->close();
            $stmt->close();
        }
    }
