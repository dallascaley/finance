<?php

class account extends apiAbstract {


	public function create($params = []) {

		if ($this->orm->create('accounts', $params)) {
			$this->response->message = 'Account added!';
		} else {
			$this->response->status = 'Fail';
			$this->response->message = $this->orm->getError();
		}
		return $this->response->send();
	}
}
?>