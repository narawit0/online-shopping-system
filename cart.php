<?php 
    class Cart {
        public $pro_id;
        public $quanity;
        public $user_id;

        public function add_cart() {
            global $database;

            $sql  = "INSERT INTO cart (pro_id, quanity, date_shop, user_id) ";
            $sql .= "VALUES ({$this->pro_id}, {$this->quanity}, now(), {$this->user_id})";

            return $database->query($sql);
        }

        public static function cart_count($id) {
            global $database;

            $sql = "SELECT SUM(quanity) AS total FROM cart WHERE user_id = $id";

            return $database->query($sql);
        }

        public function show_products_in_cart() {
            global $database;

            $sql  = "SELECT products.name AS product_name, products.price AS product_price, cart.quanity AS quanity FROM cart ";
            $sql .= "INNER JOIN products ON cart.pro_id = products.id ";
            $sql .= " WHERE cart.user_id = {$this->user_id} ORDER BY cart.id DESC";

            return $database->query($sql);
        }
    }

?>