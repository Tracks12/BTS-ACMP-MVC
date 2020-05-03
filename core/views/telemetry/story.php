<!-- STORY -->
<aside>
	<h2>story</h2>
	<article>
		<!--(texte expliquant comment fonctionne ce graphique)-->
		<h5>Futur graphique a particules fines</h5>
		<p>
			On désigne par le terme « particule » un ensemble de substances particulaires microscopiques.</br>
			Ces substances sont solides ou liquides et restent en suspension dans l’air en général de quelques jours à quelques années.</br>
			Le mot « particule » englobe un ensemble de composés variés.</br>
			Plus les particules sont petites, plus elles pénètrent facilement dans nos poumons.</br>
			Certains types de particules semblent plus nuisibles que d’autres : c’est le cas, par exemple, de celles issues de la combustion (suies) du charbon, du diesel et du bois.</br>
			Elles sont alors d’autant plus nocives pour notre santé ou l’environnement...
		</p>
	</article>
	<br />
	<?php
		// Connexion à la base
		try {
			$bdd = new PDO( // PDO (Programmation Data Object)
				'mysql:host=localhost; dbname=capteur; charset=utf8',
				'acmp',
				'projet2020-'
			);
		}

		// Affichage de l'erreur de connexion
		catch(Exception $e) {
			die("[Err]:[{$e->getmessage()}]");
		}

		//Lancement requete
		$reponse = $bdd->query('
			SELECT `id`, `Name`, `value`, `rssi`, `lat`, `lon`, `time`
			FROM `data`
			JOIN `captors` ON `captors`.idCaptor = `data`.idCaptor
			JOIN `measures` ON `measures`.idMeasure = `data`.idMeasure
			JOIN `measuresName` ON `measuresName`.idName = `measures`.idName
			WHERE `measuresName`.`idName` = 3
			ORDER BY `measures`.idMeasure
			ASC
			LIMIT 4000
		');

		//Traitement du resultat
		$listeTable = [];
		$listeChart = [];

		foreach($reponse->fetchAll(PDO::FETCH_ASSOC) as $item) { // Fetching de la requête
			// strtotime = conversion data vers timestamp
			$date = strtotime($item['time']) * 1000; // date MySQL * 1000 pour résultat en ms
			$valeurs = $item['value'];               //données des capteurs

			array_push($listeTable, [$date, $valeurs]);   //format data pour le tableau
			array_push($listeChart, "[$date, $valeurs]"); //format data pour highchart [x,y],[x,y]...
		}

		//Termine le traitement de la requête
		$reponse->closeCursor();

		echo("<table>");
		echo("<tr>
			<th>timestamp</th>
			<th>valeur (ppm)</th>
		</tr>");

		// Affiche les données
		foreach($listeTable as $row) { // On sort une ligne
			echo("<tr>");

			foreach($row as $col) // on sort une colonne
				echo("<td>$col</td>");

			echo("</tr>");
		}

		echo("</table>");
	?>

	<!-- balise pour l'affichage du graph -->
	<div id="chart1" style="width:100%; height:400px;"></div>

	<script type="text/javascript">
		$(() => {	// fonction en javascript
			chart1 = new Highcharts.Chart({	// Créer un object HighChart en JS
				chart: {
					renderTo: 'chart1',	// Sélectionner la balise html pour l'afficher
					type: 'spline',
					backgroundColor: null,
				},

				title: {
					text: 'Particules Fines',
					style:{
						color: '#4572A7',
					},
				},

				legend: {	// La légende
					enabled: true,
					backgroundColor: 'white',
					borderRadius: 14,
				},

				xAxis: {
					type: 'datetime',
					dateTimeLabelFormats: {
						month: '%e. %b',	// Formatage sur le mois
						year: '%b',	// Formatage sur l'année
					}
				 },

				yAxis: [{
					labels: {
						format: '{value} ppm',
						style: {
							color: '#C03000',
						},
					},
					title: {
						text: '',
						style: {
							color: '#C03000',
						},
					}
				}],

				tooltip: {
					shared: true,
					crosshairs: true,
					borderRadius: 6,
					borderWidth: 3,
					xDateFormat: '%A %e %b  %H:%M:%S',
					valueSuffix: ' ppm',
				 },

				plotOptions: {
					spline: {
						marker: {
							enabled: false,
						},
					},
				},

				series: [{
					name: 'Particules Fines',
					color: 'red',
					zIndex: 1,
					data: [<?php echo(join(',', $listeChart)); ?>] // c'est ici qu'on insert les data
				}]
			});
		});
	</script>
</aside>
