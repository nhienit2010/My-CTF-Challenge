<?php

class User {
	public $username;
	private $password;
	public $avatar;

	public function __construct($username, $password, $avatar) {
		$this->username = $username;
		$this->password = $password;
		$this->avatar = $avatar;
	}

	public function getPassword() {
		return $this->password;
	}

	function __toString() {
		echo "Username: ".$this->username . " - Avatar: ". $this->avatar->url;
	}
}

?>