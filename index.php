<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require_once('registry.php');

	session_start();

	$full_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$path = array_map('rawurldecode', explode('/', substr($full_path, 1)));

	if ($path[0] == 'api') {
		require_once(__DIR__ . '/api/router.php');

		$router = new router($path);
		$router->routeRequest();
	} else {
		?>
		<head>
			<link rel="stylesheet" type="text/css" href="/tools/bootstrap/css/bootstrap.min.css">
			<link rel="stylesheet" type="text/css" href="/css/global.css">
			<?php
				$css_path = str_replace('.php', '.css', $full_path);
				if (file_exists(__DIR__ . '/css' . $css_path)) {
					echo '<link rel="stylesheet" type="text/css" href="/css' . $css_path . '">';
				}
			?>

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<!--<script src="/tools/jquery-validation-1.17.0/dist/jquery.validate.min.js"></script>-->
			<script src="/js/jquery.validate.min.js"></script>
			<script src="/tools/bootstrap/js/bootstrap.min.js"></script>
			<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js"></script>
			<script src="/js/global.js"></script>
			<?php
				$js_path = str_replace('.php', '.js', $full_path);
				if (file_exists(__DIR__ . '/js' . $js_path)) {
					echo '<script src="/js' . $js_path . '"></script>';
				}
			?>
		</head>
		<?php
		require_once(__DIR__ . '/controller/viewController.php');
		$controller = new viewController();

		require_once(__DIR__ . '/views/helper.php');
		$helper = new viewHelper();

		$user = $controller->user('read');

		$include = __DIR__ . '/views/home.php';

		if ($full_path != '/' && file_exists(__DIR__ . '/views/' . $full_path)) {
			$include = __DIR__ . '/views/' . $full_path;
		}
		include($include);

	}
?>
