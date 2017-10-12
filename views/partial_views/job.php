<?php
	include_once(__DIR__ . '/../helper.php');
	$helper = new viewHelper();
?>
<form id="step2-form">
	<label>Next we'll look at your income.  How much do you make?</label>
	<input type="text" id="income" name="income" placeholder="$"/>
	<label>Every?</label>
	<select id="income_frequency" name="income_frequency">
		<option value="none">Choose Timeframe</option>
		<option value="bi-weekly">Every other week</option>
		<option value="bi-monthly">Twice per month</option>
		<option value="weekly">Every Week</option>
		<option value="daily">Daily</option>
		<option value="monthly">Every Month</option>
		<option value="weekdays">Weekdays Only</option>
		<option value="weekends">Weekends Only</option>
	</select>
	<label>On:</label>
	<select id="income_frequency_weekday" name="income_frequency_weekday">
		<option value="0">Sunday</option>
		<option value="1">Monday</option>
		<option value="2">Tuesday</option>
		<option value="3">Wednesday</option>
		<option value="4">Thursday</option>
		<option value="5">Friday</option>
		<option value="6">Saturday</option>
	</select>
	<label>On the:</label>
	<select id="income_frequency_day_1" name="income_frequency_day_1">
		<?php
			for($i = 1; $i<32; $i++) {
				?>
				<option value="<?php echo $i ?>"><?php $helper->nth($i) ?></option>
				<?php
			}
		?>
	</select>
	<label>And the:</label>
	<select id="income_frequency_day_2" name="income_frequency_day_1">
		<?php
			for($i = 1; $i<32; $i++) {
				?>
				<option value="<?php echo $i ?>"><?php $helper->nth($i) ?></option>
				<?php
			}
		?>
	</select>

	<div><button type="submit" class="go_to_step" id="step2-step3">next</button></div>
</form>