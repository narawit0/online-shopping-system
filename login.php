<?php include("includes/header.php"); ?>
<?php 
    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if(!User::verify_user($username, $password)) {
            $message = "Username or Password is incorrect";
        } else {
            header("Location: index.php");
        }
    }
?>
<div class="container">
    <div class="login-form">
            <?php if(isset($message)) {
                echo "<div class='warning-message'>";
                echo $message;
                echo "</div>";
            }
            ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">ชื่อผู้ใช้</label>
                <input type="text" name="username" class="form-control">
            </div>

            <div class="form-group">
                <label for="password">รหัสผ่าน</label>
                <input type="password" name="password" class="form-control">
            </div>

            <button type="submit" name="login">เข้าสู่ระบบ</button>
        </form>
    </div>
</div>
<?php include("includes/footer.php"); ?>
    
