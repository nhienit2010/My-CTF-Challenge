<?php
require './config.php';
$output = '';
if (isset($_POST['username']) &&  isset($_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$stmt = $conn->prepare('SELECT * FROM users WHERE username=? and password=? limit 0,1');
	$stmt->bind_param("ss", $username, $password);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($user = $result->fetch_assoc()['username']) {
		$_SESSION['user'] = 'admin';
		header('Location: /admin');
	}
	else
		$output = "Try again!!";

	$stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<div id="login">
		<h1>Login form</h1>
		<h2><?php if($output) echo $output; ?></h2>
		<form action="/login.php" method="POST">
			<input type="text" name="username" /> 
			<input type="password" name="password" />
			<input type="submit" name="Submit" value="Submit" />
		</form>
	</div>
</body>
</html>

<style type="text/css">
	body {
		background-image: url('./static/images/login.jpg');
	}
	#login {
		width: 40em;
		height: 18em;
		border-radius: .8em;
		border: 1px solid black;
		position: relative;
		background-color: rgba(255, 255, 255, 0.8);
		transform: translate(60%, 60%);
		padding-left: 2em;
	}

	#form > form {
		position: relative;
		transform: translate(15%, 100%);
	}

	#login form > input {
		display: block;
		font-size: 1.5em;
		margin-top: 0.5em;
	}
</style>