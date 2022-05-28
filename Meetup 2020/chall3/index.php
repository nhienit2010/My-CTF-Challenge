<?php
	if ( isset($_POST["name"]) ) {
		$name = $_POST["name"];
		if ( !isset($_COOKIE["is_admin"]) ) 
			setcookie("is_admin", "0");
	}

	if ($_COOKIE["is_admin"] === "1")
		require "config.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Eat Cookieeeeeeeeee</title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
	<dir id="form">
		<?php 
			if ($flag) 
				echo "<h1>$flag</h1>";
			else
				echo "<h1>Oh no!!! Only admin can order cookie :(((((</h1>"
		?>
	</dir>
</body>
</html>