<?php
    class Database {
        public $connection;

        function __construct() {
            $this->connect();
        }

        private function connect() {
            $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        }

        public function query($sql) {
            $result = mysqli_query($this->connection, $sql);
            $this->confirm_query($result);

            return $result;
        }

        public function escape_string($string) {
            $escape_string = mysqli_real_escape_string($string);

            return $escape_string;
        }

        private function confirm_query($result) {
            if(!$result) {
                die("Query Failed " . mysqli_error($this->connection));
            }
        }

        public function the_insert_id() {
            return mysqli_insert_id($this->connection);
        }
    }

    $database = new Database();

?>