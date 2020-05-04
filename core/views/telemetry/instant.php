<!--
(c) 2019-2020 Flore Philippe
 Solid Gauge
 -->
<!DOCTYPE html>
<!-- INSTANT -->
<aside id="instant">
	<h2>temps réel</h2>
	<br />
	<figure class="highcharts-figure">
		<div id="container-speed" class="chart-container"></div>
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
		var chartSpeed = Highcharts.chart('container-speed', Highcharts.merge(gaugeOptions, {
		  yAxis: {
	      min: 0,
	      max: 100000,
	      title: {
          text: 'Speed'
	      }
		  },

		  credits: {
	      enabled: false
		  },

		  series: [{
	      name: 'Speed',
	      data: [0],
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

		  if(chartSpeed)
				xhr.getLastValueFor(chartSpeed.series[0].points[0], 'CO2');
		}, 2000);
	</script>
</aside>
