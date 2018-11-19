<?php include("init.php"); ?>
    <!-- <?php 
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $product = Product::select_product_by_id($id);
            $row = mysqli_fetch_assoc($product);
        }
    ?> -->
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
            <form action="">
                <input type="number"  value="<?php echo $row['quanity']; ?>">
                <button type="submit">ซื้อเลย</button>
            </form>
        </div>
    </div>

    
