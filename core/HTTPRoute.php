<?php
	/**
	 * Auteur : CARDINAL Florian
	 * Date   : 02/05/2020 14:01
	 * Page   : HTTPRoute.php
	 */

	$page = 'index.php';

	/**
	 * Redirect URI
	 */
	switch(services::isInput($_SERVER['REQUEST_URI'])) {
		/**
		 * Link's Resources
		 */
		case "/github": // GitHub Page Link
			header("location: https://github.com/Tracks12/BTS-ACMP-MVC");
			break;

		case "/ui": // Node Red UI Link
			header("location: http://{$_SERVER['HTTP_HOST']}:1880/ui");
			break;

		case "/node-red": // Node Red UI Link
			header("location: http://{$_SERVER['HTTP_HOST']}:1880/");
			break;

		/**
		 * Page's Resources
		 */
		case "/map": // About Page
			http_response_code(200);
			$page = 'map.html';
			break;

		case "/telemetry": // About Page
			http_response_code(200);
			$page = 'telemetry/telemetry.php';
			break;

		case "/instant": // About Page
			http_response_code(200);
			$page = 'telemetry/instant.php';
			break;

		case "/story": // About Page
			http_response_code(200);
			$page = 'telemetry/story.php';
			break;

		case "/captors": // About Page
			if(isset($_SESSION['isAdmin'])) {
				http_response_code(200);
				$page = 'captors/captors.php';
			}

			else
				http_response_code(404);

			break;

		case "/about": // About Page
			http_response_code(200);
			$page = 'about/about.php';
			break;

		/**
		 * System Info
		 */
		case '/log':
			if(isset($_SESSION['isAdmin'])) {
				echo("<pre>".log::read()."</pre>");
				die();
			} break;
	}

	switch(http_response_code()) {
		case 200:
			require_once("./core/views/{$page}");
			break;

		case 403:
		case 404:
			require_once('./core/views/error.php');
			break;

		default:
			die();
			break;
	}

	/**
	 * END
	 */
