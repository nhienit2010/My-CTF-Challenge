<?php
require 'config.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

$data = file_get_contents("php://input");
if (strlen($data) > 0 ) {
    libxml_disable_entity_loader (false);
    $dom = new DOMDocument();
    $dom->loadXML($data, LIBXML_NOENT | LIBXML_DTDLOAD);
    $item = simplexml_import_dom($dom);
    $name = $item->name;
    $price = $item->price;
} else {
    die("No data found");
}

$msg = "Thank for your visit shop\n";
$msg .= "The product you purchased is $name\n";
$msg .= "This feature is currently under development, please try again later.\n";

echo $msg;
?>