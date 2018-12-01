<?php 
    class Seller {
        public $username;
        public $bank_number;
        public $bank_account;
        public $bank_name;
        public $status;

        public static function check_is_seller($username) {
            global $database;

            $sql = "SELECT * FROM sellers WHERE username = '{$username}' AND status = 'approved'";
            $result = $database->query($sql);

            return mysqli_num_rows($result);
        }

        public function create_seller() {
            global $database;

            $sql  = "INSERT INTO sellers (username, bank_number, bank_account, bank_name, status) ";
            $sql .= "VALUES ('{$this->username}', '{$this->bank_number}', '{$this->bank_account}', '{$this->bank_name}', 'pending')";
            return $database->query($sql);
        }

        public function find_by_query($sql) {
            global $database;
            $result_set = $database->query($sql);
            $the_object_array = array();

            while($row = mysqli_fetch_assoc($result_set)) {
                $the_object_array[] = Seller::instantiation($row);
            }

            return $the_object_array;
        }
    }
?>