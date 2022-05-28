<?php

require './classes/curl.php';
require './config.php';

$output = '';

if (isset($_POST['url'])) {
	$curl = new CURL($_POST['url']);
	$curl->getData();
	$output = "Report successfully!!";
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Chưa biết đặt là gì :v</title>
</head>
<body>
<div id="form">

	<h1>Link report</h1>
	<h2><?php if($output) echo $output; ?></h2>
	<form action="/index.php" method="POST">
		<input type="text" name="url" />
		<input type="submit" name="submit" />
	</form>
</div>

</body>
</html>

<style type="text/css">
	body {
		background-image: url('./static/images/main_bg.png');
	}

	#form {
		height: 15em;
		width: 50em;
		background-color: rgba(255, 255, 255, .8);
		position: relative;
		transform: translate(45%, 100%);
		border-radius: .5em;
	}

	#form form {
		position: relative;
		transform: translate(15%, 100%);
	}
	
	#form form > input:first-child {
		border-radius: 0.2em;
		font-size: 1.5em;
		width: 20em;
		margin-top: 1em;
	}
	#form form > input:last-child {
		font-size: 1.5em;
		border-radius: .2em;
	}

	#form h1 {
		font-size: 2.2em;
	}

	#form h1, h2 {
		text-align: center;
	}
</style>