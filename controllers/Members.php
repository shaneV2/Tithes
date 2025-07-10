<?php 
    class Members extends Database {
        public function addMember($id){
            if ($id == "" || $id == null){
                return;
            }

            $connection = $this->getConnection();

            $stmt = $connection->prepare("select id as user_id, user_code as code, firstname, lastname from users where user_code=? or username=?");
            $stmt->bind_param("ss", $id, $id);
            $stmt->execute();

            $result = $stmt->get_result();
            if (mysqli_num_rows($result)> 0){
                try {
                    $row = mysqli_fetch_assoc($result);
                    $user_id = $row['user_id'];
                    $code = $row['code'];
                    $fullname = $row['firstname'] . " " . $row['lastname'];
                    $insert_stmt = $connection->prepare("insert into members(user_id, member_code, fullname) values(?,?,?)");
                    $insert_stmt->bind_param("iss", $user_id, $code, $fullname);
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
            $stmt = $conn->prepare('select users.*, savings.amount from members inner join users on members.member_code = user_code inner join savings on members.member_code = savings.user_code order by firstname');
            $stmt->execute();

            $result = $stmt->get_result();
            if (mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){
                    echo '<div class="member">
                            <div>
                                <div class="member-info-div">
                                    <p>'. $row['firstname'] . " " . $row['lastname'] .'</p>
                                    <p><span>Savings: </span><span>PHP '. number_format($row['amount'], 2) .'</span></p>
                                </div>
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
                $starts_with = "$keyword%";
                $stmt = $connection->prepare("
                    select users.*, savings.amount from users 
                    inner join members on users.id = members.user_id 
                    inner join savings on members.member_code = savings.user_code 
                    where (firstname like ? or lastname like ?) 
                    order by 
                        case 
                            when firstname like ? then 0
                            when lastname like ? then 1
                            else 2
                        end
                    ");
                $stmt->bind_param("ssss", $search, $search, $starts_with, $starts_with);
                $stmt->execute();
                
                $result = $stmt->get_result();
                if (mysqli_num_rows($result)){
                    while ($row = mysqli_fetch_assoc($result)){
                        echo '<div class="member">
                                <div>
                                    <div class="member-info-div">
                                        <p>'. $row['firstname'] . " " . $row['lastname'] .'</p>
                                        <p><span>Savings: </span><span>PHP '. number_format($row['amount'], 2) .'</span></p>
                                    </div>
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
            $stmt = $conn->prepare('select *, coalesce(sum(tithes + mission + omg + pledges + donation), 0) as total_amount from user_offers where date_id = ?  group by id order by id desc');
            $stmt->bind_param('i', $date_id);
            $stmt->execute();

            $result = $stmt->get_result();
            if (mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){
                    echo '<div class="member">
                            <div>
                                <p>'. $row['user_name'] .'</p>
                                <p><span>Amount: </span><span>PHP '. number_format($row['total_amount']) .'</span></p>
                            </div>
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

            // Get user offer amount on specific contribution
            $get_user_amount_stmt = $conn->prepare("select coalesce(sum(tithes + mission + omg + pledges + donation), 0) * 0.2 as total_amount from user_offers where id = ?");
            $get_user_amount_stmt->bind_param("i", $md_id);
            $get_user_amount_stmt->execute();
            $result = $get_user_amount_stmt->get_result();
            $amount = (int) mysqli_fetch_assoc($result)['total_amount']; // user contribution amount
            $get_user_amount_stmt->close();

            // Update savings when user offer is deleted
            $update_savings_stmt = $conn->prepare("update savings inner join members on savings.user_code = members.member_code inner join user_offers on user_offers.user_id = members.user_id set savings.amount = savings.amount - ? where user_offers.id = ?");
            $update_savings_stmt->bind_param("ii", $amount, $md_id);
            $update_savings_stmt->execute();
            $update_savings_stmt->close();

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
            $starts_with = "$user_input%";

            $query = "select * from members
                        where fullname like ? 
                        order by  
                            case 
                                when fullname like ? then 0
                                else 1
                            end
                        limit 5";
            $stmt = $connection->prepare($query);
            $stmt->execute([$search, $starts_with]);

            $result = $stmt->get_result();
            if (mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){
                    echo "<p m_id=". $row['user_id'] .">". $row['fullname'] ."</p>";
                }
            }

            $stmt->close();
            $connection->close();
        }
    }
