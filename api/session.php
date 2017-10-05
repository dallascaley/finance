<?php

class session extends apiAbstract {

	public function create() {
		$params = [
			'session_id' => session_id(),
			'username' => '',
			'created' => date("Y-m-d H:i:s"),
			'updated' => date("Y-m-d H:i:s"),
			'timezone' => $this->request->params['timezone'],
			'utc_offset' => $this->request->params['utc_offset']
		];

		if ($this->orm->createOrUpdate('sessions', $params)) {
			$this->response->message = 'Session Created';
		} else {
			$this->response->status = 'Fail';
			$this->response->message = $this->orm->getError();
		}
		return $this->response->send();
	}

	public function read() {
		$this->response->message = $this->orm->readOne('sessions', "session_id = '" . session_id() . "'");
		return $this->response->send();
	}
}
?>