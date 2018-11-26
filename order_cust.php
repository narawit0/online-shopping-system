<?php include("includes/header.php"); ?>
<?php 
    if(isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];
        $user = User::find_user_by_id($user_id);
    }

    if(isset($_POST['submit'])) {
        $user->first_name      = $_POST['first_name'];
        $user->last_name       = $_POST['last_name'];
        $user->phone           = $_POST['phone'];
        $user->address         = $_POST['address'];
        $user->hashed_password = $user->password;

        $user->update_user_profile();

        header("Location: order_confirm.php");
    }
?>
<div class="container">
    <section class="order-customer">
    <div class="order-customer--title">
            <h4>ยืนยันข้อมูลในการจัดส่ง</h4>
    </div>
    <form action="" method="POST">
            <div class="form-group">
                <label for="first_name">ชื่อ</label>
                <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>">
            </div>

            <div class="form-group">
                <label for="last_name">นามสกุล</label>
                <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>">
            </div>

            <div class="form-group">
                <label for="phone">เบอร์โทรศัพท์</label>
                <input type="text" name="phone" class="form-control" value="<?php echo $user->phone; ?>">
            </div>

            <div class="form-group">
                <label for="address">ที่อยู่สำหรับการจัดส่ง</label>
                <textarea class="form-control" name="address" id="" cols="30" rows="10"><?php echo $user->address; ?></textarea>
            </div>

            <button type="submit" name="submit">ยืนยันข้อมูล</button>
        </form>
    </section>  
</div>
<?php include("includes/footer.php"); ?>
<script type="text/javascript">
    get_cart_count();
</script>