<?php
	/**
	 * Auteur : CARDINAL Florian
	 * Date   : 02/05/2020 14:01
	 * Page   : services.php
	 */

	define('AES_256_CBC', 'aes-256-cbc');

	class services {
		/**
		 * verify if mail is valid
		 * @param string $data string of mail
		 * @return bool [true/false]
		 */
		public static function isMail($data) {
			$return = filter_var($data, FILTER_VALIDATE_EMAIL);

			return $return;
		}

		/**
		 * verify if number is phone number
		 * @param string $data string of phone number
		 * @return bool [true/false]
		 */
		public static function isPhone($data) {
			$return = preg_match("/^(([\+]([\d]{2,}))([0-9\.\-\/\s]{5,})|([0-9\.\-\/\s]{5,}))*$/", $data);

			return $return;
		}

		/**
		 * check input parameter
		 * @param string $data string of input parameter
		 * @return string string of output and verify parameter
		 */
		public static function isInput($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$return = htmlspecialchars($data);

			return $return;
		}
	}

	/**
	 * END
	 */
