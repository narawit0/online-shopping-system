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

            $sql  = "SELECT t1.* , t2.seller_id, t2.price, t2.name  FROM order_details AS t1 INNER JOIN products AS t2 ON t1.pro_id = t2.id ";
            $sql .= "WHERE t1.order_id = {$this->order_id}";

            return $database->query($sql);
        }

        public function get_user_details_by_order_id() {
            global $database;

            $sql = "SELECT orders.id, users.first_name, users.last_name, users.email, users.phone, users.address FROM orders INNER JOIN users ON orders.user_id = users.id WHERE orders.id = {$this->order_id}";

            return $database->query($sql);

        }

        public function get_all_orders_with_paid_is_yes() {
            global $database;

            $sql = "SELECT * FROM orders WHERE paid = 'yes' AND delivery = 'no' ORDER BY id DESC";

            return $database->query($sql);
        }

        public function update_payment_status() {
            global $database;

            $sql = "UPDATE orders SET paid = 'yes' WHERE id = {$this->order_id} AND user_id = {$this->user_id}";

            return $database->query($sql);
        }

        public function update_delivery_status() {
            global $database;

            $sql = "UPDATE orders SET delivery = 'yes' WHERE id = {$this->order_id}";

            return $database->query($sql);
        }

        public function get_orders_by_seller_id($seller_id) {
            global $database;

            $sql  = "SELECT distinct(t1.id) FROM orders AS t1 INNER JOIN order_details AS t2 ON t1.id = t2.order_id ";
            $sql .= "INNER JOIN products AS t3 ON t2.pro_id = t3.id WHERE t3.seller_id = {$seller_id} AND t1.paid = 'yes' AND t1.delivery = 'no'";

            return $database->query($sql);
        }


    }

    $order = new Order();
?>