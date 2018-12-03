<?php include("includes/header.php"); ?>
<?php 
    if(isset($_POST['submit'])) {
        $user->first_name   = $_POST['first_name'];
        $user->last_name    = $_POST['last_name'];
        $user->username     = $_POST['username'];
        $user->password     = $_POST['password'];
        $user->email        = $_POST['email'];
        $user->phone        = $_POST['phone'];
        $user->address      = $_POST['address'];


        
        if($user->check_duplicate_user()) {
            $message = "Email หรือ Username นี้ถูกใช้ไปใช้แล้วกรุณากรอกข้อมูลใหม่อีกครั้ง";
        } else {
            $user->hashed_password();
            if($user->create_user()) {
                $message = "Please wait for admin approve";
            }
        }
    }
?>
<div class="container">
<div class="register-form">
        <div class="register-title">
            <h4>สมัครสมาชิก</h4>
        </div>
        <?php if(isset($message)) {
            echo "<div class='warning-message'>";
            echo $message;
            echo "</div>";
        }
        ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="first_name">ชื่อ</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="last_name">นามสกุล</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="username">ชื่อผู้ใช้</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">รหัสผ่าน</label>
                <input type="password" name="password"  class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">อีเมลล์</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone">โทรศัพท์</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="address">ที่อยู่สำหรับการจัดส่งสินค้า</label>
                <textarea name="address" id="" cols="30" rows="10" class="form-control" required></textarea>
            </div>

            <button type="submit" name="submit">สมัครสมาชิก</button>
        </form>
</div>
</div>
<?php include("includes/footer.php"); ?>
    
