<?php
require_once(__DIR__ . '/../controller/viewController.php');

abstract class apiAbstract {
	
	protected $orm;
	protected $request;
	protected $response;

	public function __construct($orm, $internal = false, $params = []) {

		$this->orm = $orm;
		$this->api = new viewController();
		$this->registry = registryFactory::getInstance();

		if ($internal) {
			$this->request = new apiRequestInternal($params);
			$this->response = new ApiResponseInternal();
		} else {
			$this->request = new apiRequest();
			$this->response = new ApiResponse();
		}
	}

	public function __call($name, $arguments) {

		if ($this->registry->push(get_called_class())) {

			// Yea i know... Why didn't i use call_user_func_array here?  Because it doesn't work that's why!
			switch (count($arguments)) {
				case 0:
					$return = $this->$name();
				break;
				case 1:
					$return = $this->$name($arguments[0]);
				break;
				case 2:
					$return = $this->$name($arguments[0], $arguments[1]);
				break;
				case 3:
					$return = $this->$name($arguments[0], $arguments[1], $arguments[2]);
				break;
				case 4:
					$return = $this->$name($arguments[0], $arguments[1], $arguments[2], $arguments[3]);
				break;
				case 5:
					$return = $this->$name($arguments[0], $arguments[1], $arguments[2], $arguments[3], $arguments[4]);
				break;
				case 6:
					$return = $this->$name($arguments[0], $arguments[1], $arguments[2], $arguments[3], $arguments[4], 
						$arguments[5]);
				break;
				case 7:
					$return = $this->$name($arguments[0], $arguments[1], $arguments[2], $arguments[3], $arguments[4], 
						$arguments[5], $arguments[6]);
				break;
				case 8:
					$return = $this->$name($arguments[0], $arguments[1], $arguments[2], $arguments[3], $arguments[4], 
						$arguments[5], $arguments[6], $arguments[7]);
				break;
				case 9:
					$return = $this->$name($arguments[0], $arguments[1], $arguments[2], $arguments[3], $arguments[4], 
						$arguments[5], $arguments[6], $arguments[7], $arguments[8]);
				break;
				case 10:
					$return = $this->$name($arguments[0], $arguments[1], $arguments[2], $arguments[3], $arguments[4], 
						$arguments[5], $arguments[6], $arguments[7], $arguments[8], $arguments[9]);
				break;
				default:
					throw new Exception('Too many damn arguments!  If you feel you really need more than 10 arguments then be my guest, add more
						to this fucking method.  But I strongly suggest you read Robert C Martin\'s Clean Code to see why you should not do this');
			}
			if (get_class($this->response) == 'apiResponseInternal') {
				return $return;
			}
		}
	}

	public function __get($name) {
		if ($this->registry->check($name)) {
			$file = __DIR__ .'/'. $name .'.php';
			if (file_exists($file)) {
				include_once($name .'.php');
			}
			$this->$name = new $name($this->orm, true);
		} else {
			$this->$name = new recursion();
		}
		return $this->$name;
	}

	protected function create($params = []) {
		$this->defaultResponse('Create');
	}

	protected function read($params = []) {
		$this->defaultResponse('Read');
	}

	protected function update($params = []) {
		$this->defaultResponse('Update');
	}	

	protected function delete($params = []) {
		$this->defaultResponse('Delete');
	}

	public function setParams($params) {
		$this->request->setParams($params);
	}

	private function defaultResponse($method) {
		$this->response->status = 'Fail';
		$this->response->errors = ["$method method not supported"];
		return $this->response->send();
	}
}
?>