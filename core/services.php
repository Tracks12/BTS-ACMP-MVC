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
		public static function isMail(string $data): bool {
			$return = filter_var($data, FILTER_VALIDATE_EMAIL);

			return $return;
		}

		/**
		 * verify if number is phone number
		 * @param string $data string of phone number
		 * @return int [1/0]
		 */
		public static function isPhone(string $data): int {
			$return = preg_match("/^(([\+]([\d]{2,}))([0-9\.\-\/\s]{5,})|([0-9\.\-\/\s]{5,}))*$/", $data);

			return $return;
		}

		/**
		 * check input parameter
		 * @param string $data string of input parameter
		 * @return string string of output and verify parameter
		 */
		public static function isInput(string $data): string {
			$data = trim($data);
			$data = stripslashes($data);
			$return = htmlspecialchars($data);

			return $return;
		}

		/**
		 * translator for reading database string encrypted
		 * @param string $data string of input parameter
		 * @return string encrypted data
		 */
		public static function pswEncrypt(string $data): string {
			$data = base64_encode($data);
			$data = str_rot13($data);

			return $data;
		}
	}

	/**
	 * END
	 */
