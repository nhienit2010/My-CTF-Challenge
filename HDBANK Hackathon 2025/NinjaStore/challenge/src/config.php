<?php
session_start();

$FLAG = "HDBH{Just_s1mpl3_SQLi_ch4ll4ng3_348d4bf1280cba56495474d4cf2b1c50}";
$DB_HOST = "mysql"; // change me
$DB_USER = "root"; // change me
$DB_PASS = "Abcd@1234"; // change me
$DB_NAME = "ninjashop";

$connection = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($connection->connect_error) {
    die("<strong>MySQL connection error</strong>");
}

function waf($input) {
    // Prevent sqli -.-
    $blacklist = join("|", ["sleep", "benchmark", "order", "limit", "exp", "extract", "xml", "floor", "rand", "count", "or" ,"and", ">", "<", "\|", "&","\(", "\)", "\\\\" ,"1337", "0x539"]);
    if (preg_match("/${blacklist}/si", $input)) die("<strong>Stop! No cheat =))) </strong>");
    return TRUE;
}

?>