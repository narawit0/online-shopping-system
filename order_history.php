<?php include("includes/header.php"); ?>
<?php 
    if(isset($_POST['order_id'])) {
        $order->order_id = $_POST['order_id'];
        $query_remove_order_result = $order->get_order_details_by_order_id();
        if($order->delete_order()) {
            $order->delete_order_details_by_order_id();
            while($row = mysqli_fetch_assoc($query_remove_order_result)) {
                $product->id = $row['pro_id'];
                $product->product_quanity = $row['quanity'];
                $product->increase_product_quanity_in_stock();
            }
        }
    }
?>
<div class="container">
    <div class="order-history">
        <div class="order-history--title">
            ประวัติการสั่งซื้อของคุณ
        </div>
        <?php 
        if(isset($_SESSION['id'])) {
            $order->user_id = $_SESSION['id'];
            $query_order_id_result = $order->get_all_order_by_user_id();

            while($row = mysqli_fetch_assoc($query_order_id_result)) {
                $order->order_id = $row['id'];
        ?>
        <div class="order-history--block">
            <div class="order-history--header">
                <span class="order-history--id">
                    หมายเลขรหัสการสั่งซื้อ: <?php echo $order->order_id; ?>
                </span>
                <span class="order-history--paid">
                    สถานะการจ่ายเงิน: <?php echo $row['paid']; ?>
                </span>
                <span class="order-history--delivery">
                    สถานะการส่งของ: <?php echo $row['delivery']; ?>
                </span>
            </div>
            <div class="order-history--cart">
                <table class="show-cart--table show-cart--table--order">
                    <thead>
                        <tr>
                            <td>ลำดับ</td>
                            <td>ชื่อสินค้า</td>
                            <td>จำนวนสินค้า</td>
                            <td>ราคาสินค้า</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php 
                $total_price = 0;
                $i = 1;
                $query_order_details_result = $order->get_order_details_by_order_id();
                while($order_row = mysqli_fetch_assoc($query_order_details_result)) {
                    $total_price +=  ($order_row['quanity'] * $order_row['price']);
            ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $order_row['name'];?></td>
                        <td><?php echo $order_row['quanity'];?></td>
                        <td><?php echo number_format($order_row['quanity'] * $order_row['price']);?></td>
                    </tr>
            <?php
                $i++;
                }
            ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td>รวมทั้งหมด</td>
                        <td></td>
                        <td><?php echo number_format($total_price); ?></td>
                    </tr>
                </tfoot>
            </table>
            <?php 
                if($row['paid'] == 'no') {
            ?>
                <button class="order-button--cancle" data-id=<?php echo $row['id']; ?>>ยกเลิกการสั่งซื้อ</button>
            <?php
                }
                ?>
            </div> <!-- order-history--cart -->
        </div> <!-- end order-history--block -->
        <?php
            }
        }
        ?>
    </div>
</div>
<form id="order-form" method="POST">
    <input type="hidden" name="order_id">
</form>
<?php include("includes/footer.php"); ?>
<script type="text/javascript">
    var cancle_button = document.querySelectorAll('.order-button--cancle');
    for(var i = 0; i < cancle_button.length; i++) {
        cancle_button[i].addEventListener('click', function() {
            var order_id = this.getAttribute('data-id');
            var form = document.getElementById('order-form');
            form.querySelector("input[name='order_id']").value = order_id;
            form.submit();
        });
    }
</script>

