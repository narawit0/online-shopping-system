<?php include("init.php"); ?>
<?php 
    $order->order_id = 31;
    $order_result = $order->get_order_details_by_order_id();

    while($row = mysqli_fetch_assoc($order_result)) {
        echo $row['price'];
        echo $row['name'];
    }
?>