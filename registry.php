<?php

class registryFactory
{
	static $instance;

	public static function getInstance() {
		if (!isset(static::$instance)) {
			static::$instance = new registry();
		}

		return static::$instance;
	}
}

class registry
{
	private $trace = [];

	public function push($path) {
		if (!in_array($path, $this->trace)) {
			$this->trace[] = $path;
			return true;
		} else {
			return false;
		}
	}

	public function check($path) {
		if (in_array($path, $this->trace)) {
			return false;
		} 
		return true;
	}
}

class recursion
{
	public function __call($name, $arguments) {
		return 'Recursion';
	}
}