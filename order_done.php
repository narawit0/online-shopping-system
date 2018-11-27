<?php include("init.php");?>
<?php 
    if(isset($_SESSION['id']) && isset($_POST['order_confirm'])) {
        $order = new Order();
        $order->user_id = $_SESSION['id'];


        if($order->create_order()) {
            $order->order_id = $database->the_insert_id();

            $cart = new Cart();
            $cart->user_id = $_SESSION['id'];
            $cart_result = $cart->show_products_in_cart();
    
            while($row = mysqli_fetch_assoc($cart_result)) {
                $order->pro_id = $row['id'];
                $order->quanity = $row['quanity'];
                $order->create_order_detail();
            }

            $cart->clear_cart();

            header("Location: order_payment.php");

        }
    }
?>
