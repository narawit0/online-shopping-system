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

            $sql  = "SELECT products.id, products.name AS product_name, products.price AS product_price, cart.quanity AS quanity FROM cart ";
            $sql .= "INNER JOIN products ON cart.pro_id = products.id ";
            $sql .= " WHERE cart.user_id = {$this->user_id} ORDER BY cart.id DESC";

            return $database->query($sql);
        }

        public function check_duplicate_product() {
            global $database;

            $sql = "SELECT * FROM cart WHERE pro_id = {$this->pro_id} AND user_id = {$this->user_id}";

            return mysqli_num_rows($database->query($sql));
        }

        public function update_add_cart() {
            global $database;

            $sql = "UPDATE cart SET quanity = quanity + {$this->quanity} WHERE pro_id = {$this->pro_id}";

            $database->query($sql);
            return mysqli_affected_rows($database->connection);
        }

        public function update_quanities_cart_by_id() {
            global $database;

            $sql = "UPDATE cart SET quanity = {$this->quanity} WHERE pro_id = {$this->pro_id} AND user_id = {$this->user_id}";

            $database->query($sql);
            return mysqli_affected_rows($database->connection);
        }

        public function check_cart_products_quanity() {
            global $database;

            $sql = "SELECT SUM(quanity) AS quanity FROM cart WHERE pro_id = {$this->pro_id}";

            return $database->query($sql);
        }

        public function check_cart_quanities_before_update() {
            global $database;

            $sql = "SELECT * FROM cart WHERE pro_id = {$this->pro_id} AND user_id = {$this->user_id}";

            return $database->query($sql);
        }

        public function delete_product_in_cart() {
            global $database;

            $sql = "DELETE FROM cart WHERE pro_id = {$this->pro_id} AND user_id = {$this->user_id}";

            return $database->query($sql);
        }

        public function clear_cart() {
            global $database;

            $sql = "DELETE FROM cart WHERE user_id = {$this->user_id}";

            return $database->query($sql);
        }
    }

?>