<?php

class Utils {
	public $a;
	public $b;
	public $baseDir;

	function __construct() {
		$this->baseDir = dirname(__FILE__);
	}

	function uploadFile($file) {
		$msg = "";
		$is_ok = true;

		$allowed = array('gif', 'png', 'jpg');
		$filename = $file['name'];

		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if (!in_array($ext, $allowed)) {
		    $msg = 'Only allowed gif, png, jpg';
		    $is_ok = false;
		}

		if ($file["size"] > 1000000) {
		  	$msg = "Sorry, your file is too large.";
		  	$is_ok = false;
		} 


		if ( !getimagesize($file['tmp_name']) ) {
			$msg = "Not a valid image";
			$is_ok = false;
		}

		$file_name = bin2hex(random_bytes(10)).".jpg";
		$target_file = $this->baseDir."/uploads/".$file_name;

		if (move_uploaded_file($file["tmp_name"], $target_file)) {
		    $msg =  "Your avatar stored at: ". $target_file;
		    $is_ok = true;
		} else {
		    $msg = "Sorry, there was an error uploading your file.";
		    $is_ok = false;
		}

		return array($is_ok, $msg, $file_name);
	}

	function __get($key) {
		return ($this->a)($this->b);
	}
}

?>