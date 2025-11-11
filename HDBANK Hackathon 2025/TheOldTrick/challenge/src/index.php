<?php

require_once 'config.php';
require_once 'utils.php';

if ( !isset($_SESSION['isAuth']) ||  !( $_SESSION['isAuth'] === true) ) {
    die(header("Location: login.php"));
}

require_once 'views/index.html';

?>