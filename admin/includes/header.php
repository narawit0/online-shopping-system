<?php ob_start(); ?>
<?php require_once("../init.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin_styles.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
<div class="header">
    <div class="container">
        <div class="header--logo">
            <h1><a href="index.php">Admin</a></h1>
        </div>
        <div class="header--admin-name">
            <span>John Doe</span>
        </div>
    </div>
</div><!-- End header -->
<?php include("main.php"); ?>   
    
