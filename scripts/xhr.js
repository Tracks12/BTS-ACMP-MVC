/**
 * Auteur : CARDINAL Florian
 * Date   : 22/12/2018 17:19
 * Page   : xhr.js
 */

"use strict";

class xhr {
	/**
	 * xhr request for contact form
	 * @param {string} data URI request
	 */
	static contact(data) {
		$.ajax({
			type: 'POST',
			url: '/?contact',
			data: data,
			dataType: 'json',
			success: (result) => {
				if(result.passed) {
					$('#contact .ty').css('display', 'block');
					$('#contact form')[0].reset();
				}
				else {
					$('#contact #fName .error').html(result.error.fname);
					$('#contact #name .error').html(result.error.name);
					$('#contact #mail .error').html(result.error.mail);
					$('#contact #phone .error').html(result.error.tel);
					$('#contact #msg .error').html(result.error.msg);
				}
			}
		});
	}
}
