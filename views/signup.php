<?php
	require_once(__DIR__ . '/../orm/orm.php');
	$orm = OrmFactory::getInstance();

	require_once(__DIR__ . '/../controller/viewController.php');
	$controller = new viewController();
?>
<body>
<div>
	<h2>Create Account</h2>
	<form id="signup-form">
		<label>Username</label>
		<input type="text" name="username"/>
		<label>First Name</label>
		<input type="text" name="first_name"/>
		<label>Last Name</label>
		<input type="text" name="last_name"/>
		<label>Email</label>
		<input type="text" name="email"/>
		<label>Password</label>
		<input type="password" name="password"/>
		<label>Verify Password</label>
		<input type="password" name="password2"/>
		<label>Timezone</label>
		<select>
		<?php
			$session = $controller->session('read');

			$timezones = $orm->read('timezones');
			foreach ($timezones as $timezone) {
				$selected = ($session['utc_offset'] == $timezone['utc_offset']) ? 'selected' : '';
				?>
				<option value="<?php echo $timezone['utc_offset'] ?>" <?php echo $selected ?>>
					<?php echo $timezone['name'] .' '. $orm->display('utc_offset', $timezone['utc_offset']) ?>
				</option>
				<?php
			}
		?>
		</select>
		<label>Language</label>
		<select>
		<?php
			$localizations = $controller->localization('read');
			foreach ($localizations as $localization) {
				?>
				<option value="<?php echo $localization['name'] ?>"><?php echo $localization['name'] ?></option>
				<?php
			}
		?>
		</select>
		<div>
			<input type="submit" value="Submit"/>
		</div>
	</form>
</div>
</body>