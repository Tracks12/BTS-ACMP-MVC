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
			$req = $bdd->query('
				SELECT `id`, `Name`, `value`, `rssi`, `lat`, `lon`, `time`
				FROM `data`
				JOIN `captors` ON `captors`.idCaptor = `data`.idCaptor
				JOIN `measures` ON `measures`.idMeasure = `data`.idMeasure
				JOIN `measuresName` ON `measuresName`.idName = `measures`.idName
				WHERE 1
				ORDER BY `measures`.idMeasure
				DESC
			');

			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		/**
		 * get return of datas of one captors
		 * @param string $captor captor name
		 * @return array datas of captor
		 */
		public function getDataByOnceCaptor(string $captor): array {
			$bdd = bdd::connect();
			$req = $bdd->query("
				SELECT `id`, `Name`, `value`, `rssi`, `lat`, `lon`, `time`
				FROM `data`
				JOIN `captors` ON `captors`.idCaptor = `data`.idCaptor
				JOIN `measures` ON `measures`.idMeasure = `data`.idMeasure
				JOIN `measuresName` ON `measuresName`.idName = `measures`.idName
				WHERE `captors`.id = '$captor'
				ORDER BY `measures`.idMeasure
				DESC
			");

			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		/**
		 * get last value for a physic measure
		 * @param string $measureName measure name
		 * @return array last value
		 */
		public function getLastValueFor(string $measureName): array {
			$bdd = bdd::connect();
			$req = $bdd->query("
				SELECT `Name`, `value`
				FROM `measures`
				JOIN `measuresName` ON `measures`.idName = `measuresName`.idName
				WHERE `measuresName`.Name = '$measureName'
				ORDER BY `measures`.idMeasure
				DESC
				LIMIT 1
			");

			return $req->fetchAll(PDO::FETCH_ASSOC)[0];
		}
	}

	/**
	 * END
	 */
