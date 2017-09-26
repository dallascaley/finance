<?php
	require_once(__DIR__ . '/../orm/orm.php');
	$orm = OrmFactory::getInstance();
?>
<body>
<div>
	<h2>Create Account</h2>
	<form id="signup-form">
		<label>Username</label>
		<input type="text" name="username"/>
		<label>Email</label>
		<input type="text" name="email"/>
		<label>Password</label>
		<input type="password" name="password"/>
		<label>Verify Password</label>
		<input type="password2" name="password2"/>
		<label>Timezone</label>
		<select>
		<?php
			$timezones = $orm->read('timezones');
			foreach ($timezones as $timezone) {
				?>
				<option value="<?php echo $timezone['name'] ?>">
					UTC <?php echo $orm->display('utc_offset', $timezone['utc_offset']) ?> -- <?php echo $timezone['name'] ?>
				</option>
				<?php
			}
		?>
		</select>
		<label>Language</label>
		<select>
		<?php
			$languages = $orm->read('localizations');
			foreach ($languages as $language) {
				?>
				<option value="<?php echo $language['name'] ?>">
					<?php echo $language['name'] ?>
				</option>
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