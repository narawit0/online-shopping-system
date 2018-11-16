<?php 
    class Seller {
        public $username;
        public $bank_number;
        public $bank_account;
        public $bank_name;

        public static function check_is_seller($username) {
            global $database;

            $sql = "SELECT * FROM sellers WHERE username = '{$username}'";
            $result = $database->query($sql);

            return mysqli_num_rows($result);
        }

        public function create_seller() {
            global $database;

            $sql  = "INSERT INTO sellers (username, bank_number, bank_account, bank_name) ";
            $sql .= "VALUES ('{$this->username}', '{$this->bank_number}', '{$this->bank_account}', '{$this->bank_name}')";
            return $database->query($sql);
        }
    }
?>