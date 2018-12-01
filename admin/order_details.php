<?php include("includes/header.php"); ?>
<?php if(isset($_GET['order_id'])) {
        $order_admin = new OrderAdmin();
        $order_admin->order_id = $_GET['order_id'];
        $user_result = $order_admin->get_user_details_by_order_id();
        $row = mysqli_fetch_assoc($user_result);
?>
<div class="user-details">
    <span class="user-details--name">
        ชื่อ: <?php echo $row['first_name'] . " " . $row['last_name'];?>
    </span>
    <span class="user-details--email">
        อีเมลล์: <?php echo $row['email'];?>
    </span>
    <span class="user-details--phone">
        เบอร์โทรศัพท์: <?php echo $row['phone'];?>
    </span>
</div>
<table class="admin--table">
    <thead>
        <tr>
            <td>No</td>
            <td>Product</td>
            <td>Price</td>
            <td>Quanity</td>
        </tr>
    </thead>
    <tbody>
<?php 
    $order_details_result = $order_admin->get_order_details_by_order_id();
    $i = 1;
    $total_quanity = 0;
    $total_price = 0;
    while($row = mysqli_fetch_assoc($order_details_result)) {
        $total_price += ($row['price'] * $row['quanity']);
        $total_quanity += $row['quanity'];
?> 
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['quanity']; ?></td>
            <td><?php echo number_format($row['quanity'] * $row['price']); ?></td>
        </tr>
<?php
    $i++;
    }
}
?>
    <tfoot>
        <tr>
            <td></td>
            <td>รวมทั้งหมด</td>
            <td><?php echo $total_quanity; ?></td>
            <td><?php echo number_format($total_price); ?></td>
        </tr>
    </tfoot>
    </tbody>
</table>
<?php include("includes/footer.php"); ?>