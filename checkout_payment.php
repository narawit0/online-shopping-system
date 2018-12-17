<?php
include("init.php");

if (isset($_POST['omiseToken'])) {
    $charge = OmiseCharge::create(array('amount'      => $_POST['totalPrice'],
                                        'currency'    => 'thb',
                                        'card'        => $_POST['omiseToken']
                                        )); 
    if($charge['status'] == 'successful') {
        $order->order_id = $_POST['order_id'];
        $order->user_id = $_SESSION['id'];
        $order->update_payment_status();
    }

} 
?>