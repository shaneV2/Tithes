<?php 
    class Database 
    {    
        private $hostname = "localhost";
        private $username = "root";
        private $password = "";
        private $db = "jrcc_db";

        public function getConnection(){
            $connection = mysqli_connect($this->hostname, $this->username, $this->password, $this->db);

            if (!$connection){
                return "Unable to connect database " . mysqli_error($connection);
            }

            return $connection;
        }
    }
