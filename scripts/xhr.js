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
	 * check is connected
	 */
	static isConnect() {
		$.ajax({
			url: '/?isConnect',
			type: 'post',
			dataType: 'json',
			success: (result) => {
				if(result.response.uname)
					$('#signIn').fadeOut(() => $('#signOut').fadeIn());

				if(result.response.isAdmin)
					$('#captorNav').fadeIn();
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
					$('#login form')[0].reset();
					$('#login form')
						.find('.auth-return')
						.css({ color: 'rgb(0, 235, 0)' })
						.text('connexion réussie')
						.fadeIn(() => {
							$('#login').fadeOut();
							$('#login form .auth-return').fadeOut();
						});

					$('#signIn').fadeOut(() => $('#signOut').fadeIn());

					if(result.response.value.isAdmin)
						$('#captorNav').fadeIn();
				}

				else
					$('#login form')
						.find('.auth-return')
						.css({ color: 'rgb(235, 0, 0)' })
						.text(result.response.error)
						.fadeIn();
			}
		});
	}

	/**
	 * sign out request
	 */
	static signOut() {
		$.ajax({
			url: '/?signOut',
			type: 'post',
			dataType: 'json',
			success: (result) => {
				$('#signOut').fadeOut(() => $('#signIn').fadeIn());
				$('#captorNav').fadeOut();
			}
		});
	}
}
