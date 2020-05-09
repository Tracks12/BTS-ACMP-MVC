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
	 * ping the API
	 */
	static ping() {
		$.ajax({
			url: '/?ping',
			type: 'post',
			dataType: 'json',
			success: (result) => console.log(result.response)
		});
	}

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

	/**
	 * sign in request
	 * @param {string} data data request
	 */
	static signIn(data) {
		$.ajax({
			url: '/?signIn',
			type: 'post',
			data: `data=${btoa(data)}`,
			dataType: 'json',
			success: (result) => {
				if(result.response.passed) {
					$('#login form')
						.find('.auth-return')
						.css({ color: 'rgb(0, 235, 0)' })
						.text('connexion réussie')
						.fadeIn();
				}

				else
					$('#login form')
						.find('.auth-return')
						.css({ color: 'rgb(235, 0, 0)' })
						.text(result.response.error)
						.fadeIn();
			}
		})
	}

	/**
	 * sign out request
	 */
	static signOut() {
		$.ajax({
			url: '/?signOut',
			type: 'post',
			dataType: 'json',
			success: (result) => console.log(result.response)
		})
	}
}
