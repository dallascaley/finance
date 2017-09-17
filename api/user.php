<?php

class user {

	protected $orm;

	public function __construct($orm) {
		$this->orm = $orm;
	}

	public function create() {
		echo "<br/>Create User<br/>";

		//$params = 'whocares';
		
		//$this->orm->createUser($params);
	}

	public function read() {
		echo "<br/>Read User<br/>";

	}

	public function update() {
		echo "<br/>Update User<br/>";
	}	

	public function delete() {
		echo "<br/>Delete User<br/>";
	}

}