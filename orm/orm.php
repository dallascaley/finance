<?php
require_once(__DIR__ . '/../config.php');

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

			mysqli_select_db($this->db, DATABASE);
		}
 	}

	public function createUser($params) {
		$this->query("INSERT INTO users (`name`,`email`,`password`,`timezone`,`localization`)
			VALUES ('dallascaley','dallascaley@gmail.com','fart','Pacific Standard Time','English');");

		echo('<br/>User Created!</br>');

		echo(mysqli_error($this->db));
	}

	public function create($table, $value) {
		return $this->selectAll("SELECT * FROM $table");
	}

	public function read($table) {
		return $this->selectAll("SELECT * FROM $table");
	}

	private function selectAll($sql) {
		$result = $this->query($sql);

		if ($result->num_rows > 0) {
			$return_array = [];
			while ($row = $result->fetch_assoc()) {
				$return_array[] = $row;
			}
			return $return_array;
		} else {
			return false;
		}
	}

	private function query($sql) {
		return mysqli_query($this->db, $sql);
	}
}