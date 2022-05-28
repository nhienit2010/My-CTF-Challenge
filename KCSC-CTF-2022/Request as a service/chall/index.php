<?php
require_once 'config.php';

if ( $_SERVER['REMOTE_ADDR'] === "127.0.0.1") {
	if ( !empty($_SERVER["HTTP_X_KEY"]) && !empty($_SERVER["HTTP_X_FLAG"]) && $_SERVER["HTTP_X_KEY"] === "K3Y_t0_G3t_flaggggg" && $_SERVER["HTTP_X_FLAG"] === "KCSC") 
		echo $flag;
}


if ( isset($_GET["url"]) ) {
	$url = $_GET["url"];

	if (preg_match("/^file|php|zip|data|input|expect|phar/i", $url))
		die("Don't cheat");

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);
	echo $result;
	curl_close($ch);
} else 
	show_source(__FILE__);

?>