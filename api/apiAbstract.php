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
		$this->defaultResponse('Create');
	}

	public function update() {
		$this->defaultResponse('Create');
	}	

	public function delete() {
		$this->defaultResponse('Create');
	}

	private function defaultResponse($method) {
		$this->response->status = 'Fail';
		$this->response->errors = ["$method method not supported"];
		$this->response->send();
	}
}
?>