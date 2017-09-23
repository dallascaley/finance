<?php
	require_once(__DIR__ . '/../orm/orm.php');
	$orm = OrmFactory::getInstance();
?>
<body>
	<h2>Admin</h2>
	<ul>
		<li><a href="#">User Maintenance</a></li>
		<li><a href="#">Account Maintenance</a></li>
		<li><a href="#">Site Configuration</a></li>
		<li>
			<a href="#" id="choose_localization" data-toggle="localizations" class="clicktoggle">Localization</a>
			<div id="localizations" class="toggle">
				Current Localizations:
				<ul>
				</ul>
				<input type="button" id="add_localization" value="Add Localization"/>
				<div id="localization_add_block" class="toggle">
					<input type="text" name="localization"/><br/>
					<input type="button" id="submit_localization" value="Submit"/>
				</div>
			</div>
		</li>
		<li>
			<a href="#" data-toggle="timezones" class="clicktoggle">Timezones</a>
			<table id="timezones" class="toggle">
				<tr>
					<th>Timezone</th>
					<td>GMT Offset</td>
				</tr>
				<?php
					$timezones = $orm->read('timezones');
					foreach ($timezones as $timezone) {
						?>
						<tr>
							<td><?php echo $timezone['name'] ?></td>
							<td><?php echo $timezone['utc_offset'] ?></td>
						</tr>
						<?php
					}
				?>
			</table>
		</li>
	</ul>
</body>
