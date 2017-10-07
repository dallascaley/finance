<?php

class validate extends apiAbstract {

	public function read() {
		$message = '"true"';
		foreach ($this->request->params as $key => $value) {
			switch ($key) {
				case 'email':
					if ($this->orm->readOne('users', "email = '#1'", $value)) {
						$message = '"This email address is already in use"';
					}
				break;
			}
		}
		
		echo $message;
	}
}
?>