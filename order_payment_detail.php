<?php include("includes/header.php"); ?>
<?php   
        $order->user_id = $_SESSION['id'];
        $query_result = $order->get_last_order_by_user_id();
        $row = mysqli_fetch_assoc($query_result);

        $order->order_id = $row['id'];
        $order_result = $order->get_order_details_by_order_id();

        $total_price = 0;

        while($row = mysqli_fetch_assoc($order_result)) {
            $total_price += ($row['price'] * $row['quanity']);
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
                <span class="total-price">จำนวนเงิน: <?php echo number_format($total_price); ?></span>
                <div class="payment-description">
                    <div class="payment-description--title">
                    ทำการโอนเงินเข้าบัญชีตามที่ระบุไว้ด้านล่างนี้
                    </div>
                    <div class="bank-account">
                        <div class="bank-account--scb">
                            <figure class="bank-account--image">
                                <img src="https://lh3.googleusercontent.com/rDGtTFrrEEIhFXBqcF_jGDZbZXdU9DRIVnMZps9AQ_ir-FvV0cQwb54-5UBIh4sdwA=w300-rw" alt="">
                            </figure>
                            <div class="bank-account--text">
                                ธนาคาร: ไทยพาณิชย์ <br>
                                ชื่อบัญชี: นาย นราวิชญ์ แก้วบุญ <br>
                                เลขบัญชี: 408-343-949-2
                            </div>
                        </div>
                        <div class="bank-account--kbank">
                            <figure class="bank-account--image">
                                <img src="https://kasikornbank.com/SiteCollectionDocuments/about/img/logo/logo.png" alt="">
                            </figure>
                            <div class="bank-account--text">
                                ธนาคาร: กสิกรไทย <br>
                                ชื่อบัญชี: นาย นราวิชญ์ แก้วบุญ <br>
                                เลขบัญชี: 243-789-542-4
                            </div>
                        </div>
                        <div class="bank-account--ktb">
                            <figure class="bank-account--image">
                                <img src="data:image/png;base64,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" alt="">
                            </figure>
                            <div class="bank-account--text">
                                ธนาคาร: กรุงไทย <br>
                                ชื่อบัญชี: นาย นราวิชญ์ แก้วบุญ <br>
                                เลขบัญชี: 452-152-687-9
                            </div>
                        </div>
                        <div class="bank-account--bualuang">
                            <figure class="bank-account--image">
                                <img src="http://i0.wp.com/www.businesslineandlife.co.th/wp-content/uploads/2016/06/logo-bbl-2.png?fit=252%2C252" alt="">
                            </figure>
                            <div class="bank-account--text">
                                ธนาคาร: กรุงเทพ <br>
                                ชื่อบัญชี: นาย นราวิชญ์ แก้วบุญ <br>
                                เลขบัญชี: 123-456-789-0
                            </div>
                        </div>
                    </div>
                    <div class="payment-description--footer">
                        จากนั้นให้เข้าไปที่หน้าแจ้งการโอนเงิน แล้วทำการกรอกแบบฟอร์มให้เรียบร้อย
                    </div>
                    <span class="or">or</span>
                    <div class="payment-credit-card">
                        <form name="checkoutForm" method="POST" action="checkout_payment.php">
                            <input type="hidden" name="totalPrice" value="<?php echo $total_price * 100; ?>" />
                            <input type="hidden" name="order_id" value="<?php echo $order->order_id; ?>"/>
                            <script type="text/javascript" src="https://cdn.omise.co/card.js"
                            data-key="<?php echo OMISE_PUBLIC_KEY ?>"
                            data-image="https://arpentechnologies.com/uploads/software-de-gestion-de-supermercados.png"
                            data-frame-label="Online Shopping"
                            data-button-label="Pay now"
                            data-submit-label="Submit"
                            data-amount="<?php echo $total_price * 100; ?>"
                            data-currency="thb"
                            >
                            </script>
                    </div>
                </div>
            </div>
        </div>
    <!--the script will render <input type="hidden" name="omiseToken"> for you automatically-->
</form>
    </div>
</div>
<?php include("includes/footer.php"); ?>