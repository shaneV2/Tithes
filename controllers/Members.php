<?php 
    class Members extends Database {
        public function addMember($id){
            if ($id == "" || $id == null){
                return;
            }

            $connection = $this->getConnection();

            $stmt = $connection->prepare("select id as user_id, user_code as code from users where user_code=? or username=?");
            $stmt->bind_param("ss", $id, $id);
            $stmt->execute();

            $result = $stmt->get_result();
            if (mysqli_num_rows($result)> 0){
                try {
                    $row = mysqli_fetch_assoc($result);
                    $user_id = $row['user_id'];
                    $code = $row['code'];
                    $insert_stmt = $connection->prepare("insert into members(user_id, member_code) values(?,?)");
                    $insert_stmt->bind_param("is", $user_id, $code);
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

        public function getAllMembers(){
            $conn = $this->getConnection();
            $stmt = $conn->prepare('select users.* from members inner join users where members.member_code = user_code order by lastname asc');
            $stmt->execute();

            $result = $stmt->get_result();
            if (mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){
                    echo '<div class="member">
                            <div>
                                <p>'. $row['lastname'] . ", " . $row['firstname'] .'</p>
                                <div class="action-btns">
                                    <button class="remove-btn" type="member" md_id="'. $row['id'] .'">Remove</button>
                                </div>
                            </div>
                        </div>';
                }
            }else {
                echo '<p style="text-align: center; margin-top:20px;">No added members yet.</p>';
            }

            $conn->close();
            $stmt->close();
        }

        public function searchMember($keyword){
            try {
                $connection = $this->getConnection();

                $search = "%$keyword%";
                $stmt = $connection->prepare("select users.* from users inner join members on users.id = members.user_id where (firstname like ? or lastname like ?) order by lastname");
                $stmt->bind_param("ss", $search, $search);
                $stmt->execute();
                
                $result = $stmt->get_result();
                if (mysqli_num_rows($result)){
                    while ($row = mysqli_fetch_assoc($result)){
                        echo '<div class="member">
                                <div>
                                    <p>'. $row['lastname'] . ", " . $row['firstname'] .'</p>
                                    <div class="action-btns">
                                        <button class="remove-btn" type="member" md_id="'. $row['id'] .'">Remove</button>
                                    </div>
                                </div>
                            </div>';
                    }
                }else {
                    echo '<p style="text-align: center; margin-top:20px;">Member not found.</p>';
                }
            } catch (\Throwable $th) {
                return;
            } finally {
                if (isset($connection) && $connection instanceof mysqli){
                    $connection->close();
                }
                
                if (isset($stmt) && $stmt instanceof mysqli_stmt){
                    $stmt->close();
                }
            }
        }

        public function removeMember($id){
            $conn = $this->getConnection();
            try {
                $stmt = $conn->prepare('delete from members where user_id=?');
                $stmt->bind_param("i", $id);
                $stmt->execute();
            } catch (\Throwable $th) {
                return;
            } finally {
                if (isset($conn) && $conn instanceof mysqli){
                    $conn->close();
                }
                
                if (isset($stmt) && $stmt instanceof mysqli_stmt){
                    $stmt->close();
                }
            }
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

        public function getMembersOnUserInputForNameSuggestion($user_input){
            $connection = $this->getConnection();

            $search = "%$user_input%";
            $stmt = $connection->prepare("select users.* from users inner join members on users.user_code = members.member_code where (firstname like ? or lastname like ?) order by lastname");
            $stmt->bind_param("ss", $search, $search);
            $stmt->execute();

            $result = $stmt->get_result();
            if (mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){
                    echo "<p>". $row['lastname'] . ", ". $row['firstname'] ."</p>";
                }
            }

            $stmt->close();
            $connection->close();
        }
    }
