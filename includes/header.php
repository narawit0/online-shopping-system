<?php ob_start(); ?>
<?php require_once("init.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
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
                    <?php if(isset($_SESSION['first_name'])) {
                    ?>
                    <ul>
                        <li class="user--name"><a href="javascript:void(0)">
                        <svg class="icon icon-user">
                                <use xlink:href="img/sprite.svg#icon-user">
                            </svg>
                            <?php echo $_SESSION['first_name']; ?></a>
                            <ul class="dropdown-list">
                                <li><a href="profile.php">Profile</a></li>
                                <li><a href="logout.php">Log out</a></li>
                            </ul>
                        </li>
                    </ul>
                    <?php
                    } else { ?>
                        <a href="register.php" class="user--register">สมัครสมาชิก</a>
                        <span>หรือ</span>
                        <a href="login.php" class="user--register">เข้าสู่ระบบ</a>
                    <?php } ?>
                </div>
            </nav>
        </div>
        <nav class="navigation-2">
            <div class="container">
                <ul class="category">
                    <?php 
                        $categories = Product::select_all_categories();
                        while($row = mysqli_fetch_assoc($categories)) {
                    ?>
                        <li class="category-item"><a href="index.php?cat_id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></li>
                    <?php
                        } 
                    ?>
                </ul>
                <a href="selling.php" class="sell-btn">อยากขาย</a>
            </div>
        </nav>
</header>