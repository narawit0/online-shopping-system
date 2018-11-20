<?php include("init.php"); ?>
    <?php 
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $product = Product::select_product_by_id($id);
            $row = mysqli_fetch_assoc($product);
        }

        // if(isset($_POST['buy'])) {
        //     // $quanity = $_POST['quanity'];
        //     // $result = Product::check_products_quanity($id);
        //     // echo var_dump($quanity);
        //     // $row = mysqli_fetch_assoc($result);

        //     // $product_quanities = $row['quanity'];

        //     // if ($quanity <= $product_quanities) {
        //     //     echo "<script type='text/javascript'> ";
        //     //     echo "add_product_to_cart($id, $quanity); ";
        //     //     echo "</script>";
        //     // } else {
        //     //     echo '<script type="text/javascript">',
        //     //         'alert("Helloworld");',
        //     //         '</script>'
        //     //     ;
        //     // }

        //     echo '<script type="text/javascript">',
        //             'alert("Helloworld");',
        //             '</script>'
        //         ;

        // }
    ?>
    <div id="product-popup">
        <div class="product-popup--header">
            <h4 class="product-popup--heading">รายละเอียดสินค้า</h4>
            <span class="product-popup--close" onclick="close_popup()">&times;</span>
        </div>
        <div class="product-popup--detail">
            <figure class="product-popup--image">
                <img src="<?php echo "." . DS . "images" . DS . $row['image']; ?>" alt="">
            </figure>
            <div class="product-popup--text">
                <span class="product-popup--title">ชื่อสินค้า: <?php echo $row['name']; ?></span>
                <div class="product-popup--description">
                คำอธิบายสินค้า: 
                <?php echo $row['description']; ?>
                </div>
                <span class="product-popup--price">
                ราคา: <?php echo $row['price']; ?> บาท
                </span>
            </div>
        </div>
        <div class="product-popup--footer">
            <form action="add_cart.php" method="POST">
                <input type="number" name="quanity">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button type="submit" name="buy">ซื้อเลย</button>
            </form>
        </div>
    </div>

    
