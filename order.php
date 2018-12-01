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

        public function get_last_order_by_user_id() {
            global $database;

            $sql  = "SELECT id FROM orders WHERE user_id = {$this->user_id} ORDER BY id DESC LIMIT 1";

            return $database->query($sql);
        }

        public function get_all_order_by_user_id() {
            global $database;

            $sql = "SELECT * FROM orders WHERE user_id = {$this->user_id}";

            return $database->query($sql);
        }

        public function get_order_details_by_order_id() {
            global $database;

            $sql  = "SELECT t1.* , t2.price, t2.name  FROM order_details AS t1 INNER JOIN products AS t2 ON t1.pro_id = t2.id ";
            $sql .= "WHERE t1.order_id = {$this->order_id}";

            return $database->query($sql);
        }

        public function get_user_details_by_order_id() {
            global $database;

            $sql = "SELECT orders.id, users.first_name, users.last_name, users.email, users.phone, users.address FROM orders INNER JOIN users ON orders.user_id = users.id WHERE orders.id = {$this->order_id}";

            return $database->query($sql);

        }

        public function update_payment_status() {
            global $database;

            $sql = "UPDATE orders SET paid = 'yes' WHERE id = {$this->order_id} AND user_id = {$this->user_id}";

            return $database->query($sql);
        }


    }
?>