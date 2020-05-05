<!--
(c) 2019-2020 Flore Philippe
 Solid Gauge
 -->
<!DOCTYPE html>
<!-- INSTANT -->
<aside id="instant">
	<br />
	<p class="highcharts-description">Capteur de Co2</p>
	<figure class="highcharts-figure">
		<div id="carbon" class="chart-container"></div>
		<p class="highcharts-description">
			Chart demonstrating solid gauges with dynamic data. Two separate charts
			are used, and each is updated dynamically every few seconds. Solid
			gauges are popular charts for dashboards, as they visualize a number
			in a range at a glance. As demonstrated by these charts, the color of
			the gauge can change depending on the value of the data shown.
		</p>
	</figure>
	<br />
	<figure class="highcharts-figure">
		<div id="ozonne" class="chart-container"></div>
		<p class="highcharts-description">
			Chart demonstrating solid gauges with dynamic data. Two separate charts
			are used, and each is updated dynamically every few seconds. Solid
			gauges are popular charts for dashboards, as they visualize a number
			in a range at a glance. As demonstrated by these charts, the color of
			the gauge can change depending on the value of the data shown.
		</p>
	</figure>
	<br />
	<figure class="highcharts-figure">
		<div id="particules" class="chart-container"></div>
		<p class="highcharts-description">
			Chart demonstrating solid gauges with dynamic data. Two separate charts
			are used, and each is updated dynamically every few seconds. Solid
			gauges are popular charts for dashboards, as they visualize a number
			in a range at a glance. As demonstrated by these charts, the color of
			the gauge can change depending on the value of the data shown.
		</p>
	</figure>

	<aside> <!-- aside pour faire un box ou un conteneur -->
		<article> <!-- le contenu (paragraphe, image etc...) -->
			<div id="container">
				<h5> Explication du graphique Co2 : </h5>
				<h6>  Graphique Highcharts montrant une jauge solide avec des données dynamiques. Une carte distincte est utilisée et elle est mise à jour dynamiquement toutes les quelques secondes. Comme le montre ce graphique, la couleur de la jauge peut changer en fonction de la valeur des données affichées.
					<br>
					Une émission de dioxyde de carbone est un rejet de ce gaz dans l'atmosphère terrestre, quelle qu'en soit la source. Le dioxyde de carbone (CO2) est le deuxième gaz à effet de serre le plus important dans l'atmosphère, après la vapeur d'eau, les deux contribuant respectivement à hauteur de 26 % et 60 % à l'effet de serre.
					<br> Ce graphique a pour but de montrer la concentration de Co2 dans l'atmosphère à l'aide d'une base de données sur un point donnés par la map où une carte est disposée comportant le capteur de Co2. L'unité du dioxyde de carbone est le "ppm".
						 Nous voyons donc grâce à cette jauge les dernières valeurs en live.
				</h6>
				</p>
			</div>
		</article>
		<article>
			<div id="image">
				<img src="images/co2.jpg"
				alt="co2"
				width="50"
				height="50">
			</div>
		</article>
	</aside>
	<footer>
		<p id="footer"> Copyright Flore Philippe alias Flopicx; BTS SN opt: électronique et communication </p>
	</footer>
	<!-- Texte javascript -->
	<script type="text/javascript">
		// CO2
		var carbon = Highcharts.chart('carbon', Highcharts.merge(gaugeOptions, {
			yAxis: {
				min: 0,
				max: 100000,
				title: {
					text: 'CO2'
				}
			},

			credits: {
				enabled: false
			},

			series: [{
				name: 'CO2',
				data: [<?php echo(ACMPModel::getLastValueFor('CO2')['value']); ?>],
				dataLabels: {
					format:
						'<div style="text-align:center">' +
						'<span style="font-size:25px">{y}</span><br/>' +
						'<span style="font-size:12px;opacity:0.4">ppm</span>' +
						'</div>'
				},
				tooltip: {
					valueSuffix: ' ppm'
				}
			}]
		}));

		// Ozone
		var ozone = Highcharts.chart('ozonne', Highcharts.merge(gaugeOptions, {
			yAxis: {
				min: 0,
				max: 200,
				title: {
					text: 'Ozone'
				}
			},

			credits: {
				enabled: false
			},

			series: [{
				name: 'Ozone',
				data: [<?php echo(ACMPModel::getLastValueFor('Ozonne')['value']); ?>],
				dataLabels: {
					format:
						'<div style="text-align:center">' +
						'<span style="font-size:25px">{y}</span><br/>' +
						'<span style="font-size:12px;opacity:0.4">dobson</span>' +
						'</div>'
				},
				tooltip: {
					valueSuffix: ' dobson'
				}
			}]
		}));

		// Particules Fines
		var particules = Highcharts.chart('particules', Highcharts.merge(gaugeOptions, {
			yAxis: {
				min: 0,
				max: 200,
				title: {
					text: 'Particules Fines'
				}
			},

			credits: {
				enabled: false
			},

			series: [{
				name: 'Particules Fines',
				data: [<?php echo(ACMPModel::getLastValueFor('Particules Fines')['value']); ?>],
				dataLabels: {
					format:
						'<div style="text-align:center">' +
						'<span style="font-size:25px">{y}</span><br/>' +
						'<span style="font-size:12px;opacity:0.4">ppm</span>' +
						'</div>'
				},
				tooltip: {
					valueSuffix: ' ppm'
				}
			}]
		}));

		if(gaugeInterval)
			clearInterval(gaugeInterval);

		var gaugeInterval = setInterval(() => {
			// CO2 Update
			var point;

			if(carbon)
				xhr.getLastValueFor(carbon.series[0].points[0], 'CO2');

			if(ozone)
				xhr.getLastValueFor(ozone.series[0].points[0], 'Ozonne');

			if(particules)
				xhr.getLastValueFor(particules.series[0].points[0], 'Particules Fines');
		}, 2000);
	</script>
</aside>
