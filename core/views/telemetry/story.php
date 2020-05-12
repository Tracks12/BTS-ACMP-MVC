<!-- STORY -->
<aside id="story">
	<h2>story</h2>
	<article>
		<h5>Historique</h5>
		<p>Cette page permet de visualiser toutes les mesures effectués par les trois capteurs.</p>
	</article>
	<br />
	<?php
		//Lancement requete
		$data = [
			ACMPModel::getDataByOnceCaptor('3100000000000001'),
			ACMPModel::getDataByOnceCaptor('3100000000000002'),
			ACMPModel::getDataByOnceCaptor('3100000000000003')
		];

		//Traitement du resultat
		$listeChart = [
			[
				"color" => "red",
				"name"  => NULL,
				"unit"  => NULL,
				"data"  => []
			],
			[
				"color" => "green",
				"name"  => NULL,
				"unit"  => NULL,
				"data"  => []
			],
			[
				"color" => "blue",
				"name"  => NULL,
				"unit"  => NULL,
				"data"  => []
			]
		];

		for($i = 0; $i < count($data); $i++) {
			foreach($data[$i] as $item) { // Fetching de la requête
				// strtotime = conversion datetime vers timestamp
				// intval = conversion string to integer
				$listeChart[$i]["name"] = $item['name']; // Nom de la grandeur
				$listeChart[$i]["unit"] = $item['unit']; // Unité de mesure

				array_push($listeChart[$i]["data"], [    //format data pour highchart [x,y],[x,y]...
					strtotime($item['time']) * 1000,       // date MySQL * 1000 pour résultat en ms
					intval($item['value'])                 // Données du capteurs
				]);
			}
		}
	?>

	<!-- balise pour l'affichage du graph -->
	<div id="chart1" style="width: 100%; height: 400px;"></div>

	<script type="text/javascript">
		$(() => { // fonction en javascript
			chart1 = new Highcharts.Chart({ // Créer un object HighChart en JS
				chart: {
					renderTo: 'chart1', // Sélectionner la balise html pour l'afficher
					type: 'spline',
					backgroundColor: null
				},

				title: {
					text: '<?php echo("{$listeChart[0]["name"]}, {$listeChart[1]["name"]}, {$listeChart[2]["name"]}"); ?>',
					style:{
						color: '#4572A7'
					}
				},

				legend: { // La légende
					enabled: true,
					backgroundColor: 'white',
					borderRadius: 14
				},

				xAxis: {
					type: 'datetime',
					dateTimeLabelFormats: {
						month: '%e. %b', // Formatage sur le mois
						year: '%b' // Formatage sur l'année
					}
				},

				yAxis: [{
					<?php for($i = 0; $i < count($listeChart); $i++) { ?>
					labels: {
						format: '{value} <?php echo($listeChart[$i]["unit"]); ?>',
						style: {
							color: '#C03000'
						}
					},
					<?php } ?>
				}],

				tooltip: {
					shared: true,
					crosshairs: true,
					borderRadius: 6,
					borderWidth: 3,
					xDateFormat: '%A %e %b  %H:%M:%S',
					valueSuffix: ''
				},

				plotOptions: {
					spline: {
						marker: {
							enabled: false
						}
					}
				},

				series: [
					<?php for($i = 0; $i < count($listeChart); $i++) { ?>
					{
						name: '<?php echo("{$listeChart[$i]["name"]} ({$listeChart[$i]["unit"]})"); ?>',
						color: '<?php echo($listeChart[$i]["color"]); ?>',
						zIndex: 1,
						data: <?php echo(json_encode($listeChart[$i]["data"])); ?> // c'est ici qu'on insert les data
					},
					<?php } ?>
				]
			});
		});
	</script>
</aside>
