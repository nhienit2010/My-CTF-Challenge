<?php

class CURL {
	public $url;

	public function __construct($url) {
		$this->url = $url;
	}

	public function getData() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_HEADER, 0);  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$result = curl_exec($ch);
	
		if ($result === FALSE) {
			return "error while retrieving data!!";
		} 
		
		curl_close($ch);
	}
}

?>