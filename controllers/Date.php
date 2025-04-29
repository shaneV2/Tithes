<?php 
    class Date extends Database {

        public function createDate($start_date, $end_date) {
            $conn = $this->getConnection();
            $smt = $conn->prepare("insert into dates(`start_date`, `end_date`) values(?,?)");
            $smt->bind_param("ss", $start_date, $end_date);
            $smt->execute();

            $conn->close();
        }
    }
?>