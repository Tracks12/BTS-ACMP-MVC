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
			$page = 'telemetry/telemetry.html';
			break;

		case "/once": // About Page
			http_response_code(200);
			$page = 'telemetry/once.html';
			break;

		case "/instant": // About Page
			http_response_code(200);
			$page = 'telemetry/instant.html';
			break;

		case "/story": // About Page
			http_response_code(200);
			$page = 'telemetry/story.html';
			break;

		case "/admin": // Captors Manager Page
			if(isset($_SESSION['isAdmin'])) {
				http_response_code(200);
				$page = 'admin/admin.html';
			}

			else
				http_response_code(404);

			break;

		case "/captors": // Captors Manager Page
			if(isset($_SESSION['isAdmin'])) {
				http_response_code(200);
				$page = 'admin/captors.html';
			}

			else
				http_response_code(404);

			break;

		case "/users": // Users Manager Page
			if(isset($_SESSION['isAdmin'])) {
				http_response_code(200);
				$page = 'admin/users.html';
			}

			else
				http_response_code(404);

			break;

		case "/about": // About Page
			http_response_code(200);
			$page = 'about/about.php';
			break;
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
