<?php
	require_once(__DIR__ . '/../orm/orm.php');
	require_once('apiAbstractInternal.php');
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
				include($file);

				if (class_exists($name)) {
					$method = array_shift($params);
					$module = new $name($this->orm, $params);

					switch ($method) {
						case 'create':
							return $module->create();
						break;
						case 'read':
							return $module->read();
						break;
						case 'update':
							return $module->update();
						break;
						case 'delete':
							return $module->delete();
						break;
					}
				}
			}
		}
	}
?>