<!--
(c) 2019-2020 Flore Philippe
 Solid Gauge
 -->
<!DOCTYPE html>
<!-- INSTANT -->
<aside id="instant">
	<br />
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
