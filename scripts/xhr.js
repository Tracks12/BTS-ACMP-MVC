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
	 * get last value from measure name
	 * @param {object} box html object to update
	 * @param {string} measureName measure name
	 */
	static getLastValueFor(box, measureName) {
		$.ajax({
			url: '/?getLastValueFor',
			type: 'post',
			data: `measureName=${measureName}`,
			dataType: 'json',
			success: (result) => {
				box.update(parseFloat(result.response.value));
			}
		});
	}
}
