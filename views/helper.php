<?php

class viewHelper {

	public function nth($number) {
		if ($number > 10 && $number < 20) {
			echo $number.'th';
		} else {
			$digit = substr($number, -1);
			switch ($digit) {
				case 1:
					echo $number.'st';
				break;
				case 2:
					echo $number.'nd';
				break;
				case 3:
					echo $number.'rd';
				break;
				default:
					echo $number.'th';
				break;
			}
		}
	}
}
?>