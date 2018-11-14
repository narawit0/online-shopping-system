<?php include("includes/header.php"); ?>
<div class="container">
<div class="register-form">
        <form action="" method="POST">
            <div class="form-group">
                <label for="first_name">ชื่อ</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="last_name">นามสกุล</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="username">ชื่อผู้ใช้</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">รหัสผ่าน</label>
                <input type="password" name="first_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">อีเมลล์</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="address">ที่อยู่</label>
                <textarea name="address" id="" cols="30" rows="10" class="form-control" required></textarea>
            </div>

            <button type="submit" name="submit">สมัครสมาชิก</button>
        </form>
</div>
</div>
<?php include("includes/footer.php"); ?>
    
