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

	public function create($table, $values) {
		$fields = [];
		$clean_values = [];

		foreach($values as $field => $value) {
			$fields[] = "`$field`";
			$clean_values[] = "'" . mysqli_real_escape_string($this->db, $value) . "'";
		}

		$sql = "INSERT INTO $table (" . implode(',', $fields) . ") VALUES (" . implode(',', $clean_values) . ");";
		return $this->query($sql);
	}

	public function update($table, $values, $key_clause = false) {
		if (!$key_clause) {
			$key_clause = $this->getKeyClause($table, $values);
		}

		$updates = [];

		foreach ($values as $field => $value) {
			$updates[] = "`$field` = '" . mysqli_real_escape_string($this->db, $value) . "'";
		}

		$this->query("UPDATE $table SET " . implode(', ', $updates) . " WHERE " . implode('AND', $key_clause));
	}

	public function createOrUpdate($table, $values) {
		$key_clause = $this->getKeyClause($table, $values);

		if (count($key_clause) > 0) {
			$existing_record = $this->query("SELECT * FROM $table WHERE " . implode('AND', $key_clause));

			if ($existing_record->num_rows > 0) {
				if (array_key_exists('created', $values)) {
					unset($values['created']);
				}
				return $this->update($table, $values, $key_clause);
			} else {
				return $this->create($table, $values);
			}
		}
	}

	private function getKeyClause($table, $values) {
		$keys = $this->query("SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY';");

		$key_clause = [];
		if ($keys->num_rows > 0) {
			while ($key = $keys->fetch_assoc()) {
				if (array_key_exists($key['Column_name'], $values)) {
					$clean_value = mysqli_real_escape_string($this->db, $values[$key['Column_name']]);
					$key_clause[] = $key['Column_name'] . " = '" . $clean_value . "' ";
				}
			}
		}
		return $key_clause;
	}

	public function read($table) {
		return $this->selectAll("SELECT * FROM $table");
	}

	public function getError() {
		return mysqli_error($this->db);
	}

	public function display($type, $value) {
		switch ($type) {
			case 'utc_offset':
				if ($value > 0) {
					return substr('0' . $value, -2) . ':00';
				} else {
					return '-' . substr('0' . abs($value), -2) . ':00';
				}
			break;
		}
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