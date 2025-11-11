<?php

require_once 'config.php';

if ( isset($_SESSION['isAuth']) && ($_SESSION['isAuth'] === true) ) {
    die(header("Location: index.php"));
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once 'views/login.html';
    die();
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ( empty($_POST['username']) || is_array($_POST['username']) ||
         empty($_POST['quote']) || is_array($_POST['quote'])
    ){
        die("username and quote are required ! ");
    }

    $_SESSION['username'] = $_POST['username'];
    $_SESSION['quote'] = $_POST['quote'];
    $_SESSION['color'] = "Red";
    $_SESSION['isAuth'] = true;

    echo '
        Login successfully ! Redirecting to index.php ...
    <script>
        setTimeout(() => {
            window.location.href = "index.php";
        }, 2000);
    </script>';
}   
?>