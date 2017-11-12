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

	private $last_query;

 	public function __construct() {
 		$link = mysqli_connect('localhost', DB_USER, DB_PASS);

 		if (!$link) {
		    die('Could not connect: ' . mysql_error());
		} else {
			$this->db = $link;

			mysqli_select_db($this->db, DATABASE);
		}
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

		return $this->query("UPDATE $table SET " . implode(', ', $updates) . " WHERE " . implode('AND', $key_clause));
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

	public function read($table, $clause = false) {
		if ($clause) {
			return $this->selectAll("SELECT * FROM $table WHERE " . $clause);
		} else {
			return $this->selectAll("SELECT * FROM $table");
		}
	}

	public function readOne() {
		$args = func_get_args();
		$table = array_shift($args);
		$clause = (count($args) > 0) ? array_shift($args) : false;

		for($i = count($args); $i > 0; $i--) {
			$clean_value = mysqli_real_escape_string($this->db, $args[$i - 1]);
			$clause = str_replace('#'.$i, $clean_value, $clause);
		}

		$all = $this->read($table, $clause);
		if (count($all) > 0) {
			return $all[0];
		} else {
			return false;
		}
	}

	public function getError() {
		return mysqli_error($this->db);
	}

	public function lastQuery() {
		return $this->last_query;
	}

	private function selectAll($sql) {
		$result = $this->query($sql);

		if ($result && $result->num_rows > 0) {
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
		$this->last_query = $sql;
		return mysqli_query($this->db, $sql);
	}

	public function getSimulationData($username) {
		return $this->selectAll("SELECT * FROM reoccurrences r
			LEFT JOIN days d
			  ON r.name = d.reoccurrence
			  AND r.username = d.username
			LEFT JOIN dates d2
			  ON r.name = d2.reoccurrence
			  AND r.username = d2.username
			WHERE r.username = '$username';");
	}
}