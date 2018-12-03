<?php include("includes/header.php"); ?>
<?php 
    if(isset($_POST['order_id'])) {
        $order->order_id = $_POST['order_id'];
        $order->update_delivery_status();
    }
?>
<div class="container">
<main class="show-delivery">
    <div class="show-delivery--title">
        <h4>รายการการส่งของ</h4>
    </div>
<?php 
    /* GET SELLER ID */
    $seller->username = $_SESSION['username'];
    $seller_result = $seller->get_seller_id();
    $row = mysqli_fetch_assoc($seller_result);

    $seller_id = $row['id'];
    /* QUERY ORDER BY SELLER ID */
    $order_result = $order->get_orders_by_seller_id($seller_id);
    while($row = mysqli_fetch_assoc($order_result)) {
        $order->order_id = $row['id'];
        $user_result =  $order->get_user_details_by_order_id();
        $result_row = mysqli_fetch_assoc($user_result);
?>      
    <div class="orders">
        <button class="delivered-button" data-id="<?php echo $row['id']; ?>">ส่งของแล้ว</button>
        <div class="user-details">
            <span class="user-details--order-id">
                รหัสการสั่งซื้อ: <?php echo $row['id']; ?>
            </span>
            <span class="user-details--name">
                 ชื่อ: <?php echo $result_row['first_name'] . " " . $result_row['last_name']; ?>
            </span>
            <span class="user-details--phone">
                เบอร์โทรศัพท์: <?php echo $result_row['phone']; ?>
            </span>
            <span class="user-details--address">
                ที่อยู่: <?php echo $result_row['address']; ?>
            </span>
        </div>
        <table class="show-delivery--table">
            <thead>
                <tr>
                    <td>ลำดับ</td>
                    <td>ชื่อสินค้า</td>
                    <td>จำนวน</td>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $order_details_result = $order->get_order_details_by_order_id();
                    $i = 1;
                    while($order_row = mysqli_fetch_assoc($order_details_result)) {
                            if($order_row['seller_id'] == $seller_id) {
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $order_row['name']; ?></td>
                            <td><?php echo $order_row['quanity']; ?></td>
                        </tr>
                        
                    <?php
                            $i++;
                            }
                        }
                    ?>
            </tbody>
        </table>
        </div>
<?php
    }
?>
<form id="delivered-form" method="POST">
    <input type="hidden" name="order_id">
</form>
</main>
</div>
<?php include("includes/footer.php"); ?>
<script type="text/javascript">
    get_cart_count();

    var delivered_button = document.querySelectorAll('.delivered-button');
    for(var i = 0; i < delivered_button.length; i++) {
        delivered_button[i].addEventListener('click', function() {
            var order_id = this.getAttribute('data-id');
            var form = document.querySelector("form#delivered-form");
            form.querySelector("input[name='order_id']").value = order_id;
            form.submit();
        })
    }
</script>
