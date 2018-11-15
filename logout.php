<?php include("includes/header.php"); ?>
<?php 
    $session->set_user_logout_session();
    header("Location: index.php");
?>