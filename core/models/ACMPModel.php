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

			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		/**
		 * get last value for a Ozone measure
		 * @return array last ozone value
		 */
		public function getLastValueForOzone(): array {
			$bdd = bdd::connect();
			$req = $bdd->query("CALL `GetLastOzoneData`()");

			return $req->fetchAll(PDO::FETCH_ASSOC)[0];
		}

		/**
		 * get last value for a Carbon measure
		 * @return array last carbon value
		 */
		public function getLastValueForCarbon(): array {
			$bdd = bdd::connect();
			$req = $bdd->query("CALL `GetLastCarbonData`()");

			return $req->fetchAll(PDO::FETCH_ASSOC)[0];
		}

		/**
		 * get last value for a Particules measure
		 * @return array last particules value
		 */
		public function getLastValueForParticules(): array {
			$bdd = bdd::connect();
			$req = $bdd->query("CALL `GetLastParticulesData`()");

			return $req->fetchAll(PDO::FETCH_ASSOC)[0];
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
	}

	/**
	 * END
	 */
