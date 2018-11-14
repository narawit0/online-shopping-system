<?php
    class Database {
        function __construct() {
            $this->connect();
        }

        private function connect() {
            $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        }
    }

    $database = new Database();

?>