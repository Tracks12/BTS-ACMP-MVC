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

function dynamicURI(uri) { // Dynamic URI
	uri = (typeof uri === 'undefined') ? 'map' : uri;

	uri = uri.split('-');
	uri = (uri.length > 1 && uri[0] == "telemetry") ? uri[0] : uri[0];

	$('section').load(`/${uri}`);
}

$(document).ready(() => {
	xhr.isConnect();

	// URI
	dynamicURI(window.location.hash.split('#')[1]);

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
	$('.navbar div').click(() => {
		$('nav ul').slideToggle();
		$('nav ul ul').css('display', 'none');
	});

	$('.navbar ul li').click(function() {
		if($(window).width() < 720)
			$(this)
				.find('ul')
				.slideToggle();
	});

	$('.navbar ul li a')
		.click(function() {
			if(!(typeof gaugeInterval === 'undefined'))
				clearInterval(gaugeInterval);

			let href = $(this).attr('href').split('#')[1];
			$('section').load(`/${href}`);
		})
		.scrolly();

	$('#signIn, section').click(() => {
		if($(window).width() < 720)
			$('.navbar ul').slideUp();
	});

	$(window).resize(() => {
		if($(window).width() > 720)
			$('.navbar ul').removeAttr('style');
	});

	$('#signIn').click(() => $('#login').fadeIn());
	$('#signOut').click(() => xhr.signOut());

	$('#login .close').click(() => $('#login').fadeOut());

	$('#login form').submit(function(e) {
		e.preventDefault();
		let data = $(this).serialize();

		$(this)
			.find('.auth-return')
			.fadeOut();

		xhr.signIn(data);
	});
});

/**
 * END
 */
