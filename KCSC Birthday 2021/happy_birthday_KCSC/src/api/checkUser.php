<?php
header('Content-Type: application/json');

require '../config.php';


if ($_SERVER['REMOTE_ADDR'] === '127.0.0.1') {

	
	if (!isset($_GET['id'])) {
		echo json_encode(array('result' => 'Missing parameter!!'));
	} else {
		$id = $_GET['id'];
		$id = preg_replace('/join|group|having|or|select|from|where|\ /', '',$id);
		$query = 'SELECT * FROM users WHERE id='.$id;
		$result = $conn->query($query);

		if ($result->num_rows > 0) {
			//echo $result;  hmmmm?? Đâu dễ vậy được :))))
		}
	}
} else {
	echo json_encode(array('result' => $_SERVER['REMOTE_ADDR'].'Only localhost can access that feature!!!'));
}
?>