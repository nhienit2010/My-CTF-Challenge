<?php
require '../config.php';
require '../classes/chain.php';

if (isset($_SESSION['user']) && $_SESSION['user'] === 'admin')  {
	if (!isset($_COOKIE['data']))
		setcookie('data', base64_encode(serialize(new Url("http://www.ahihi.com"))));
	else {
		$cookie = base64_decode($_COOKIE['data']);
		if (preg_match('/\x00/', $cookie))
			die('Hacker detected :))))');
		else
			unserialize($cookie);
	}
}
else {
	die('Login as admin!!!');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin area</title>
</head>
<body>
	<h1 style="text-align: center;">Admin area</h1>
	<h2 style="font-size: 32px">
		Good job hacker!! Giờ thì tìm flag thôi nàooooo!!<br>
	</h2>
	<p style="font-size: 24px">Lười code UI quá mong các bạn thông cảm :(((	</p>
	<p style="font-size: 10px;">Thật ra mình không giỏi code UI hihi!!</p>
</body>
</html>