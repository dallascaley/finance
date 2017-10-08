<?php

class apiRequestInternal {
	
	public $raw_request;
	public $params = [];

	public function __construct($params) {
		$this->params = $params;
	}

	public function has($param) {
		return array_key_exists($param, $this->params);
	}

	public function setParams($params) {
		$this->params = $params;
	}
}