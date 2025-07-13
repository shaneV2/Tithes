<?php 
    class Database 
    {    
        private $hostname = "localhost";
        private $username = "root";
        private $password = "";
        private $db = "cfms_db2";

        public function getConnection(){
            $connection = mysqli_connect($this->hostname, $this->username, $this->password, $this->db);

            if (!$connection){
                return "Unable to connect database " . mysqli_error($connection);
            }

            return $connection;
        }
    }
