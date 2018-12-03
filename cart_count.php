<?php include("init.php"); ?>
<?php 
    if(isset($_SESSION['id'])) {
        $quanity = Cart::cart_count($_SESSION['id']);

        $row = mysqli_fetch_assoc($quanity);

        $row['total'] == 0 ? $count = 0 : $count = $row['total'];

        echo $count;
    }
?>