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
			');

			return $req->fetchAll(PDO::FETCH_ASSOC);
		}
	}

	/**
	 * END
	 */
