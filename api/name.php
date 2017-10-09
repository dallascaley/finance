<?php

class name extends apiAbstract {


	public function create($params = []) {

		if ($this->orm->create('names', $params)) {
			$this->response->message = 'Name added!';
		} else {
			$this->response->status = 'Fail';
			$this->response->message = $this->orm->getError();
		}
		return $this->response->send();
	}
}
?>