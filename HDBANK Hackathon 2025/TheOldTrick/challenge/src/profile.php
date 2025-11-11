<?php

require_once 'config.php';
require_once 'utils.php';

if ( !isset($_SESSION['isAuth']) ||  !( $_SESSION['isAuth'] === true) ) {
    die(header("Location: login.php"));
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once 'views/profile.html';
    die();
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ( empty($_POST['username']) || is_array($_POST['username']) ||
         empty($_POST['quote']) || is_array($_POST['quote']) ||
         empty($_POST['color']) || is_array($_POST['color'])
    ){
        die("username, quote and color are required ! ");
    }

    $_SESSION['username'] = $_POST['username'];
    $_SESSION['quote'] = $_POST['quote'];
    $_SESSION['color'] = $_POST['color'];

    echo '
        Update successfully ! Redirecting to index.php ...
    <script>
        setTimeout(() => {
            window.location.href = "index.php";
        }, 2000);
    </script>';
}   


?>