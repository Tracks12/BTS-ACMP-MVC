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
		public function getCaptors() {
			$bdd = bdd::connect();
			$req = $bdd->query('
				SELECT *
				FROM `captors`
				WHERE 1
			');

			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		/**
		 * get return of datas by captors
		 * @return array datas by captors
		 */
		public function getDataByCaptor() {
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
	}

	/**
	 * END
	 */
