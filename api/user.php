<?php

class user extends apiAbstract {


	public function create() {

		$params = [
			'name' => $this->request->params['username'],
			'email' => $this->request->params['email'],
			'password' => $this->request->params['password'],
			'timezone' => $this->request->params['timezone'],
			'localization' => $this->request->params['localization'],
		];

		if ($this->orm->create('users', $params)) {
			$this->response->message = 'User Created';
		} else {
			$this->response->status = 'Fail';
			$this->response->message = $this->orm->getError();
		}
		return $this->response->send();
	}
}
?>