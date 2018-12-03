<?php 
    class OrderAdmin extends Order {
        public $order_id;
        public $user_id;
        public $pro_id;
        public $quanity;
        public $date;
        public $paid;
        public $delivery;

        public function get_all_orders_with_no_status() {
            global $database;

            $sql = "SELECT * FROM orders WHERE paid = 'no' AND delivery = 'no' ORDER BY id DESC";

            return $database->query($sql);
        }


        public function get_all_orders_with_yes_status() {
            global $database;

            $sql = "SELECT * FROM orders WHERE paid = 'yes' AND delivery = 'yes' ORDER BY id DESC";

            return $database->query($sql);
        }

        public function get_all_orders() {
            global $database;

            $sql = "SELECT * FROM orders  ORDER BY id DESC";

            return $database->query($sql);
        }
    }

    $order_admin = new OrderAdmin();
?>