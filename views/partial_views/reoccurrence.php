<?php
	include_once(__DIR__ . '/../helper.php');
	$helper = new viewHelper();

	extract($_GET);
?>
	<label><?php echo $title ?></label>
	<input type="text" id="<?php echo $id ?>" name="<?php echo $id ?>" placeholder="$"/>
	<label><?php echo $frequency_msg ?></label>
	<select id="<?php echo $id ?>_frequency" name="<?php echo $id ?>_frequency" class="dependency">
		<option value="none">Choose Timeframe</option>
		<option value="bi-weekly">Every other week</option>
		<option value="bi-monthly">Twice per month</option>
		<option value="weekly">Every Week</option>
		<option value="daily">Daily</option>
		<option value="monthly">Every Month</option>
		<option value="weekdays">Weekdays Only</option>
		<option value="weekends">Weekends Only</option>
	</select>

	<div class="depends" dependency="<?php echo $id ?>_frequency" value="bi-weekly,weekly">
		<label>On:</label>
		<select id="<?php echo $id ?>_frequency_weekday" name="<?php echo $id ?>_frequency_weekday" class="dependency">
			<option value="none">Choose Day</option>
			<option value="0">Sunday</option>
			<option value="1">Monday</option>
			<option value="2">Tuesday</option>
			<option value="3">Wednesday</option>
			<option value="4">Thursday</option>
			<option value="5">Friday</option>
			<option value="6">Saturday</option>
		</select>
	</div>

	<div class="depends" dependency="<?php echo $id ?>_frequency_weekday,<?php echo $id ?>_frequency" value="0,1,2,3,4,5,6|bi-weekly">
		<label><?php echo $next_msg ?></label>
		<select id="<?php echo $id ?>_frequency_date" name="<?php echo $id ?>_frequency_date" from="<?php echo $id ?>_frequency_weekday">
		</select>
	</div>

	<div class="depends" dependency="<?php echo $id ?>_frequency" value="bi-monthly,monthly">
		<label>On the:</label>
		<select id="<?php echo $id ?>_frequency_day_1" name="<?php echo $id ?>_frequency_day_1">
			<?php
				for($i = 1; $i<32; $i++) {
					?>
					<option value="<?php echo $i ?>"><?php $helper->nth($i) ?></option>
					<?php
				}
			?>
		</select>
	</div>

	<div class="depends" dependency="<?php echo $id ?>_frequency" value="bi-monthly">
		<label>And the:</label>
		<select id="<?php echo $id ?>_frequency_day_2" name="<?php echo $id ?>_frequency_day_1">
			<?php
				for($i = 1; $i<32; $i++) {
					?>
					<option value="<?php echo $i ?>" <?php if ($i == 15) echo 'selected'; ?>><?php $helper->nth($i) ?></option>
					<?php
				}
			?>
		</select>
	</div>