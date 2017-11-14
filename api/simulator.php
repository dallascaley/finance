<?php

class simulator extends apiAbstract {

	public function read($params = []) {
		$session = $this->session->read();

		$reoccurrences = $this->orm->getSimulationData($session['username']);

		$timestamp = time();
		$default_timeframe = 30;  //Default number days the simulation shows

		$data = [];
		for($i = 0; $i <= $default_timeframe; $i++) {
			$day = date('D jS', $timestamp);

			$todays_occurrences = [];
			foreach ($reoccurrences as $reoccurrence) {
				//Note: i hate this, we should have objects of each type and a factory to make the right one.
				$happens_today = false;
				switch ($reoccurrence['frequency']) {
					case 'annually':
					break;
					case 'bi-monthly':
					break;
					case 'bi-weekly':
						if ($reoccurrence['day'] == date('w', $timestamp)) {
							
							$start = strtotime($reoccurrence['date']);
							if ($timestamp > ($start - 86400)) {
								$diff = $timestamp - $start;
								$weeks = ceil($diff / (60 * 60 * 24 * 7));
								if ($weeks % 2 == 1) {
									$happens_today = true;
								}
							}
						}
					break;
					case 'daily':
					break;
					case 'monthly':
						if ($reoccurrence['day'] == date('j', $timestamp)) {
							$happens_today = true;
						}
					break;
					case 'weekdays':
					break;
					case 'weekends':
					break;
					case 'weekly':
						if ($reoccurrence['day'] == date('w', $timestamp)) {
							$happens_today = true;
						}
					break;
				}
				if ($happens_today) {
					$todays_occurrences[] = $reoccurrence;
				}
			}
			$data[] = [
				'day' => $day,
				'occurrences' => $todays_occurrences
			];

			$timestamp = $timestamp + (60 * 60 * 24);
		}

		$this->response->message = $data;

		return $this->response->send();
	}
}
?>