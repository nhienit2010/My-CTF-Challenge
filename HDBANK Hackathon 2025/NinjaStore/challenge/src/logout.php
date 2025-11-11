<?php

require 'config.php';

session_destroy();

echo <<<EOF
<strong>Redirecting to index.php ....</strong>
<script>
	setTimeout(() => {
		window.location = "index.php";
	}, 3000);
</script>
EOF;

?>