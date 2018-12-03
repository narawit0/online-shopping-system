<?php include("includes/header.php"); ?>
<?php 
    if(isset($_POST['add_product'])) {
        $product->product_name        = $_POST['product_name'];
        $product->product_price       = $_POST['product_price'];
        $product->product_quanity     = $_POST['product_quanity'];
        $product->product_desc        = $_POST['product_desc'];
        $product->product_category    = $_POST['product_category'];

        $product->set_file($_FILES['file_upload']);
        $seller->username = $_SESSION['username'];
        $seller_result = $seller->get_seller_id();
        $row = mysqli_fetch_assoc($seller_result);
        $seller_id = $row['id'];

        if($product->upload_product_image()) {
            if($product->create_product_image()) {
                $the_image_id = $database->the_insert_id();
                if($product->create_product($seller_id, $the_image_id)) {
                    header("Location: index.php");
                }
            }
        }
    }
?>
<div class="container">
<div class="posting-form">
        <div class="posting-title">
            <h4>เพิ่มสินค้า</h4>
        </div>
        <?php if(isset($message)) {
            echo "<div class='warning-message'>";
            echo $message;
            echo "</div>";
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file_upload">รูปภาพสินค้า</label>
                <input type="file" name="file_upload" class="form-control">
            </div>
            <div class="form-group">
                <label for="product_name">ชื่อสินค้า</label>
                <input type="text" name="product_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="product_price">ราคาสินค้า</label>
                <input type="text" name="product_price" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="product_quanity">จำนวนสินค้า</label>
                <input type="number" name="product_quanity" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="product_desc">คำอธิบายสินค้า</label>
                <textarea id="" cols="30" rows="10" name="product_desc" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <select name="product_category" id="" class="form-control">
                <?php 
                    $categories = Product::select_all_categories(); 
                    while($row = mysqli_fetch_assoc($categories)) {
                        echo "<option value='$row[id]'>{$row[name]}</option>";
                    }
                ?>
                </select>
            </div>

            <button type="submit" name="add_product">เพิ่มสินค้า</button>
        </form>
</div>
</div>
<?php include("includes/footer.php"); ?>
    
