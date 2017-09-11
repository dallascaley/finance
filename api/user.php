<?php

class user {

	protected $orm;

	public function __construct($orm) {
		$this->orm = $orm;
	}

	public function processRequest() {
		echo "<br/>Processing Request<br/>";

		$params = 'whocares';
		
		$this->orm->createUser($params);
	}
}