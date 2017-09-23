<?php

class localization extends apiAbstract {

	public function create() {
		if (!array_key_exists('localization', $_POST)) {
			$this->response->status = 'Fail';
			$this->response->errors[] = "Parameter: 'localization' missing from post data";
		} else {
			$params = ['name' => $_POST['localization']];
			$this->response->message = $this->orm->create("localizations", $params);
		}
		$this->response->send();
	}

	public function read() {
		$this->response->message = $this->orm->read("localizations");
		$this->response->send();
	}
}
?>