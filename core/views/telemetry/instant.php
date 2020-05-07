<!--
(c) 2019-2020 Flore Philippe
 Solid Gauge
 -->
<!DOCTYPE html>
<!-- INSTANT -->
<?php
	$carbon = ACMPModel::getLastValueForCarbon();
	$ozone = ACMPModel::getLastValueForOzone();
	$particules = ACMPModel::getLastValueForParticules();
?>
<aside id="instant">
	<figure class="highcharts-figure">
		<div id="carbon" class="chart-container"></div>
	</figure>
	<figure class="highcharts-figure">
		<div id="ozone" class="chart-container"></div>
	</figure>
	<figure class="highcharts-figure">
		<div id="particules" class="chart-container"></div>
	</figure>
	<script type="text/javascript">
		var carbon = Highcharts.chart('carbon', Highcharts.merge(gaugeOptions, {
			yAxis: {
				min: 0,
				max: 100000,
				title: {
					text: '<?php echo($carbon['name']); ?>'
				}
			},

			credits: {
				enabled: false
			},

			series: [{
				name: '<?php echo($carbon['name']); ?>',
				data: [<?php echo($carbon['value']); ?>],
				dataLabels: {
					format:
						'<div style="text-align:center">' +
						'<span style="font-size:30px">{y}</span><br/>' +
						'<span style="font-size:12px;opacity:0.4"><?php echo($carbon['unit']); ?></span>' +
						'</div>'
				},

				tooltip: {
					valueSuffix: '<?php echo($carbon['unit']); ?>'
				}
			}]
		}));

		// Ozone
		var ozone = Highcharts.chart('ozone', Highcharts.merge(gaugeOptions, {
			yAxis: {
				min: 0,
				max: 200,
				title: {
					text: '<?php echo($ozone['name']); ?>'
				}
			},

			credits: {
				enabled: false
			},

			series: [{
				name: '<?php echo($ozone['name']); ?>',
				data: [<?php echo($ozone['value']); ?>],
				dataLabels: {
					format:
						'<div style="text-align:center">' +
						'<span style="font-size:25px">{y}</span><br/>' +
						'<span style="font-size:12px;opacity:0.4"><?php echo($ozone['unit']); ?></span>' +
						'</div>'
				},
				tooltip: {
					valueSuffix: ' <?php echo($ozone['unit']); ?>'
				}
			}]
		}));

		// Particules Fines
		var particules = Highcharts.chart('particules', Highcharts.merge(gaugeOptions, {
			yAxis: {
				min: 0,
				max: 200,
				title: {
					text: '<?php echo($particules['name']); ?>'
				}
			},

			credits: {
				enabled: false
			},

			series: [{
				name: '<?php echo($particules['name']); ?>',
				data: [<?php echo($particules['value']); ?>],
				dataLabels: {
					format:
						'<div style="text-align:center">' +
						'<span style="font-size:25px">{y}</span><br/>' +
						'<span style="font-size:12px;opacity:0.4"><?php echo($particules['name']); ?></span>' +
						'</div>'
				},
				tooltip: {
					valueSuffix: ' <?php echo($particules['unit']); ?>'
				}
			}]
		}));

		if(gaugeInterval)
			clearInterval(gaugeInterval);

		var gaugeInterval = setInterval(() => {
			if(carbon)
				xhr.getLastValueFor(carbon.series[0].points[0], 'CO2');

			if(ozone)
				xhr.getLastValueFor(ozone.series[0].points[0], 'Ozone');

			if(particules)
				xhr.getLastValueFor(particules.series[0].points[0], 'Particules Fines');
		}, 1000);
	</script>
</aside>
