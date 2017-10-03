<?php

abstract class apiAbstract {
	
	protected $orm;
	protected $request;
	protected $response;

	public function __construct($orm) {
		$this->orm = $orm;
		$this->request = new apiRequest();
		$this->response = new apiResponse();
	}

	public function create() {
		$this->defaultResponse('Create');
	}

	public function read() {
		$this->defaultResponse('Read');
	}

	public function update() {
		$this->defaultResponse('Update');
	}	

	public function delete() {
		$this->defaultResponse('Delete');
	}

	private function defaultResponse($method) {
		$this->response->status = 'Fail';
		$this->response->errors = ["$method method not supported"];
		return $this->response->send();
	}
}
?>