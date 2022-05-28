<?php

class File {
	public $file;

	public function __toString() {
		if (!preg_match('/^(http|https|php|data|zip|input|phar|expect):\/\//', $this->file)) {
			include($this->file);
		}
		return "Ahihhii";
	}
}


class Url {
	public $url;

	public function __construct($url) {
		$this->url = $url;
	}

	public function checkUrl() {
		if (preg_match('/[http|https]:\/\//', $this->url))
			return true;
		else
			return false;
	} 
}


class Func1 {
	public $param1;
	public $param2;

	public function __get($key) {
		$key = $this->param2;
		return $this->param1->$key();
	}
}

class Source {
	private $source;

	public function __construct($s) {
		$this->source = $s;
	}
	public function __invoke() {
		return $this->source->method;
	}
}


class Func2 {
	public $param;

	public function __wakeup() {
		$function = $this->param;
		return $function();
	}
}

?>