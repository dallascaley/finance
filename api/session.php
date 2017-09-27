<?php

class session extends apiAbstract {

	public function create() {
		session_start();

		$params = [
			'session_id' => session_id(),
			'username' => '',
			'created' => date("Y-m-d H:i:s"),
			'timezone' => $this->request->params['timezone'],
			'utc_offset' => $this->request->params['utc_offset']
		];

		$this->orm->create('sessions', $params);

		$this->response->message = 'Session Created';
		$this->response->send();
	}
}
?>