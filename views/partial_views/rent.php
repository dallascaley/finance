<?php
	include_once(__DIR__ . '/../helper.php');
	$helper = new viewHelper();
?>
<form id="step1-form">
	<label>Rent is usually most people's biggest expense every month. Tell us about yours.</label>
	<input type="text" id="rent" name="rent" placeholder="$"/>
	<label>And when is this due?</label>
	<select id="rent_frequency" name="rent_frequency">
		<option value="none">Choose Timeframe</option>
		<option value="monthly">Every Month</option>
		<option value="weekly">Once per Week</option>
		<option value="daily">Daily</option>
		<option value="bi-monthly">Twice per month</option>
		<option value="bi-weekly">Every other week</option>
		<option value="random">WTF! Where you livin?</option>
	</select>
	<label>On the:</label>
	<select id="rent_frequency_day" name="rent_frequency_day">
		<?php
			for($i = 1; $i<32; $i++) {
				?>
				<option value="<?php echo $i ?>"><?php $helper->nth($i) ?></option>
				<?php
			}
		?>
	</select>
	<div><button type="submit" class="go_to_step" id="step1-step2">next</button></div>
</form>