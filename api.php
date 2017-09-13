<?php
require_once(__DIR__ . '/orm/orm.php');

$orm = OrmFactory::getInstance();

$full_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$path = array_map('rawurldecode', explode('/', substr($full_path, 1)));

$dir = __DIR__;

foreach ($path as $segment) {
	if (is_dir($dir . '/' . $segment)) {
		$dir .= '/' . $segment;
	} else if (file_exists($dir . '/' . $segment . '.php')) {

		include($dir . '/' . $segment . '.php');
		if (class_exists($segment)) {

			$orm = OrmFactory::getInstance();
			$module = new $segment($orm);

			$module->processRequest();
		}
	}
}
