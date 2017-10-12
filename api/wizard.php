<?php

class wizard extends apiAbstract {

	public function read($params = []) {
		$session = $this->session->read();
		$step1 = $this->orm->readOne('reoccurrences', "username = '#1' AND name = '#2'", $session['username'], 'Rent');
		$step2 = $this->orm->readOne('reoccurrences', "username = '#1' AND name = '#2'", $session['username'], 'Pay');

		$message = '';
		switch (true) {
			case ($step1):
				$message = 'step2';
			break;
			case ($step2):
				$message = 'step3';
			break;
		}

		$this->response->message = $message;
		return $this->response->send();
	}
}
?>