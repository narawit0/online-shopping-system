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

        //ถ้าไม่มีสินค้านี้อยู่ในตะกร้าสินค้า
        if(!$cart->check_duplicate_product($cart->user_id)) {
            //ถ้าจำนวนสินค้าที่สั่งซื้อ มีน้อยกว่าหรือเท่ากับในสต๊อค ให้เพิ่มสินค้าลงตะกร้า
            if ($cart->quanity <= $product_quanities) {
                    $cart->add_cart();
            } else {
                echo "จำนวนสินค้ามีไม่เพียงพอ สินค้าคงเหลือจำนวน " . $product_quanities  . "ชิ้น เท่านั้น";
            }
        } elseif ($cart->check_duplicate_product($cart->user_id) > 0) {
            $cart_quanity_result = $cart->check_cart_products_quanity();
            $row = mysqli_fetch_assoc($cart_quanity_result);
            $cart_quanities = $row['quanity'];
            $left_in_stock = $product_quanities - $cart_quanities;
            if ($cart->quanity + $cart_quanities <= $product_quanities) {
                $cart->update_cart();
            } else {
                if($left_in_stock !== 0) {
                    echo "จำนวนสินค้ามีไม่เพียงพอ สินค้าคงเหลือจำนวน " . $left_in_stock  . "ชิ้น เท่านั้น";
                } else {
                    echo "ขอโทษด้วยค่ะ่สินค้าหมดแล้ว";
                }
            }
        }

    } else {
        echo "กรุณาเข้าสู่ระบบก่อนทำรายการสั่งซื้อ";
    }
?>
