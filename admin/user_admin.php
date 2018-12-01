<?php 
    class UserAdmin extends User {

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
        public $hashed_password;

        public function find_user_by_status_pending() {
            global $database;

            $sql = "SELECT * FROM users WHERE status = 'pending'";

            $the_result_array = static::find_by_query($sql);

            return $the_result_array;
        }

        public function update_status_new_user() {
            global $database;

            $sql = "UPDATE users SET status = 'approved' WHERE id = {$this->id}";

            $database->query($sql);

            return mysqli_affected_rows($database->connection);
        }

    }
?>