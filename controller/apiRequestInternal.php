<?php

class apiRequest {
	
	public $raw_request;
	public $params = [];

	public function __construct($params) {
		$this->params = $params;
	}

	public function has($param) {
		return array_key_exists($param, $this->params);
	}
}