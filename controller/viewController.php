<?php

	require_once(__DIR__ . '/../orm/orm.php');
	require_once(__DIR__ . '/../api/apiAbstract.php');
	require_once('apiRequestInternal.php');
	require_once('apiResponseInternal.php');

	class viewController {
		private $orm;
		private $modules = [];

		public function __construct() {
			$this->orm = ormFactory::getInstance();
		}

		public function __call($name, $params) {
			if ($name == 'getPartial') {
				$this->getPartial($params);
			} else {
				$file = __DIR__ . '/../api/' . $name . '.php';

				if (file_exists($file)) {
					include_once($file);

					if (class_exists($name)) {
						$method = array_shift($params);

						if (array_key_exists($name, $this->modules)) {
							$module = $this->modules[$name];
							$module->setParams($params);
						} else {
							$module = new $name($this->orm, true, $params);
							$this->modules[$name] = $module;
						}

						return $module->$method();
					}
				}
			}
		}

		private function getPartial($params) {
			$view = (is_array($params)) ? array_shift($params) : $params;
			$file = __DIR__ . '/../views/partial_views/' . $view . '.php';
			$url = SITE_URL . '/views/partial_views/' . $view . '.php';

			if (file_exists($file)) {
				
				$request_host = 'finance.local';
				$request_url    = LOOPBACK_IP .'/views/partial_views/' . $view . '.php';
				$headers = array("Host: ".$request_host);

				$ch = curl_init();
				$timeout = 5;

				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_URL, $request_url);
				curl_setopt($ch, CURLOPT_HEADER, FALSE);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
				$data = curl_exec($ch);
				curl_close($ch);
				echo($data);
				
			} else {
				echo("<div class='error'>Error: partial file: $view.php is missing or improperly formed.</div>");
			}

		}
	}
?>