<?php 
    class Product {
        public $id;
        public $product_name;
        public $product_price;
        public $product_quanity;
        public $product_desc;

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

            $sql  = "INSERT INTO products (seller_id, pro_img_id, name, price, quanity, description) ";
            $sql .= "VALUES({$seller_id}, {$pro_img_id}, '{$this->product_name}', '{$this->product_price}', '{$this->product_quanity}', '{$this->product_desc}')";

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
    }

?>