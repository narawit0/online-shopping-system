<?php include("includes/header.php"); ?>
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

            $order_result = $order->get_order_details_by_order_id();

            $row = mysqli_fetch_assoc($order_result);
            $total_price = $row['total_price'];

        }
    }
?>
<div class="container">
    <div class="order-done">
        <div class="order-done--title">
            <h4>การทำรายการสั่งซื้อเสร็จสิ้น กรุณาอ่านรายละเอียดการแจ้งการโอนเงินด้านล่าง</h4>
        </div>
        <div class="order-done--detail">
            <div class="order-done--detail--title">
                รายละเอียดการแจ้งการโอนเงิน
            </div>
            <div class="order-done--detail-description">
                <span class="order-id">รหัสการสั่งซื้อ: <?php echo $order->order_id; ?></span>
                <span class="total-price">จำนวนเงิน: <?php echo $total_price; ?></span>
                <div class="payment-description">
                    <div class="payment-description--title">
                    ทำการโอนเงินเข้าบัญชีตามที่ระบุไว้ด้านล่างนี้
                    </div>
                    <div class="bank-account">
                        ธนาคาร: ไทยพาณิชย์ <br>
                        ชื่อบัญชี: นาย นราวิชญ์ แก้วบุญ <br>
                        เลขบัญชี: 408-343-949-2
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>