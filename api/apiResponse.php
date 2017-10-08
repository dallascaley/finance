<?php
class apiResponse {
	
	public $status = 'Success';
	public $errors = [];
	public $notices = [];
	public $message = '';

	public function send() {
		$response = [
			'status' => $this->status,
			'errors' => $this->errors,
			'notices' => $this->notices,
			'message' => $this->message
		];

		echo json_encode($response);
	}
}