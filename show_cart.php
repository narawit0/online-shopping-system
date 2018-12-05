<?php include("includes/header.php"); ?>
<?php 
    if(isset($_POST['action'])) {
        if($_POST['action'] == "save-change") {
            $pro_id = $_POST['item_id'];
            $quanity = $_POST['quanity'];
    
            $product_result = Product::check_products_quanity($pro_id);
    
            $row = mysqli_fetch_assoc($product_result);
            $product_quanities = $row['quanity'];
    
            $cart->pro_id = $pro_id;
            $cart->quanity = $quanity;
            $cart->user_id = $_SESSION['id'];
            $cart_old_result = $cart->check_cart_quanities_before_update();
            $row = mysqli_fetch_assoc($cart_old_result);
            $old_cart_quanities = $row['quanity'];
    
            $cart_result = $cart->check_cart_products_quanity();
            $row = mysqli_fetch_assoc($cart_result);
            $cart_quanities = $row['quanity'];
            
            if(($quanity - $old_cart_quanities) + $cart_quanities <= $product_quanities) {
                if($cart->update_quanities_cart_by_id()) {
                    header("Location: show_cart.php");
                } else {
                    $message = "มีบางอย่างผิดพลาดกรุณาตรวจสอบอีกครั้ง";
                }
            } else {
                $message = "ไม่สามารถเพิ่มจำนวนสินค้ามากกว่านี้";
            }
        } elseif ($_POST['action']  == "delete") {
            $cart->pro_id = $_POST['item_id'];
            $cart->user_id = $_SESSION['id'];

            if($cart->delete_product_in_cart()) {
                header("Location: show_cart.php");
            }

        } elseif ($_POST['action'] == 'clear' ) {
            $cart->user_id = $_SESSION['id'];
            $cart->clear_cart();
        }
    }

?>
<main class="show-cart">
    <div class="container">
            <?php if(isset($message)) {
                echo "<div class='warning-message'>";
                echo $message;
                echo "</div>";
            }
            ?>
        <table class="show-cart--table">
        <thead>
        <tr>
            <th>ลำดับ</th>
            <th>ชื่อสินค้า</th>
            <th>จำนวน</th>
            <th>ราคาสินค้า</th>
            <th>แก้ไข</th>
        </tr>
        </thead>
        <tbody>
<?php 
    $cart = new Cart();
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
        echo "<td><input type='number' min='1' value='{$row['quanity']}'></td>";
        echo "<td>" . number_format($price) . "</td>";
        echo "<td>
             <button class='save-change' data-id='{$row['id']}'>บันทึก</button>
             <button class='delete' data-id='{$row['id']}'>ลบ</button>
             </td>";
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
                <td></td>
            </tr>
        </tfoot>
        </table>
        <form id="update-cart" method="POST">
            <input type="hidden" name="action">
            <input type="hidden" name="item_id">
            <input type="hidden" name="quanity">
        </form>
        <?php if(mysqli_num_rows($result) > 0) { ?>
        <div class="button-group">
            <button class="clear-button">ลบสินค้าทั้งหมด</button>
            <button class="order-button">ทำรายการสั่งซื้อ</button>
        </div>
        <?php } ?>
    </div>
</main>
<?php include("includes/footer.php"); ?>
<script type="text/javascript">
    get_cart_count();

    var save_change_button = document.querySelectorAll('.save-change');
    for(var i = 0; i < save_change_button.length; i++) {
        save_change_button[i].addEventListener('click', function() {
            var item_id = this.getAttribute('data-id');
            var quanity = this.parentNode.parentNode.childNodes[2].childNodes[0].value;
            var form = document.querySelector("form#update-cart");
            form.querySelector("input[name='action']").value = "save-change";
            form.querySelector("input[name='item_id']").value = item_id;
            form.querySelector("input[name='quanity']").value = quanity;
            form.submit();
        })
    }

    var delete_button = document.querySelectorAll('.delete');
    for(var i = 0; i < delete_button.length; i++) {
        delete_button[i].addEventListener('click', function() {
            var item_id = this.getAttribute('data-id');
            var form = document.querySelector("form#update-cart");
            form.querySelector("input[name='action']").value = "delete";
            form.querySelector("input[name='item_id']").value = item_id;
            form.submit();
        })
    }

    var order_button = document.querySelector('.order-button');
    order_button.addEventListener('click', function() {
        var form = document.querySelector("form#update-cart");
        form.action = "order_cust.php";
        form.method = "POST";
        form.submit();
    })

    var clear_button = document.querySelector('.clear-button');
    clear_button.addEventListener('click', function() {
        var form = document.querySelector("form#update-cart");
        form.querySelector("input[name='action']").value = "clear";
        form.submit();
    })

</script>
