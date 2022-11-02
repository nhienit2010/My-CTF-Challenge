<?php

require 'config.php';

if (isset($_SESSION['user'])) {
	header("Location: home.php");
}

if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password']) ) {
	$username = $conn->real_escape_string($_POST['username']);
	$password = $conn->real_escape_string($_POST['password']);

	$data = $conn->query("SELECT * FROM users where username='$username'");
	if ($data->num_rows > 0)
		$msg = "User exists";
	else {
		if ($conn->query("INSERT INTO users(username, password, avatar) VALUES ('".$username."', '".md5($password)."', '')"))
			$msg = "User created";
		else 
			$msg = "Something went wrong";
	}

} else {
	echo "<script>";
	echo "alert('Blank field!!!')";
	echo "location = 'register.php'";
	echo "</script";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
<title>Bootstrap Sign up Form with Icons</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="static/css/register.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style>
</style>
</head>
<body>
<div class="signup-form">
    <form action="register.php" method="post">
		<h3><?php if (!empty($msg)) echo $msg;?></h3>
		<h2>Sign Up</h2>
		<p>Please fill in this form to create an account!</p>
		<hr>
        <div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-user"></i></span>
				<input type="text" class="form-control" name="username" placeholder="Username" required="required">
			</div>
        </div>
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-lock"></i></span>
				<input type="text" class="form-control" name="password" placeholder="Password" required="required">
			</div>
        </div>
		<div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg">Sign Up</button>
        </div>
    </form>
	<div class="text-center">Already have an account? <a href="login.php">Login here</a></div>
</div>
</body>
</html>