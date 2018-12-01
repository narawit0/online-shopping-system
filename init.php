<?php 
    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

    defined('SITE_ROOT') ? null : define('SITE_ROOT', DS . 'XAMPP' . DS . 'htdocs' . DS . 'online_shopping');

    require_once("config.php");
    require_once("database.php");
    require_once("session.php");
    require_once("user.php");
    require_once("seller.php");
    require_once("product.php");
    require_once("cart.php");
    require_once("order.php");
    require_once("payment.php");
    require_once("admin/user_admin.php");
    require_once("admin/seller_admin.php");
?>