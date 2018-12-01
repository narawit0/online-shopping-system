<?php 
    class Payment {
        public $order_id;
        public $cust_id;
        public $bank;
        public $amount;
        public $date_transfer;
        public $confirm;

        public function create_payment() {
            global $database;

            $sql  = "INSERT INTO payment (order_id, cust_id, bank, amount, date_transfer, confirm) ";
            $sql .= "VALUES({$this->order_id}, {$this->cust_id}, '{$this->bank}', '{$this->amount}', '{$this->date_transfer}', '{$this->confirm}')";
            
            return $database->query($sql);
        }
    }

    $payment = new Payment();
?>