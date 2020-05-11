<?php
	/**
	 * Auteur : CARDINAL Florian
	 * Date   : 10/05/2020 17:41
	 * Page   : logger.php
	 */

	class log {
		/**
		 * write in log file
		 * @return bool NULL
		 */
		public static function write(string $type): bool {
			self::$handle = fopen(self::$path, 'a');
			$time = date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME_FLOAT']);
			$response = http_response_code();

			self::$content = [
				"[$time] - ",
				"[$response]",
				":[{$_SERVER['REMOTE_ADDR']}]",
				":[$type]",
				":[{$_SERVER['REQUEST_METHOD']}]",
				":[{$_SERVER['REQUEST_URI']}]",
				"\n"
			];

			fwrite(self::$handle, join(self::$content, ''));
			fclose(self::$handle);

			return true;
		}

		// Log File Info's
		private static $handle = NULL;
		private static $path = './.logs';
		private static $content = NULL;
	}

	/**
	 * END
	 */
