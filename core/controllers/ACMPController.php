<?php
	/**
	 * Auteur : CARDINAL Florian
	 * Date   : 02/05/2020 14:01
	 * Page   : ACMPController.php
	 */

	class ACMPController {
		/**
		 * contact form controller
		 * @param array $data array of post request
		 * @return array json result of request
		 */
		public function insertCaptor(array $data): array {
			$post = [
				"value"		=> [

				],
				"error"		=> [

				],
				"passed"	=> true
			];

			return $post;
		}
	}

	/**
	 * END
	 */
