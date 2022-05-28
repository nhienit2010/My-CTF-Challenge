<?php
	$key = "KCSC@Secret__KEY";
	$iv = "KCSC@Padding__@@";

	$some_quotes = [
		"Don't cry because it's over, smile because it happened. - Dr. Seuss",
		"I'm selfish, impatient and a little insecure. I make mistakes, I am out of control and at times hard to handle. But if you can't handle me at my worst, then you sure as hell don't deserve me at my best. - Marilyn Monroe",
		"You've gotta dance like there's nobody watching, love like you'll never be hurt, sing like there's nobody listening, and live like it's heaven on earth. - William W. Purkey",
		"You only live once, but if you do it right, once is enough. - Mae West",
		"In three words I can sum up everything I've learned about life: it goes on. - Robert Frost",
		"To live is the rarest thing in the world. Most people exist, that is all. - Oscar Wilde",
		"Insanity is doing the same thing, over and over again, but expecting different results. - Narcotics Anonymous",
		"There are only two ways to live your life. One is as though nothing is a miracle. The other is as though everything is a miracle. - Albert Einstein",
		"It does not do to dwell on dreams and forget to live. - J.K. Rowling, Harry Potter and the Sorcerer's Stone",
		"Good friends, good books, and a sleepy conscience: this is the ideal life. - Mark Twain"
	];

	function fnDecrypt($sValue) {
	    global $iv, $key;
    	return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, base64_decode($sValue), MCRYPT_MODE_CBC, $iv), "\0\3");	
    }

	if (isset($_GET["item"])) {
		$cipher = $_GET["item"];

		if ( empty($cipher) ) {
			die("Wrong item");

		}

		$item = fnDecrypt($cipher);

		if ($item === "719") {
			echo "KCSC{Pl3as3_d0nt_st0r3_th3_s3cr3t_k3y_1n_cl1ent-s1d3_scr1pt!!}";
		} else if (!empty($item)) {
			echo $some_quotes[rand(0, 9)];
		} 
		die();
	}
?>

<h1>Get Secret Items</h1>
<p><strong>Can you guess lucky number??</strong></p>

<form method="GET" action="/">
	<label for="item">ID: </label>
	<input type="text" name="item" placeholder="1" />	
	<input type="submit" name="submit" />
</form>

<script type="text/javascript" src="https://cdn.rawgit.com/ricmoo/aes-js/e27b99df/index.js"></script>
<script type="text/javascript" src="index.js"> </script>


