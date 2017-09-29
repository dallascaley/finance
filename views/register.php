<?php
	require_once(__DIR__ . '/../orm/orm.php');
	$orm = OrmFactory::getInstance();

	require_once(__DIR__ . '/../controller/viewController.php');
	$controller = new viewController();
?>
<body>
<form action="api/user" method="POST">
	<div>
		<label>Username</label>
		<input type="text" name="username"/>
	</div>
	<div>
		<label>First Name</label>
		<input type="text" name="first_name"/>
	</div>
	<div>
		<label>Last Name</label>
		<input type="text" name="last_name"/>
	</div>
	<div>
		<label>Password</label>
		<input type="password" name="pass"/>
	</div>
	<div>
		<label>Password (verify)</label>
		<input type="password" name="pass_verify"/>
	</div>
	<div>
		<label>Timezone</label>
		<select>
		<?php
			$timezones = $orm->read('timezones');
			foreach ($timezones as $timezone) {

				?>
				<option value="<?php echo $timezone['utc_offset'] ?>"><?php echo $timezone['name'] ?></option>
				<?php
			}
		?>
		</select>
	<input type="submit" value="Submit"/>
</form>
</body>
