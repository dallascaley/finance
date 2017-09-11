<?php

class ormFactory
{
	static $instance;

	public static function getInstance() {
		if (!isset(static::$instance)) {
			static::$instance = new orm();
		}

		return static::$instance;
	}
}

class orm
{
	private $db;

 	public function __construct() {
 		$link = mysqli_connect('localhost', DB_USER, DB_PASS);

 		if (!$link) {
		    die('Could not connect: ' . mysql_error());
		} else {
			$this->db = $link;

			mysqli_select_db($this->db, "finances");
		}
 	}

	public function createUser($params) {
		$this->query("INSERT INTO users (`name`,`email`,`password`,`timezone`,`localization`)
			VALUES ('dallascaley','dallascaley@gmail.com','fart','Pacific Standard Time','English');");

		echo('<br/>User Created!</br>');

		echo(mysqli_error($this->db));
	}

	private function query($sql) {
		mysqli_query($this->db, $sql);
	}
}