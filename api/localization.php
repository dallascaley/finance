<?php

class localization extends apiAbstract {

	public function read() {
		$this->response->message = $this->orm->getLocalizations();
		$this->response->send();
	}
}
?>