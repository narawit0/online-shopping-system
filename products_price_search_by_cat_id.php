<?php include("init.php"); ?>

<?php 
    if(isset($_GET['price1']) && isset($_GET['price2']) && isset($_GET['cat_id'])) {
        $price1 = (int)$_GET['price1'];
        $price2 = (int)$_GET['price2'];
        $cat_id = (int)$_GET['cat_id'];
        $page   = (int)$_GET['page'];

        $product_ranged_price_by_cat_id = Product::select_products_with_ranged_price_with_limited_by_cat_id($cat_id, $price1, $price2, $page);
        
        $all_products_by_cat_id = Product::select_products_with_ranged_price_by_cat_id($cat_id,$price1, $price2);
        $product_per_page = 9;
        $count_products = mysqli_num_rows($all_products_by_cat_id);
        $pages = ceil($count_products / 9);

        while($row = mysqli_fetch_assoc($product_ranged_price_by_cat_id)) {
            $product_quanities = $row['quanity'];
            $cart->pro_id = $row['id'];
            $cart_result = $cart->check_cart_products_quanity();
    
            if($cart_result) {
                $cart_row = mysqli_fetch_assoc($cart_result);
                $cart_quanities = $cart_row['quanity'];
                $left_in_stock = $product_quanities - $cart_quanities;
            }
        ?>
        <div class="product">
        <figure class="product--image">
            <img src="<?php echo "." . DS . "images" . DS . $row['image']?>" alt="">
        </figure>
        <span class="product--name">ชื่อสินค้า: <?php echo $row['name']?></span>
        <span class="product--price">ราคา: <?php echo number_format($row['price']); ?> บาท</span>
        <?php if($left_in_stock > 0) { ?>
        <span class="product--quanity product--quanity--exist">จำนวนสินค้า: <?php echo $left_in_stock; ?> ชิ้น</span>
        <?php } else { ?>
            <span class="product--quanity product--quanity--not-exist">จำนวนสินค้า: <?php echo $left_in_stock; ?> ชิ้น</span>
        <?php } ?>
        <div class="button-group">
            <a href="javascript:void(0);" class="product--button product--button-detail" onclick="show_product_details(<?php echo $row['id']; ?>)">รายละเอียด</a>
            <a href="javascript:void(0);" class="product--button product--button-buy" onclick="add_product_to_cart(<?php echo $row['id']; ?>)">ซื้อเลย</a>
        </div>
    </div>
<?php
    }
?>
    <div class="pages">
       <?php 
        for($i = 1; $i <= $pages; $i++) {
            if($i == $page) {
                echo "<li><a class='active-link' href='index.php?cat_id=$cat_id&price1=$price1&price2=$price2&page=$i'>$i</a></li>";
            } else {
                echo "<li><a href='index.php?cat_id=$cat_id&price1=$price1&price2=$price2&page=$i'>$i</a></li>";
            }
        }
       ?>
    </div>
<?php
}
?>