/**
 * Autor    : CARDINAL Florian
 * Project  : Capteur ACMP
 * Date     : 04/05/2020
 * Location : /scripts/
 * Nom      : tools.js
 */

"use strict";

class tools {
	/**
	 * capitalize a string
	 * @param {string} s input string
	 * @return {string} capitalize string
	 */
	static capitalize(s) {
		if(typeof s !== 'string')
			return '';

		return s.charAt(0).toUpperCase() + s.slice(1);
	}

	/**
	 * check value in range
	 * @param {int} x value
	 * @param {int} min minimal value
	 * @param {int} max maximal value
	 * @return {bool} [true/false]
	 */
	static range(x, min, max) {
		return ((x - min) * (x - max) <= 0);
	}

	/**
	 * make a underline in a console string
	 * @param {string} data console string
	 * @return {string} underline of console string
	 */
	static underliner(data) {
		let s = [];

		for(let i = 0; i < data.length; i++)
			s[i] = [" ", "\n"].includes(data[i]) ? data[i] : '-';

		return `${s.join('')}\n`;
	}
}

/**
 * END
 */
