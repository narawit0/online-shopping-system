<?php include("includes/header.php"); ?>
<?php 
    if(isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];
        $user = User::find_user_by_id($user_id);
    }
?>
<div class="container">
    <section class="order-confirm">
        <div class="order-confirm--title">
            <h4>ยืนยันข้อมูลในการสั่งซื้อ</h4>
        </div>
        <div class="delivery-detail">
            <div class="delivery-detail--title">
                รายละเอียดในการจัดส่งสินค้า
            </div>
            <div class="delivery-detail--description">
                <span class="delivery-detail--description-name">
                    ชื่อ: <?php echo $user->first_name . " " . $user->last_name; ?>
                </span>
                <span class="delivery-detail--description-address">
                    ที่อยู่: <?php echo $user->address; ?>
                </span>
                <span class="delivery-detail--description-phone">
                    เบอร์โทรศัพท์: <?php echo $user->phone; ?>
                </span>
            </div>
        </div>
        <div class="product-detail">
            <div class="product-detail--title">
                รายละเอียดสินค้า
            </div>
            <div class="product-detail--description">
                <table class="show-cart--table">
                    <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อสินค้า</th>
                        <th>จำนวน</th>
                        <th>ราคาสินค้า</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $cart->user_id = $_SESSION['id'];
                            $result = $cart->show_products_in_cart();
                            $i = 1;
                            $total_price = 0;

                            while($row = mysqli_fetch_assoc($result)) {
                                $price = $row['quanity'] * $row['product_price'];
                                $total_price += $price;
                                echo "<tr>";
                                echo "<td>{$i}</td>";
                                echo "<td>{$row['product_name']}</td>";
                                echo "<td>{$row['quanity']}</td>";
                                echo "<td>" . number_format($price) . "</td>";
                                echo "</tr>";
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
            </div>
        </div>
        <button class="confirm-button">ทำรายการสั่งซื้อ</button>
        <form id="confirm-order-form">
            <input type="hidden" name="order_confirm">
        </form>
    </section>
</div>
<?php include("includes/footer.php"); ?>
<script type="text/javascript">
    get_cart_count();

    var confirm_button = document.querySelector('.confirm-button');
    confirm_button.addEventListener('click', function() {
        var form = document.querySelector('form#confirm-order-form');
        form.action = 'order_done.php';
        form.method = 'POST';
        form.submit();
    })
</script>