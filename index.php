<?php
	/**
	 * Auteur : CARDINAL Florian
	 * Date   : 02/05/2020 14:01
	 * Page   : index.php
	 */

	declare(strict_types = 1);

	require_once('./core/connect.php');
	require_once('./core/logger.php');
	require_once('./core/services.php');
	require_once('./core/models/ACMPModel.php');

	session_start();

	if(
		!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
		&& (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
		&& (strtolower($_SERVER['REQUEST_METHOD']) === 'post')
	) {
		/**
		 * XHR Request Only
		 */

		require_once('./core/controllers/ACMPController.php');
		require_once('./core/XHRRoute.php');
		log::write('XHR');
	}

	else {
		/**
		 * HTTP Request & Other
		 */

		require_once('./core/HTTPRoute.php');
		log::write(strtoupper($_SERVER['REQUEST_SCHEME']));
	}

	/**
	 * END
	 */
