<?php
	include_once(__DIR__ . '/../helper.php');
	$helper = new viewHelper();
?>
<form id="step1-form">
	<label>Rent is usually most people's biggest expense every month. Tell us about yours.</label>
	<input type="text" id="rent" name="rent" placeholder="$"/>
	<label>And when is this due?</label>
	<select id="rent_frequency" name="rent_frequency" class="dependency">
		<option value="none">Choose Timeframe</option>
		<option value="monthly">Every Month</option>
		<option value="weekly">Once per Week</option>
		<option value="daily">Daily</option>
		<option value="bi-monthly">Twice per month</option>
		<option value="bi-weekly">Every other week</option>
		<option value="weekdays">Weekdays Only</option>
		<option value="weekends">Weekends Only</option>
	</select>

	<div class="depends" dependency="rent_frequency" value="bi-weekly,weekly">
		<label>On:</label>
		<select id="rent_frequency_weekday" name="rent_frequency_weekday">
			<option value="0">Sunday</option>
			<option value="1">Monday</option>
			<option value="2">Tuesday</option>
			<option value="3">Wednesday</option>
			<option value="4">Thursday</option>
			<option value="5">Friday</option>
			<option value="6">Saturday</option>
		</select>
	</div>

	<div class="depends" dependency="rent_frequency" value="bi-monthly,monthly">
		<label>On the:</label>
		<select id="rent_frequency_day_1" name="rent_frequency_day_1">
			<?php
				for($i = 1; $i<32; $i++) {
					?>
					<option value="<?php echo $i ?>"><?php $helper->nth($i) ?></option>
					<?php
				}
			?>
		</select>
	</div>

	<div class="depends" dependency="rent_frequency" value="bi-monthly">
		<label>And the:</label>
		<select id="rent_frequency_day_2" name="rent_frequency_day_1">
			<?php
				for($i = 1; $i<32; $i++) {
					?>
					<option value="<?php echo $i ?>" <?php if ($i == 15) echo 'selected'; ?>><?php $helper->nth($i) ?></option>
					<?php
				}
			?>
		</select>
	</div>


	<div><button type="submit" class="go_to_step" id="step1-step2">next</button></div>
</form>