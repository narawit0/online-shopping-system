<?php include("init.php"); ?>
<?php 
    if(isset($_POST['id']) && isset($_POST['quanity'])) {
        $cart = new Cart();
        $cart->pro_id = $_POST['id'];
        $cart->quanity = $_POST['quanity'];
        $cart->user_id = $_SESSION['id'];

        if($cart->add_cart()) {
            echo "DONE";
        }
    }
?>
