<?php

class timezone extends apiAbstract {

	public function read($params = []) {
		$this->response->message = $this->orm->read("timezones");
		return $this->response->send();
	}

	public function display($params = []) {
		$type = $this->request->params[0];
		$value = $this->request->params[1];

		switch ($type) {
			case 'utc_offset':
				if ($value > 0) {
					return substr('0' . $value, -2) . ':00';
				} else {
					return '-' . substr('0' . abs($value), -2) . ':00';
				}
			break;
		}
	}
}
?>