<?php 
    class Product {
        public $id;
        public $product_name;
        public $product_price;
        public $product_quanity;
        public $product_desc;
        public $product_category;

        public $product_file_name;
        public $product_file_type;
        public $product_file_size;
        public $product_file_tmp_name;

        public $upload_folder = "images";

        public function set_file($file) {
            $this->product_file_name     = $file['name'];
            $this->product_file_type     = $file['type'];
            $this->product_file_size     = $file['size'];
            $this->product_file_tmp_name = $file['tmp_name'];
        }

        public function create_product($seller_id, $pro_img_id) {
            global $database;

            $sql  = "INSERT INTO products (seller_id, pro_img_id, name, price, quanity, description, cat_id) ";
            $sql .= "VALUES({$seller_id}, {$pro_img_id}, '{$this->product_name}', '{$this->product_price}', '{$this->product_quanity}', '{$this->product_desc}', {$this->product_category})";

            return $database->query($sql);
        }

        public function upload_product_image() {
            $target_path = SITE_ROOT . DS . $this->upload_folder . DS . $this->product_file_name;
            $tmp_path = $this->product_file_tmp_name;;

            if(move_uploaded_file($tmp_path, $target_path)) {
                return true;
            }
        }

        public function  create_product_image() {
            global $database;
 
            $sql  =  "INSERT INTO product_images (image, type, size) ";
            $sql .= "VALUES ('{$this->product_file_name}', '{$this->product_file_type}', '{$this->product_file_size}')";

            return $database->query($sql);
        }

        public static function select_all_categories() {
            global $database;

            $sql = "SELECT * FROM categories";
            return $database->query($sql);
        }

        public static function select_products_limited($page) {
            global $database;
            
            $per_page = 9;
            if($page == "" || $page == 1) {
                $page_start = 0;
            } else {
                $page_start = ($page * $per_page) - $per_page;
            }

            $sql = "SELECT products.id, products.name, products.price, products.quanity, product_images.image FROM products INNER JOIN product_images ON products.pro_img_id = product_images.id LIMIT $page_start , $per_page";

            return $database->query($sql);
        }

        public static function select_all_products() {
            global $database;
            
            $sql = "SELECT products.id, products.name, products.price, products.quanity, product_images.image FROM products INNER JOIN product_images ON products.pro_img_id = product_images.id";

            return $database->query($sql);
        }

        public static function select_products_by_cat_id($id) {
            global $database;

            $sql = "SELECT products.id, products.name, products.quanity, products.price, product_images.image FROM products INNER JOIN product_images ON products.pro_img_id = product_images.id WHERE products.cat_id = {$id}";

            return $database->query($sql);
        }

        public static function select_product_by_id($id) {
            global $database;

            $sql = "SELECT products.id, products.name, products.quanity, products.description, products.price, product_images.image FROM products INNER JOIN product_images ON products.pro_img_id = product_images.id WHERE products.id = {$id}";

            return $database->query($sql);
        }

        public function check_products_quanity($id) {
            global $database;

            $sql = "SELECT quanity FROM products WHERE id = $id";

            return $database->query($sql);
        }

        public function decrease_product_quanity_in_stock() {
            global $database;

            $sql = "UPDATE products SET quanity = quanity - {$this->product_quanity} WHERE id = {$this->id}";

            $database->query($sql);

            return mysqli_affected_rows($database->connection);
        }

        public function increase_product_quanity_in_stock() {
            global $database;

            $sql = "UPDATE products SET quanity = quanity + {$this->product_quanity} WHERE id = {$this->id}";

            $database->query($sql);

            return mysqli_affected_rows($database->connection);
        }
    }

    $product = new Product();

?>