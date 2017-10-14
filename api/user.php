<?php

class user extends apiAbstract {


	public function create($params = []) {

		$params = [
			'name' => $this->request->params['username'],
			'email' => $this->request->params['email'],
			'password' => $this->request->params['password'],
			'timezone' => $this->request->params['timezone'],
			'localization' => $this->request->params['localization'],
		];

		if ($this->orm->create('users', $params)) {
			$this->session->assignUser($this->request->params['username']);

			$first_name = [
				'name' => $this->request->params['first_name'],
				'username' => $this->request->params['username'],
				'cardinality' => 1
			];
			$this->name->create($first_name);

			$last_name = [
				'name' => $this->request->params['last_name'],
				'username' => $this->request->params['username'],
				'cardinality' => 2
			];
			$this->name->create($last_name);

			$account = [
				'name' => 'Main',
				'username' => $this->request->params['username'],
				'balance' => 0,
				'type' => 'default'
			];
			$this->account->create($account);

			$this->response->message = 'User added!';
		} else {
			$this->response->status = 'Fail';
			$this->response->message = $this->orm->getError();
		}
		return $this->response->send();
	}

	public function read($params = []) {
		if (count($params) == 0) {
			$session = $this->session->read();
			$user = $this->orm->readOne('users', "name = '#1'", $session['username']);
			if ($user) {
				$this->response->message = $user;
			} else {
				$this->response->message = false;
				$this->response->status = 'Fail';
			}
			return $this->response->send();
		}
	}

	public function login() {
		$user = $this->orm->readOne('users', "name = '#1' AND password = '#2'", 
			$this->request->params['username'], 
			$this->request->params['password']
		);

		if (!$user) {
			$user = $this->orm->readOne('users', "email = '#1' AND password = '#2'", 
				$this->request->params['username'], 
				$this->request->params['password']
			);
		}

		if ($user) {
			$this->session->assignUser($user['name']);
			$this->response->message = "User logged in";
		} else {
			$this->response->message = false;
			$this->response->status = 'Fail';
		}

		return $this->response->send();
	} 

	public function logout() {
		session_regenerate_id();
		session_destroy();
		$this->response->message = "User logged out";
		return $this->response->send();
	}
}
?>