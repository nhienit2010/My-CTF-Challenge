<?php

if ( isset($_GET["source"]) ) {
	highlight_file(__FILE__);
	die();
}

// Process file upload
if (isset($_FILES["file"])) {	
	// Clean storage
	$files = count(glob( "uploads/*"));
	if ($files > 100) {
		system("rm uploads/*");
	}

	$fileExt = strtolower(pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION));
	
	if ( preg_match("/ph/i", $fileExt) )
		die("Don't cheat my fen");

	$fileName = md5(rand(1, 1000000000)).".".$fileExt;
	$target_file = "uploads/" . $fileName;
	
	if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
		die("Your file: ".getcwd()."/".$target_file);
	} else {
		die("Something went wrong\n");
	}

}
// Add enviroment variable
if (isset($_GET["env"])) {
	foreach ($_GET["env"] as $key => $value) {
		if ( preg_match("/[A-Za-z_]/i", $key) && !preg_match("/bash/i", $key) )
			putenv($key."=".$value);
	}
}

system("echo pwnme!!");

?>

<form action="/" method="post" enctype="multipart/form-data">
  Select evil file to upload:
  <input type="file" name="file"> <br />
  <input type="submit" value="Upload" name="submit">
</form>

<!-- ?source=1 -->