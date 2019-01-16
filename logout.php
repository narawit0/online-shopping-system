<?php include("includes/header.php"); ?>
<?php 
    User::delete_loggedin_user_when_logout();
    $session->set_user_logout_session();
    header("Location: index.php");
?>