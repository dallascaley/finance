<?php

class localization extends apiAbstract {

	public function read() {
		$this->response->message = $this->orm->read("localizations");
		$this->response->send();
	}
}
?>