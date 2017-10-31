<!DOCTYPE html>
<head>
	<link rel="stylesheet" type="text/css" href="/css/markdown.css">
</head>
<body>
	<article class="markdown-body entry-content" itemprop="text">
	<?php
		include("config.php");

		$full_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$path = array_map('rawurldecode', explode('/', substr($full_path, 1)));

		$file = file_get_contents(DOC_ROOT . $full_path);

		$payload = array(
			'text' => $file,
			'mode' => 'markdown'
		);

		//print_r($payload);

		$data = json_encode($payload);

		$username = GITHUB_USER;
		$password = GITHUB_PASS;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api.github.com/markdown');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HTTPHEADER,     array('User-Agent: dallascaley@gmail.com'));
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");

		$data = curl_exec($ch);
		curl_close($ch);
	?>
	</article>
</body>