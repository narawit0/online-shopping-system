<?php include("includes/header.php"); ?>
<?php if(!$_SESSION['username']) { header("Location: login.php"); }?>
<?php if(Seller::check_is_seller($_SESSION['username']) > 0) {
            header("Location: posting.php");
        } 
?>
<?php 
    if(!Seller::check_duplicate_seller($_SESSION['username'])) {
        if(isset($_POST['register_seller'])) {
            $seller->username = $_SESSION['username'];
            $seller->bank_number = $_POST['bank_number'];
            $seller->bank_account = $_POST['bank_account'];
            $seller->bank_name = $_POST['bank_name'];
    
            if($seller->create_seller()) {
                $message = "กรุณารอการอนุมัติจากแอดมินเว็บไซต์";
            }
        }
    } else {
        $message = "ท่านได้ทำการสมัครเป็นผู้ขายแล้ว กรุณารอการอนุมัติจากแอดมินค่ะ";
    }
?>
<div class="container">
    <div class="seller-form">
            <div class="seller-title">
                <h4>ลงทะเบียนเป็นผู้ขาย</h4>
            </div>
            <?php if(isset($message)) {
                echo "<div class='warning-message'>";
                echo $message;
                echo "</div>";
            }
            ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="bank_number">เลขที่บัญชี</label>
                <input type="text" name="bank_number" class="form-control">
            </div>

            <div class="form-group">
                <label for="bank_account">ชื่อบัญชี</label>
                <input type="text" name="bank_account" class="form-control">
            </div>

            <div class="form-group">
                <label for="bank_name">ธนาคาร</label>
                <input type="text" name="bank_name" class="form-control">
            </div>

            <button type="submit" name="register_seller">ลงทะเบียนผู้ขาย</button>
        </form>
    </div>
</div>
<?php include("includes/footer.php"); ?>
    
