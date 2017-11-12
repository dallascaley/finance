<?php

class simulator extends apiAbstract {

	public function read($params = []) {
		$session = $this->session->read();

		$reoccurrences = $this->orm->getSimulationData($session['username']);

		$timestamp = time();
		$default_timeframe = 30;  //Default number days the simulation shows

		$data = [];
		while($i = 0; $i <= $default_timeframe; $i++) {
			$day = date('D jS');
			foreach ($reoccurrences as $reoccurrence) {
				//Note: i hate this, we should have objects of each type and a factory to make the right one.
				switch ($reoccurrence['frequency']) {
					case 'annually':
					break;
					case 'bi-monthly':
					break;
					case 'bi-weekly':
					break:
					case 'daily':
					break;
					case 'monthly':
					break;
					case 'weekdays':
					break;
					case 'weekends':
					break;
					case 'weekly':
					break;
				}
			}
		}

		$this->response->message = $simulation;

		return $this->response->send();
	}
}
?>