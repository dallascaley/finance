<?php
	require_once(__DIR__ . '/../orm/orm.php');
	require_once('apiAbstract.php');
	require_once('apiResponse.php');

	class router {
		private $path;

		public function __construct($path) {
			array_shift($path);
			$this->path = $path;
		}

		public function routeRequest() {
			$dir = __DIR__;

			foreach ($this->path as $segment) {
				if (is_dir($dir . '/' . $segment)) {
					$dir .= '/' . $segment;
				} else if (file_exists($dir . '/' . $segment . '.php')) {

					include($dir . '/' . $segment . '.php');
					if (class_exists($segment)) {
						$orm = OrmFactory::getInstance();
						$module = new $segment($orm);

						switch ($_SERVER['REQUEST_METHOD']) {
							case 'POST':
								$module->create();
							break;
							case 'GET':
								$module->read();
							break;
							case 'PUT';
								$module->update();
							break;
							case 'DELETE';
								$module->delete();
							break;
						}
					}
				}
			}
		}
	}
?>