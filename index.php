<?php include("includes/header.php"); ?>
    <header class="header">
        <div class="container">
            <nav class="navigation-1">
                <div class="header--box">
                    <a href="index.php" class="header--logo"><h1>Online Shopping</h1></a>
                </div>
                <div class="search">
                    <form action="" method="POST">
                        <input type="text" class="search--input">
                        <button type="submit" class="search--button">
                            <svg class="icon icon-search">
                                <use xlink:href="img/sprite.svg#icon-search">
                            </svg>
                        </button>
                    </form>
                </div>
                <div class="cart">
                    <svg class="icon icon-cart">
                        <use xlink:href="img/sprite.svg#icon-cart">
                    </svg>
                    <div class="cart--count">
                        <span>10</span>
                    </div>
                </div>
                <div class="user">
                    <a href="register.php" class="user--register">สมัครสมาชิก</a>
                    <span>หรือ</span>
                    <a href="register.php" class="user--register">เข้าสู่ระบบ</a>
                </div>
            </nav>
        </div>
        <nav class="navigation-2">
            <div class="container">
                <ul class="category">
                    <li class="category-item"><a href="">CPU</a></li>
                    <li class="category-item"><a href="">MOUSE</a></li>
                    <li class="category-item"><a href="">KEYBOARD</a></li>
                    <li class="category-item"><a href="">CASE</a></li>
                    <li class="category-item"><a href="">JOY STICK</a></li>
                </ul>
            </div>
        </nav>
    </header>
<?php include("includes/footer.php"); ?>
    
