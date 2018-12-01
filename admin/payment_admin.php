<?php 
    class PaymentAdmin extends Payment {
        public $id;
        public $order_id;
        public $cust_id;
        public $bank;
        public $amount;
        public $date_transfer;
        public $confirm;

        public function confirm_payment() {
            global $database;

            $sql = "UPDATE payment SET confirm = 'yes' WHERE id = {$this->id}";

            $database->query($sql);

            return mysqli_affected_rows($database->connection);
        }

        public function delete_payment_by_id() {
            global $database;

            $sql = "DELETE FROM payment WHERE id = {$this->id}";

            return $database->query($sql);
        }

        public function get_all_payments() {
            global $database;

            $sql = "SELECT payment.*, users.first_name, users.last_name FROM payment INNER JOIN users ON payment.cust_id = users.id";

            return $database->query($sql);
        }

        public function get_user_payments() {
            global $database;

            $sql = "SELECT users.*, payment.order_id FROM payment INNER JOIN users ON payment.cust_id = users.id WHERE payment.id = {$this->id}";

            return $database->query($sql);
        }
    }
?>