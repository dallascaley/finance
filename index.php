<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	$full_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$path = array_map('rawurldecode', explode('/', substr($full_path, 1)));

	if ($path[0] == 'api') {
		require_once(__DIR__ . '/api/router.php');

		$router = new router($path);
		$router->routeRequest();
	} else {
		?>
		<head>
			<link rel="stylesheet" type="text/css" href="/css/global.css">
			<link rel="stylesheet" type="text/css" href="/tools/bootstrap/css/bootstrap.min.css">

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<script src="/tools/bootstrap/js/bootstrap.min.js"></script>
			<script src="/js/global.js"></script>
		</head>
		<?php
		switch (true) {
			case ($full_path == '/'):
				include(__DIR__ . '/views/home.php');
			break;
			case (file_exists(__DIR__ . '/views/' . $full_path)):
				include(__DIR__ . '/views/' . $full_path);
			break;
			default:
				include(__DIR__ . '/views/home.php');
			break;
		}
	}
?>
