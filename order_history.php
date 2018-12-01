<?php include("includes/header.php"); ?>
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
                while($row = mysqli_fetch_assoc($query_order_details_result)) {
                    $total_price +=  ($row['quanity'] * $row['price']);
            ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['quanity'];?></td>
                        <td><?php echo number_format($row['quanity'] * $row['price']);?></td>
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
            </div> <!-- order-history--cart -->
        </div> <!-- end order-history--block -->
        <?php
            }
        }
        ?>
    </div>
</div>
<?php include("includes/footer.php"); ?>

