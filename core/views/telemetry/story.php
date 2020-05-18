<!-- STORY -->
<aside id="story">
	<!-- balise pour l'affichage du graph -->
	<div id="carbon-chart" style="width: 100%; height: 400px;"></div>
	<div id="ozone-chart" style="width: 100%; height: 400px;"></div>
	<div id="particules-chart" style="width: 100%; height: 400px;"></div>
	<script type="text/javascript">
		var listeChart = [
			xhr.getDataByOnceCaptor('3100000000000001'),
			xhr.getDataByOnceCaptor('3100000000000002'),
			xhr.getDataByOnceCaptor('3100000000000003')
		];

		var carbonChart = new Highcharts.Chart({ // Créer un object HighChart en JS
			chart: {
				renderTo: 'carbon-chart', // Sélectionner la balise html pour l'afficher
				type: 'spline',
				backgroundColor: null
			},

			title: {
				text: listeChart[0].name,
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
					format: `{value} ${listeChart[0].unit}`,
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
				valueSuffix: ` ${listeChart[0].unit}`
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
					name: listeChart[0].name,
					color: listeChart[0].color,
					zIndex: 1,
					data: listeChart[0].data // c'est ici qu'on insert les data
				}
			]
		});

		var ozoneChart = new Highcharts.Chart({ // Créer un object HighChart en JS
			chart: {
				renderTo: 'ozone-chart', // Sélectionner la balise html pour l'afficher
				type: 'spline',
				backgroundColor: null
			},

			title: {
				text: listeChart[1].name,
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
					format: `{value} ${listeChart[1].unit}`,
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
				valueSuffix: ` ${listeChart[1].unit}`
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
					name: listeChart[1].name,
					color: listeChart[1].color,
					zIndex: 1,
					data: listeChart[1].data // c'est ici qu'on insert les data
				}
			]
		});

		var particulesChart = new Highcharts.Chart({ // Créer un object HighChart en JS
			chart: {
				renderTo: 'particules-chart', // Sélectionner la balise html pour l'afficher
				type: 'spline',
				backgroundColor: null
			},

			title: {
				text: listeChart[2].name,
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
					format: `{value} ${listeChart[2].unit}`,
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
				valueSuffix: ` ${listeChart[2].unit}`
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
					name: listeChart[2].name,
					color: listeChart[2].color,
					zIndex: 1,
					data: listeChart[2].data // c'est ici qu'on insert les data
				}
			]
		});
	</script>
</aside>
