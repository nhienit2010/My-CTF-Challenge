<?php

session_start();
error_reporting(0);
libxml_disable_entity_loader(False);

require 'database.php';
require 'user.php';
require 'utils.php';


$db_connect = new Database("mysql", "root", "mauFJcuf5dhRMQrjj", "kmactf");
$conn = $db_connect->connect();
?>