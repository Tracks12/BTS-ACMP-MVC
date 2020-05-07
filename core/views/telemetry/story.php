<!-- STORY -->
<aside id="story">
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
		//Lancement requete
		$data = ACMPModel::getDataByOnceCaptor('3100000000000003');

		//Traitement du resultat
		$listeChart = [];

		foreach($data as $item) { // Fetching de la requête
			// strtotime = conversion datetime vers timestamp
			// intval = conversion string to integer
			$name = $item['name'];                   // Nom de la grandeur
			$unit = $item['unit'];                   // Unité de mesure

			array_push($listeChart, [          //format data pour highchart [x,y],[x,y]...
				strtotime($item['time']) * 1000, // date MySQL * 1000 pour résultat en ms
				intval($item['value'])           // Données du capteurs
			]);
		}
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
					text: '<?php echo($name); ?>',
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
						format: '{value} <?php echo($unit); ?>',
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
					valueSuffix: ' <?php echo($unit); ?>',
				 },

				plotOptions: {
					spline: {
						marker: {
							enabled: false,
						},
					},
				},

				series: [{
					name: '<?php echo($name); ?> (<?php echo($unit); ?>)',
					color: 'red',
					zIndex: 1,
					data: <?php echo(json_encode($listeChart)); ?> // c'est ici qu'on insert les data
				}]
			});
		});
	</script>
</aside>
