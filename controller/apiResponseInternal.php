<?php

class apiResponse {
	
	public $status = 'Success';
	public $errors = [];
	public $notices = [];
	public $message = '';

	public function send() {

		if (count($this->errors) > 0) {
			throw new Exception($this->errors[0]);
		}
		
		return $this->message;
	}
}