<?php include("includes/header.php"); ?>
<?php 
    if(isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $user = User::find_user_by_id($id);

    }

    if(isset($_POST['update_profile'])) {
        $user->first_name   = $_POST['first_name'];
        $user->last_name    = $_POST['last_name'];
        $user->phone        = $_POST['phone'];
        $user->address      = $_POST['address'];
        $user->password     = $user->password;

        if(isset($_POST['old_password'])) {
            $old_password = $_POST['old_password'];
            if(password_verify($old_password, $user->password)) {
                if(!empty($_POST['new_password_1']) && !empty($_POST['new_password_2'])) {
                    $new_password_1 = $_POST['new_password_1'];
                    $new_password_2 = $_POST['new_password_2'];
                    if($new_password_1 === $new_password_2) {
                        $user->password = $new_password_1;
                        $user->hashed_password();
                        if($user->update_user_profile()) {
                            $message = "แก้ไขโปรไฟล์เรียบร้อย";
                        } else {
                            $message = "บางอย่างผิดพล่าดสำหรับการแก้ไขโปรไฟล์";
                        }
                    }
                } else {
                    $message = "กรุณากรอกพาสเวิร์ดใหม่ทั้งสองช่องให้ครบ";
                }
            }
        } 

        if(empty($_POST['old_password'])) {
            $user->update_user_profile();
            $message = "แก้ไขโปรไฟล์เรียบร้อย";
        }
    }
?>
<div class="container">
<div class="register-form">
        <div class="register-title">
            <h4>แก้ไขรายละเอียด</h4>
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
                <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>" required>
            </div>

            <div class="form-group">
                <label for="last_name">นามสกุล</label>
                <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>" required>
            </div>

            <div class="form-group">
                <label for="old_password">รหัสผ่านเก่า</label>
                <input type="password" name="old_password"  class="form-control">
            </div>

            <div class="form-group">
                <label for="new_password_1">รหัสผ่านใหม่</label>
                <input type="password" name="new_password_1"  class="form-control" placeholder="ใส่พาสเวิร์ดทั้งสองครั้งให้ตรงกัน">
            </div>

            <div class="form-group">
                <label for="new_password_2">รหัสผ่านใหม่</label>
                <input type="password" name="new_password_2"  class="form-control" placeholder="ใส่พาสเวิร์ดทั้งสองครั้งให้ตรงกัน">
            </div>

            <div class="form-group">
                <label for="phone">โทรศัพท์</label>
                <input type="text" name="phone" class="form-control" value="<?php echo $user->phone; ?>" required>
            </div>

            <div class="form-group">
                <label for="address">ที่อยู่</label>
                <textarea name="address" id="" cols="30" rows="10" class="form-control" required><?php echo $user->address; ?></textarea>
            </div>

            <button type="submit" name="update_profile">อัพเดท</button>
        </form>
</div>
</div>
<?php include("includes/footer.php"); ?>
    
