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
	 * @return {object} json response
	 */
	static ping() {
		return $.ajax({
			async: false,
			url: '/?ping',
			type: 'post',
			dataType: 'json'
		}).responseJSON;
	}

	/**
	 * get last captors information's from data base
	 * @return {object} json response
	 */
	static getLastCaptorsPositions() {
		return $.ajax({
			async: false,
			url: '/?getLastCaptorsPositions',
			type: 'post',
			dataType: 'json'
		}).responseJSON.response;
	}

	/**
	 * get last value from measure name for instant
	 * @param {object} box html object to update
	 * @param {string} id measure name
	 */
	static getLastValueFor(box, id) {
		$.ajax({
			async: true,
			url: '/?getLastValueFor',
			type: 'post',
			data: `id=${id}`,
			dataType: 'json',
			success: (result) => {
				box.update(parseFloat(result.response.value));
			}
		});
	}

	/**
	 * get last value from measure name for instant in telemetry
	 * @param {string} id measure name
	 */
	static getLastInstantValue(id) {
		return $.ajax({
			async: false,
			url: '/?getLastValueFor',
			type: 'post',
			data: `id=${id}`,
			dataType: 'json'
		}).responseJSON.response;
	}

	/**
	 * get last values measures for instant
	 * @return {array} json response
	 */
	static getLastValues() {
		return $.ajax({
			async: false,
			url: '/?getLastValues',
			type: 'post',
			dataType: 'json'
		}).responseJSON.response;
	}

	/**
	 * get all data by one captor id for story
	 * @param {string} id string of catpor id
	 * @return {object} json response of request
	 */
	static getDataByOnceCaptor(id) {
		return $.ajax({
			async: false,
			url: '/?getDataByOnceCaptor',
			type: 'post',
			data: `id=${id}`,
			dataType: 'json'
		}).responseJSON.response;
	}

	/**
	 * check is connected
	 */
	static isConnect() {
		$.ajax({
			async: true,
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
			async: true,
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
			async: true,
			url: '/?signOut',
			type: 'post',
			dataType: 'json',
			success: (result) => {
				document.location.hash = '';

				$('#signOut').fadeOut(() => $('#signIn').fadeIn());
				$('#captorNav').fadeOut();
				$('section').load(`/map`);
			}
		});
	}
}
