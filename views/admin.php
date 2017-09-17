<?php
	require_once(__DIR__ . '/../orm/orm.php');
	$orm = OrmFactory::getInstance();
?>
<head>
	<link rel="stylesheet" type="text/css" href="/css/global.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="/js/global.js"></script>
</head>
<body>
	<h2>Admin</h2>
	<ul>
		<li><a href="#">User Maintenance</a></li>
		<li><a href="#">Account Maintenance</a></li>
		<li><a href="#">Site Configuration</a></li>
		<li><a href="#">Localization</a></li>
		<li>
			<a href="#" data-toggle="timezones" class="clicktoggle">Timezones</a>
			<table id="timezones" class="toggle">
				<tr>
					<th>Timezone</th>
					<td>GMT Offset</td>
				</tr>
				<?php
					$timezones = $orm->getTimezones();
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
