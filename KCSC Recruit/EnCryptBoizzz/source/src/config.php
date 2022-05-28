<?php
$auth_key = "AuthKey4N00b3r";
$key_for_enc = "f776b618a66e526a";

function safe($page) {
	if (preg_match('/php|flag/i', $page))
		return false;
	return true;
}

?>