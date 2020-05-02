/**
 * Auteur   : CARDINAL Florian
 * Date     : 02/05/2020 14:01
 * Page     : main.js
 * Location : /scripts/
 */

$(document).ready(() => {
	// Splash Screen Animation
	$('#splash').ready(() => {
		$('#splash h1')
			.delay(5000)
			.fadeOut(1000)
			.parent('div')
			.delay(6000)
			.fadeOut(500);
	});

	
});

/**
 * END
 */
