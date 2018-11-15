<?php 
    class Session {
        function __construct() {
            session_start();
        }

        public function set_user_login_session($user) {
            if($user) {
                $_SESSION['username'] = $user->username;
                $_SESSION['first_name'] = $user->first_name;
                $_SESSION['last_name'] = $user->last_name;
            }
        }


        public function set_user_logout_session() {
            $_SESSION['username'] = "";
            $_SESSION['first_name'] = "";
            $_SESSION['last_name'] = "";
            session_destroy();
        }
    }

    $session = new Session();
?>