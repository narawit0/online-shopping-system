<?php 
    class User {
        public $id;
        public $first_name;
        public $last_name;
        public $username;
        public $password;
        public $email;
        public $phone;
        public $address;
        public $role;
        public $status;
        private $hashed_password;

        public function create_user() {
            global $database;

            $sql =  "INSERT INTO users (first_name, last_name, username, password, email, phone, address, role, status) ";
            $sql .= "VALUES ('{$this->first_name}', '{$this->last_name}', '{$this->username}', '{$this->hashed_password}', ";
            $sql .= "'{$this->email}', '{$this->phone}', '{$this->address}', 'user', 'pending')";

            $database->query($sql);
        }

        public static function find_user_by_id($id) {
            global $database;

            $sql = "SELECT * FROM users WHERE id = {$id}";
            $the_result_array = self::find_by_query($sql);

            return array_shift($the_result_array);

        }

        public function find_by_query($sql) {
            global $database;
            $result_set = $database->query($sql);
            $the_object_array = array();

            while($row = mysqli_fetch_assoc($result_set)) {
                $the_object_array[] = User::instantiation($row);
            }

            return $the_object_array;
        }

        public static function instantiation($the_record) {
            $the_object = new self;

            foreach($the_record as $key => $value) {
                $the_object->$key = $value;
            }

            return $the_object;
        }

        public function check_duplicate_user() {
            global $database;

            $sql = "SELECT * FROM users WHERE username = '{$this->username}' OR email = '{$this->email}'";
            $duplicate_user = $database->query($sql);
            return mysqli_num_rows($duplicate_user);
        }

        public function hashed_password() {
            $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT, array('cost' => 10));
        }

        public static function verify_user($username, $password) {
            global $database;
            global $session;

            $sql = "SELECT * FROM users WHERE username = '{$username}'";
            $the_result_array = self::find_by_query($sql);
            $user_object = array_shift($the_result_array);

            if (password_verify($password, $user_object->password)) {
                $session->set_user_login_session($user_object);
                return true;
            } else {
                return false;
            }
        }

        public function update_user_profile(){
            global $database;

            $sql  = "UPDATE users SET ";
            $sql .= "first_name = '{$this->first_name}', ";
            $sql .= "last_name  = '{$this->last_name}', ";
            $sql .= "password   = '{$this->hashed_password}', ";
            $sql .= "phone      = '{$this->phone}', ";
            $sql .= "address    = '{$this->address}' WHERE id = {$this->id}";

            $database->query($sql);

            return (mysqli_affected_rows($database->connection) == 1) ? true : false;
        }
    }
?>