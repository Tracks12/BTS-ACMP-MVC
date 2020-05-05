<!--
(c) 2019-2020 Flore Philippe
 Solid Gauge
 -->
<!DOCTYPE html>
<!-- INSTANT -->
<aside id="instant">
	<h2>temps réel</h2>
	<br />
	<p class="highcharts-description">Capteur de Co2</p>
	<figure class="highcharts-figure">
		<div id="container-speed" class="chart-container"></div>
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
	// The speed gauge Co2
	var chartSpeed = Highcharts.chart('container-Co2', Highcharts.merge(gaugeOptions, {
	        yAxis: {
	                min: 0,
	                max: 1000,
	                title: {
	                        text: 'Co2'
	                }
	        },

	        credits: {
	                enabled: false
	        },

	        series: [{
	                name: 'Co2',
	                data: [<?php echo(ACMPModel::getLastValueFor('CO2')['value']); ?>],
	                dataLabels: {
	                        format:
	                                '<div style="text-align:center">' +
	                                '<span style="font-size:30px">{y}</span><br/>' +
	                                '<span style="font-size:12px;opacity:0.4">ppm</span>' +
	                                '</div>'
	                },

	                tooltip: {
	                                valueSuffix: 'ppm'
	                }
	        }]
	}));

		if(gaugeInterval)
			clearInterval(gaugeInterval);

		var gaugeInterval = setInterval(() => {
		  // CO2 Update
		  var point;

		  if(chartSpeed)
				xhr.getLastValueFor(chartSpeed.series[0].points[0], 'CO2');
		}, 2000);
	</script>
</aside>
