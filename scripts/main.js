/**
 * Autor    : CARDINAL Florian
 * Project  : Capteur ACMP
 * Date     : 04/05/2020
 * Location : /scripts/
 * Nom      : main.js
 */

"use strict";

// Connexion au service Here
const platform = new H.service.Platform({
	apikey: "MrQdjSM58WPTG8w0Blb7-CiGBPquXZLKfpwVNzI6zcQ"
});

var gaugeOptions = {
	chart: {
		type: 'solidgauge'
	},

	title: null,

	pane: {
		center: ['50%', '85%'],
		size: '140%',
		startAngle: -90,
		endAngle: 90,
		background: {
			backgroundColor:
				Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
			innerRadius: '60%',
			outerRadius: '100%',
			shape: 'arc'
		}
	},

	exporting: {
		enabled: false
	},

	tooltip: {
		enabled: false
	},

	// the value axis
	yAxis: {
		stops: [
			[0.1, '#55BF3B'], // green
			[0.5, '#DDDF0D'], // yellow
			[0.9, '#DF5353'] // red
		],
		lineWidth: 0,
		tickWidth: 0,
		minorTickInterval: null,
		tickAmount: 2,
		title: {
			y: -70
		},
		labels: {
			y: 16
		}
	},

	plotOptions: {
		solidgauge: {
			dataLabels: {
				y: 5,
				borderWidth: 0,
				useHTML: true
			}
		}
	}
};

$(document).ready(() => {
	// Dynamic URI
	let uri = window.location.hash.split('#')[1];
	uri = !uri ? 'map' : uri;
	$('section').load(`/${uri}`);

	// Splash Screen Animation
	$('#splash').ready(() => {
		$('#splash h1')
			.delay(5000)
			.fadeOut(1000)
			.parent('div')
			.delay(6000)
			.fadeOut(500);
	});

	// Nav Bar Event
	$('nav div').click(() => {
		$('nav ul').slideToggle();
		$('nav ul ul').css('display', 'none');
	});

	$('nav ul li').click(function() {
		if($(window).width() < 720)
			$(this)
				.find('ul')
				.slideToggle();
	});

	$('nav ul li a')
		.click(function() {
			let href = $(this).attr('href').split('#')[1];
			$('section').load(`/${href}`);
		})
		.scrolly();

	$('section').click(() => {
		if($(window).width() < 720)
			$('nav ul').slideUp();
	});

	$(window).resize(() => {
		if($(window).width() > 720)
			$('nav ul').removeAttr('style');
	});


});

/**
 * END
 */
