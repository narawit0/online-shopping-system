<?php include("init.php"); ?>
<?php 
    if(isset($_POST['id']) && isset($_POST['quanity']) && isset($_SESSION['id'])) {
        $cart = new Cart();
        $cart->pro_id = $_POST['id'];
        $cart->quanity = $_POST['quanity'];
        $cart->user_id = $_SESSION['id'];

        $quanity_result = Product::check_products_quanity($cart->pro_id);

        $row = mysqli_fetch_assoc($quanity_result);

        $product_quanities = $row['quanity'];

        if ($cart->quanity <= $product_quanities) {
            $cart->add_cart();
        } else {
            echo "จำนวนสินค้ามีไม่เพียงพอ";
        }

    } else {
        echo "กรุณาเข้าสู่ระบบก่อนทำรายการสั่งซื้อ";
    }
?>
