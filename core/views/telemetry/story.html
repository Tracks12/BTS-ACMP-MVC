<!-- STORY -->
<aside id="story">
	<!-- balise pour l'affichage du graph -->
	<div id="carbon-chart" style="width: 100%; height: 400px;"></div>
	<div id="ozone-chart" style="width: 100%; height: 400px;"></div>
	<div id="particules-chart" style="width: 100%; height: 400px;"></div>
	<script type="text/javascript">
		var listeChart = [
			{ // CO2
				data: xhr.getDataByOnceCaptor('3100000000000001'),
				render: 'carbon-chart'
			},
			{ // Ozone
				data: xhr.getDataByOnceCaptor('3100000000000002'),
				render: 'ozone-chart'
			},
			{ // Particules Fines
				data: xhr.getDataByOnceCaptor('3100000000000003'),
				render: 'particules-chart'
			}
		];
		var charts = [];

		for(let i = 0; i < listeChart.length; i++)
			charts[i] = new Highcharts.Chart({ // Créer un object HighChart en JS
				chart: {
					renderTo: listeChart[i].render, // Sélectionner la balise html pour l'afficher
					type: 'spline',
					backgroundColor: null
				},

				title: {
					text: listeChart[i].data.name,
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
					labels: {
						format: `{value} ${listeChart[i].data.unit}`,
						style: {
							color: '#C03000'
						}
					},
				}],

				tooltip: {
					shared: true,
					crosshairs: true,
					borderRadius: 6,
					borderWidth: 3,
					xDateFormat: '%A %e %b  %H:%M:%S',
					valueSuffix: ` ${listeChart[i].data.unit}`
				},

				plotOptions: {
					spline: {
						marker: {
							enabled: false
						}
					}
				},

				series: [
					{
						name: listeChart[i].data.name,
						color: listeChart[i].data.color,
						zIndex: 1,
						data: listeChart[i].data.data // c'est ici qu'on insert les data
					}
				]
			});
	</script>
</aside>
