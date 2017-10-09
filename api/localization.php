<?php

class localization extends apiAbstract {

	public function create($params = []) {
		
		if (!$this->request->has('localization')) {
			$this->response->status = 'Fail';
			$this->response->errors[] = "Parameter: 'localization' missing from post data";
		} else {
			$params = ['name' => $this->request->params['localization']];
			if ($this->orm->create("localizations", $params)) {
				$this->response->message = "Localization Added";
			} else {
				$this->response->status = 'Fail';
				$this->response->message = $this->orm->getError();
			}
		}
		return $this->response->send();
	}

	public function read($params = []) {
		$this->response->message = $this->orm->read("localizations");
		return $this->response->send();
	}
}
?>