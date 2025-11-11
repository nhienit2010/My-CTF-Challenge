<?php

require_once 'config.php';
session_destroy();

die(header("Location: login.php"));
?>