<?php
class apiRequest {
	
	public $raw_request;
	public $params = [];

	public function __construct() {
		$this->raw_request = file_get_contents('php://input');

		parse_str($this->raw_request, $this->params);

		foreach($_GET as $key => $value) {
			$this->params[$key] = $value;
		}
	}

	public function has($param) {
		return array_key_exists($param, $this->params);
	}
}