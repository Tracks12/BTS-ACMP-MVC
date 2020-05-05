<?php
	/**
	 * Auteur : CARDINAL Florian
	 * Date   : 02/05/2020 14:01
	 * Page   : index.php
	 */

	require_once('./core/connect.php');
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
	}

	else {
		/**
		 * HTTP Request & Other
		 */

		require_once('./core/HTTPRoute.php');
	}

	/**
	 * END
	 */
