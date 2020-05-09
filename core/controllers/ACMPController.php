<?php
	/**
	 * Auteur : CARDINAL Florian
	 * Date   : 02/05/2020 14:01
	 * Page   : ACMPController.php
	 */

	class ACMPController {
		/**
		 * captor insert form controller
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

		/**
		 * signin form controller
		 * @param string $data array of post request
		 * @return array json result of request
		 */
		public function signin(string $data): array {
			$listLogin = ACMPModel::getLogin();

			$data = base64_decode($data);
			$data = preg_split("/[\s,&]+/", $data);

			foreach($data as $item) {
				$split = preg_split("/[\s,=]+/", $item);
				$data[$split[0]] = $split[1];
			}

			$post = [
				"value"		=> [
					'uname'	=> services::isInput($data['uname']),
					'upass'	=> services::pswEncrypt(services::isInput($data['upass']))
				],
				"error"		=> "connexion refusée",
				"passed"	=> false
			];

			foreach($listLogin as $item) {
				if(
					$post['value']['uname'] === $item['nichandle']
					&& $post['value']['upass'] === $item['password']
				) {
					$post = [
						"value"		=> [
							"uname"			=> $item['nichandle'],
							"lastAddr"	=> $_SERVER['REMOTE_ADDR'],
							"isAdmin"		=> boolval($item['isAdmin'])
						],
						"error"		=> NULL,
						"passed"	=> ACMPModel::uptLoginLastConnect(intVal($item['idUser']))
					];

					$_SESSION = $post['value'];
				}
			}

			return $post;
		}
	}

	/**
	 * END
	 */
