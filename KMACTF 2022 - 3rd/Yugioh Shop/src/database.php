<?php

class Database {
	public $servername;
	public $username;
	public $password;
	public $database;
	public $is_connected;

	function __construct($servername, $username, $password, $database) {
		$this->servername = $servername;
		$this->username = $username;
		$this->password = $password;
		$this->database = $database;
	}

	function connect() {
		$conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}
		$this->is_connected = 1;
		return $conn;
	}

	function __wakeup() {
		if (!$this->is_connected) {
			echo "Cannot connect to database: ".$this->database;
		}
	}
}

?>