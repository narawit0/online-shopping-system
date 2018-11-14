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

        public function create_user() {
            global $database;

            $sql =  "INSERT INTO users (first_name, last_name, username, password, email, phone, address, role, status) ";
            $sql .= "VALUES ('{$this->first_name}', '{$this->last_name}', '{$this->username}', '{$this->password}', ";
            $sql .= "'{$this->email}', '{$this->phone}', '{$this->address}', 'user', 'pending')";

            $database->query($sql);
        }
    }
?>