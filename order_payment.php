<?php include("includes/header.php"); ?>
<?php 
    if(isset($_POST['submit'])) {
        $payment->order_id      = $_POST['order_id'];
        $payment->cust_id       = $_SESSION['id'];
        $payment->bank          = $_POST['bank'];
        $payment->amount        = number_format($_POST['amount']);
        $payment->date_transfer = date('Y-m-d H:i', strtotime($_POST['date_transfer']));
    
        $payment->confirm = 'no';
        if($payment->create_payment()) {
            $message = "เราจะทำการตรวจสอบการจ่ายเงินของท่านแล้วจะจัดส่งของให้";
        }
    }
?>
<div class="container">
    <div class="order-payment">
        <div class="order-payment--title">
            แจ้งการโอนเงิน
        </div>
        <?php if(isset($message)) {
            echo "<div class='warning-message'>";
            echo $message;
            echo "</div>";
        }
        ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="order_id">รหัสการสั่งซื้อ</label>
                <select name="order_id" id="" class="form-control"  required>
                <?php 
                    $order->user_id = $_SESSION['id'];
                    $query_order_result = $order->get_all_order_by_user_id();
                    while($row = mysqli_fetch_assoc($query_order_result)) {
                        if($row['paid'] === 'no') {
                    ?>
                        <option value="<?php echo $row['id']?>"><?php echo $row['id']?></option>
                    <?php
                        }
                    }
                ?>
                </select>
            </div>
            <div class="form-group">
                <label for="bank">ธนาคาร</label>
                <select name="bank" id="" class="form-control" required>
                    <option value="scb">ไทยพาณิชย์</option>
                    <option value="ktb">กรุงไทย</option>
                    <option value="kbank">กสิกรไทย</option>
                    <option value="bualuang">กรุงเทพ</option>
                </select>
            </div>
            <div class="form-group">
                <label for="amount">จำนวนเงิน</label>
                <input type="text" name="amount" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="date_transfer">วันเวลาที่โอน</label>
                <input type="datetime-local" name="date_transfer"  class="form-control" required>
            </div>
            <button type="submit" name="submit">บันทึก</button>
        </form>
    </div>
</div>
<?php include("includes/footer.php"); ?>