<?php

class apiRequest {
	
	public $raw_request;
	public $params = [];

	public function __construct() {
		$this->raw_request = file_get_contents('php://input');

		if (strlen($this->raw_request) > 0) {
			$key_value_pairs = explode('&', $this->raw_request);
			foreach ($key_value_pairs as $key_value) {
				$assignment = explode('=', $key_value);
				if (array_key_exists(1, $assignment)) {
					$this->params[$assignment[0]] = urldecode($assignment[1]);
				}
			}
		}
	}

	public function has($param) {
		return array_key_exists($param, $this->params);
	}
}