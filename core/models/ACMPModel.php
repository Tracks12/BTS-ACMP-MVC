<?php
	/**
	 * Auteur : CARDINAL Florian
	 * Date   : 02/05/2020 14:01
	 * Page   : ACMPModel.php
	 */

	class ACMPModel extends bdd {
		/**
		 * get return of captors table
		 * @return array captors
		 */
		public function getCaptors(): array {
			$bdd = bdd::connect();
			$req = $bdd->query('
				SELECT *
				FROM `captors`
				WHERE 1
			');

			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getMeasuresName(): array {
			$bdd = bdd::connect();
			$req = $bdd->query('
				SELECT *
				FROM `measuresName`
				WHERE 1
			');

			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		/**
		 * get return of datas by captors
		 * @return array datas by captors
		 */
		public function getDataByCaptor(): array {
			$bdd = bdd::connect();
			$req = $bdd->query('CALL `listDataByCaptor`()');

			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		/**
		 * get return of last datas by captors
		 * @return array datas by captors
		 */
		public function getLastDataByCaptor(): array {
			$bdd = bdd::connect();
			$req = $bdd->query('CALL `listLastDataByCaptor`()');

			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		/**
		 * get return of datas of one captors
		 * @param string $captor captor name
		 * @return array datas of captor
		 */
		public function getDataByOnceCaptor(string $captor): array {
			$bdd = bdd::connect();
			$req = $bdd->query("CALL `listDataByOnceCaptor`('$captor')");

			$data = $req->fetchAll(PDO::FETCH_ASSOC);

			$return = [
				"color" => NULL,
				"name"  => NULL,
				"unit"  => NULL,
				"data"  => []
			];

			foreach($data as $item) {
				switch($item['name']) {
					case 'Particules Fines': $return["color"] = "blue"; break;
					case 'Ozone': $return["color"] = "green"; break;
					case 'CO2': $return["color"] = "red"; break;
					default: $return["color"] = "grey"; break;
				}

				$return["name"] = $item['name'];
				$return["unit"] = $item['unit'];

				array_push($return["data"], [
					strtotime($item['time']) * 1000,
					floatval($item['value'])
				]);
			}

			return $return;
		}

		/**
		 * get last value for a physic measure
		 * @param string $measureName measure name
		 * @return array last value
		 */
		public function getLastValueFor(string $measureName): array {
			$bdd = bdd::connect();
			$req = $bdd->query("CALL `GetLastData`('$measureName')");

			return $req->fetchAll(PDO::FETCH_ASSOC)[0];
		}

		/**
		 * get last value for a physic measure
		 * @return array last value
		 */
		public function getLastValues(): array {
			$bdd = bdd::connect();
			$req = $bdd->query("CALL `GetLastAllData`()");

			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		/**
		 * get list of login table
		 * @return array all login rows
		 */
		public function getLogin(): array {
			$bdd = bdd::connect();
			$req = $bdd->query('
				SELECT `idUser`, `nichandle`, `password`, `isAdmin`
				FROM `users`
			');

			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		/**
		 * update user last connexion time
		 * @param int user id to apply
		 * @return bool [true/false]
		 */
		public function uptLoginLastConnect(int $id): bool {
			$bdd = bdd::connect();
			$req = $bdd->prepare("
				UPDATE `users`
				SET `lastConnect` = ?, `lastAddr` = ?
				WHERE `idUser` = ?
			");

			return $req->execute([date("Y-m-d H:i:s", time()), $_SERVER['REMOTE_ADDR'], $id]);
		}
	}

	/**
	 * END
	 */
