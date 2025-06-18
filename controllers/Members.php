<?php 
    class Members extends Database {
        public function addMember($id){
            $connection = $this->getConnection();

            $stmt = $connection->prepare("select user_code as code from users where user_code=? or username=?");
            $stmt->bind_param("ss", $id, $id);
            $stmt->execute();

            $result = $stmt->get_result();
            if (mysqli_num_rows($result)> 0){
                try {
                    $code = mysqli_fetch_assoc($result)['code'];
                    $insert_stmt = $connection->prepare("insert into members(member_code) values(?)");
                    $insert_stmt->bind_param("s", $code);
                    $insert_stmt->execute();
                } catch (\Throwable $th) {
                    session_start();
                    $_SESSION['user_exist_error'] = true;
                    $_SESSION['identification'] = $id;
                } finally {
                    if (isset($insert_stmt) && $insert_stmt instanceof mysqli_stmt){
                        $insert_stmt->close();
                    }
                }
            } else {
                session_start();
                $_SESSION['id_not_found_error'] = true;
                $_SESSION['identification'] = $id;
            }

            $connection->close();
            $stmt->close();
        }

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
                            </a>
                            <div class="action-btns">
                                <a href="" class="edit-btn">Edit</a>
                                <button class="delete-btn" type="member" md_id="'. $row['id'] .'">Delete</button>
                            </div>
                        </div>';
                }
            }else {
                echo '<p style="text-align: center; margin-top:20px;">No added tithes and offerings yet.</p>';
            }

            $conn->close();
            $stmt->close();
        }

        public function deleteMemberBasedOnDate($md_id){
            $conn = $this->getConnection();
            $stmt = $conn->prepare('delete from user_offers where id=?');
            $stmt->bind_param('i', $md_id);
            $stmt->execute();

            $denominations_stmt = $conn->prepare('delete from denominations where id=?');
            $denominations_stmt->bind_param('i', $md_id);
            $denominations_stmt->execute();

            $conn->close();
            $stmt->close();
            $denominations_stmt->close();
        }
    }
