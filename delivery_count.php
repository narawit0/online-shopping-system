<?php include("init.php");?>
<?php 
    if(isset($_SESSION['username'])) {
        $seller->username = $_SESSION['username'];
        $seller_result = $seller->get_seller_id();
        $row = mysqli_fetch_assoc($seller_result);

        if(isset($row['id'])) {
            $seller_id = $row['id'];
            $order_result = $order->get_orders_by_seller_id($seller_id);
            $count = 0;
            while($row = mysqli_fetch_assoc($order_result)) {
                $order->order_id = $row['id'];
                $result = $order->get_order_details_by_order_id();
                $count = mysqli_num_rows($result);
            }

            echo $count;
        }
    }

?>