<?php 
    class Order {
        public $order_id;
        public $user_id;
        public $pro_id;
        public $quanity;
        public $date;
        public $paid;
        public $delivery;

        public function create_order() {
            global $database;

            $sql  = "INSERT INTO orders(user_id, date, paid, delivery) ";
            $sql .= "VALUES({$this->user_id}, now(), 'no', 'no')";

            return $database->query($sql);
        }

        public function create_order_detail() {
            global $database;

            $sql  = "INSERT INTO order_details(order_id, pro_id, quanity) ";
            $sql .= "VALUES({$this->order_id}, {$this->pro_id}, {$this->quanity})";

            return $database->query($sql);
        }

        public function get_order_by_user_id() {
            global $database;

            $sql  = "SELECT id FROM orders WHERE user_id = {$this->user_id}";

            return $database->query($sql);
        }

        public function get_order_details_by_order_id() {
            global $database;

            $sql  = "SELECT t1.id, SUM(t2.price * t1.quanity) AS total_price FROM order_details AS t1 INNER JOIN products AS t2 ON t1.pro_id = t2.id ";
            $sql .= "WHERE t1.order_id = {$this->order_id}";

            return $database->query($sql);
        }
    }
?>