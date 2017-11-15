<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require_once('registry.php');

	session_start();

	$full_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$path = array_map('rawurldecode', explode('/', substr($full_path, 1)));

	$filename_parts = explode('.', $path[(count($path) - 1)]);
	$extension = array_pop($filename_parts);

	switch (true) {
		case ($extension == 'md'):
			require_once(__DIR__ . '/markdown.php');
		break;
		case ($path[0] == 'api'):
			require_once(__DIR__ . '/api/router.php');

			$router = new router($path);
			$router->routeRequest();
		break;
		default:
		?>
			<!DOCTYPE html>
			<head>
				<link rel="stylesheet" type="text/css" href="/tools/bootstrap/css/bootstrap.min.css">
				<link rel="stylesheet" type="text/css" href="/css/global.css">
				<link rel="stylesheet" type="text/css" href="/tools/jquery-ui-1.12.1.custom/jquery-ui.min.css">
				<link rel="stylesheet" type="text/css" href="/tools/jquery-ui-1.12.1.custom/jquery-ui.structure.min.css">
				<link rel="stylesheet" type="text/css" href="/tools/jquery-ui-1.12.1.custom/jquery-ui.theme.min.css">
				<?php
					$css_path = str_replace('.php', '.css', $full_path);
					if (file_exists(__DIR__ . '/css' . $css_path)) {
						echo '<link rel="stylesheet" type="text/css" href="/css' . $css_path . '">';
					}
				?>

				<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
				<script src="/tools/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
				<script src="/tools/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
				<script src="/js/jquery.validate.min.js"></script>
				<script src="/tools/jquery-validation-1.17.0/src/additional/currency.js"></script>
				<script src="/tools/bootstrap/js/bootstrap.min.js"></script>
				<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js"></script>
				<script src="/js/global.js"></script>
				<?php
					$js_path = str_replace('.php', '.js', $full_path);
					if (file_exists(__DIR__ . '/js' . $js_path)) {
						echo '<script src="/js' . $js_path . '"></script>';
					}
					if ($js_path == '/') {
						echo '<script src="/js/home.js"></script>';
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
		break;
	}		
?>
