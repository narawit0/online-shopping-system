<?php 
    class SellerAdmin extends Seller {
        public $username;
        public $bank_number;
        public $bank_account;
        public $bank_name;
        public $status;

        public function get_new_seller() {
            global $database;

            $sql = "SELECT sellers.*, users.first_name, users.last_name, users.email, users.phone FROM sellers INNER JOIN users ON sellers.username = users.username WHERE sellers.status = 'pending'";

            return $database->query($sql);
        }
    }
?>