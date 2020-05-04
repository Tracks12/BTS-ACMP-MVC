/**
 * Autor    : CARDINAL Florian
 * Project  : Capteur ACMP
 * Date     : 04/05/2020
 * Location : /scripts/
 * Nom      : xhr.js
 */

"use strict";

class xhr {
	/**
	 * xhr request for contact form
	 */
	static ping(data) {
		$.ajax({
			type: 'POST',
			url: '/?ping',
			dataType: 'json',
			success: (result) => {
				console.log(result);
			}
		});
	}
}
