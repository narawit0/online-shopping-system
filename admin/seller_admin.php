<?php 
    class SellerAdmin extends Seller {
        public $id;
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

        public function update_seller_status() {
            global $database;

            $sql = "UPDATE sellers SET status = 'approved' WHERE id = {$this->id}";

            $database->query($sql);

            return mysqli_affected_rows($database->connection);
        }

        public function delete_user_by_id() {
            global $database;

            $sql = "DELETE FROM sellers WHERE id = {$this->id}";

            return $database->query($sql);
        }
    }
?>