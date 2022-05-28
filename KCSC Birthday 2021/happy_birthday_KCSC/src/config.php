<?php
session_start();

$DB_HOST = 'mysql';
$DB_USER = 'root';
$DB_PASSWORD = 'root';
$DB_NAME = 'kcsc';

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

if ($conn -> connect_error) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}

?>