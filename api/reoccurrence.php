<?php

class reoccurrence extends apiAbstract {


	public function create($params = []) {
		$session = $this->session->read();

		if ($session['username']) {
			$params = [
				'name' => $this->request->params['name'],
				'username' => $session['username'],
				'amount' => $this->request->params['amount'],
				'action' => $this->request->params['action'],
				'frequency' => $this->request->params['frequency'],
			];

			if ($this->orm->create('reoccurrences', $params)) {
				if (array_key_exists('days', $this->request->params)) {
					foreach($this->request->params['days'] as $day) {
						$params = [
							'reoccurrence' => $this->request->params['name'],
							'username' => $session['username'],
							'day' => $day
						];
						$this->orm->create('days', $params);
					}
				}
				if (array_key_exists('date', $this->request->params)) {
					$params = [
						'reoccurrence' => $this->request->params['name'],
						'username' => $session['username'],
						'date' => $this->request->params['date'],
						'type' => $this->request->params['datetype']
					];
					$this->orm->create('dates', $params);
				}
				if (array_key_exists('date_1', $this->request->params)) {
					$date_parts = explode('/', $this->request->params['date_1']);
					$date = $date_parts[2] .'-'. $date_parts[0] .'-'. $date_parts[1];
					$params = [
						'reoccurrence' => $this->request->params['name'],
						'username' => $session['username'],
						'date' => $date,
						'type' => $this->request->params['datetype']
					];
					$this->orm->create('dates', $params);
				}
				if (array_key_exists('date_2', $this->request->params)) {
					$date_parts = explode('/', $this->request->params['date_2']);
					$date = $date_parts[2] .'-'. $date_parts[0] .'-'. $date_parts[1];
					$params = [
						'reoccurrence' => $this->request->params['name'],
						'username' => $session['username'],
						'date' => $date,
						'type' => $this->request->params['datetype']
					];
					$this->orm->create('dates', $params);
				}
				$this->response->message = 'Reoccurrence added';
			} else {
				$this->response->status = 'Fail';
				$this->response->message = $this->orm->lastQuery();
			}
		} else {
			$this->response->status = 'Fail';
			$this->response->message = 'Not logged in';
		}
		return $this->response->send();
	}
}
?>