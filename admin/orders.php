<?php include("includes/header.php"); ?>
<?php 
    if(isset($_POST['action'])) {
        if($_POST['action'] == "approve") {
            $payment_admin->id = $_POST['id'];
            $payment_admin->confirm_payment();
        } elseif($_POST['action'] == "unapprove") {
            $payment_admin->id = $_POST['id'];
            $payment_admin->delete_payment_by_id();
        }
    }
?>
<table class="admin--table">
    <thead>
        <tr>
            <td>Id</td>
            <td>User Id</td>
            <td>Order Date</td>
            <td>Paid Status</td>
            <td>Delivery Status</td>
            <td>Order Details</td>
        </tr>
    </thead>
    <tbody>
<?php 
    $order_result = $order_admin->get_all_orders();

    while($row = mysqli_fetch_assoc($order_result)) {
?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['paid']; ?></td>
            <td><?php echo $row['delivery']; ?></td>
            <td><button><a href="order_details.php?order_id=<?php echo $row['id']; ?>">ข้อมูลการสั่งซื้อ</a></button></td>
        </tr>
<?php
    }
?>
    </tbody>
</table>
<?php include("includes/footer.php"); ?>