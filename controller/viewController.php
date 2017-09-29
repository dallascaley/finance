<?php
	require_once(__DIR__ . '/../orm/orm.php');
	require_once(__DIR__ . '/../api/apiAbstract.php');
	require_once('apiRequestInternal.php');
	require_once('apiResponseInternal.php');

	class viewController {
		private $orm;

		public function __construct() {
			$this->orm = OrmFactory::getInstance();
		}

		public function __call($name, $params) {
			$file = __DIR__ . '/../api/' . $name . '.php';

			if (file_exists($file)) {
				if (class_exists($name)) {
					$module = new $segment($orm);
					$method = array_shift($params);


					/*

					need to get params into internal api request somehome?!?

					*/
					switch ($method) {
						case 'create':
							$module->create();
						break;
						case 'read':
							$module->create();
						break;
						case 'update':
							$module->update();
						break;
						case 'delete':
							$module->delete();
						break;
					}
				}
			}
		}
	}
?>