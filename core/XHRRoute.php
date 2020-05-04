<?php
	/**
	 * Auteur : CARDINAL Florian
	 * Date   : 02/05/2020 14:01
	 * Page   : XHRRoute.php
	 */

	switch(services::isInput($_SERVER['REQUEST_URI'])) {
		/**
		 * Redirect URI
		 */

		case '/?getLastValueFor':
			$arr = ACMPModel::getLastValueFor(services::isInput($_POST['measureName']));
			$return = [ "response" => $arr ];
			break;

		default:
			http_response_code(404);
			$return = [ "code" => 404, "error" => "NOT FOUND !" ];
			break;
	}

	switch(http_response_code()) {
		case 200:
			echo(json_encode($return));
			break;

		default:
			echo(json_encode($return));
			die();
			break;
	}

	/**
	 * END
	 */
