(function( $ ) {
	'use strict';

	/**
	 * Submit a form for adding and editing
	 */

	jQuery(document).ready(function($) {

		const page = eotScriptData.page;
		const formId = '#' + page + '-form';

		$(formId).on('submit', function(e) {
			e.preventDefault();
			
			// Get data of the current form
			var formData = serializeToJSON($(this).serialize());
	
			// AJAX request
			$.ajax({
				type: eotScriptData.method,
				url: eotScriptData.url,
				data: formData,
				contentType: 'application/json',
				beforeSend: function(xhr) {
					$('#eot-submit-button').addClass('hidden');
					$('#eot-submit-button-loading').removeClass('hidden');
					xhr.setRequestHeader('X-WP-Nonce', eotScriptData.nonce);
				},
				success: function(response) {

					var responseData = response.data.data;
					
					$('#eot-submit-button-loading').addClass('hidden');
					var item_id = responseData.id;
					
					// Change message class
					$('#form-message').removeClass('error').addClass('notice notice-success');

					// Add add new and edit links if current action is add
					if( eotScriptData.action == 'add' ) {
						$('input').attr('disabled', true);
						$('textarea').attr('disabled', true);
						$('.remove-item').addClass('hidden');
						$('.remove-item').addClass('hidden');
						$('.add-item').addClass('hidden');

						var edit_link = eotScriptData.current_url + '&tab=edit&id=' + item_id;
						var actions = 
							'<a href="' + edit_link + '" class="edit-button" data-id="' + item_id + '">Edit</a>' +
							'<a href="#" class="add-new-item">Add New</a>';
						$('#form-actions').html( actions ).show();
					}

					if( eotScriptData.action == 'edit' ) {
						$('#eot-submit-button').removeClass('hidden');
					}

					var message = response.data.message;
					$('#form-message').html(message).show();

				},
				error: function(error) {
					// Handle error, display an error message
					var errorData = error.responseJSON.data;
					$('#eot-submit-button').removeClass('hidden');
					$('#eot-submit-button-loading').addClass('hidden');
					var message = errorData.message;
					var actions = '';
					$('#form-message').removeClass('success').addClass('notice error');
					$('#form-message').html(message).show();
					$('#form-actions').html( actions );
				}
			});
		});

		/**
		 * Reset form when Add new link is clicked
		 */

		$(document).on('click', '.add-new-item', function(e) {
			e.preventDefault();
			$(formId).trigger('reset');
			$('.form-field').removeClass('hidden');
			$('input').attr('disabled', false);
			$('textarea').attr('disabled', false);
			$('.remove-item').removeClass('hidden');
			$('.add-item').removeClass('hidden');
		});
		

	});

	const serializeToJSON = (serializedData) => {
		
		// Split the serialized data into an array of key-value pairs
		var keyValuePairs = serializedData.split('&');
		
		// Initialize an empty object
		var jsonObject = {};
	  
		// Convert the array into a JSON object
		keyValuePairs.forEach(function(keyValuePair) {
		  var pair = keyValuePair.split('=');
		  var key = decodeURIComponent(pair[0]);
		  var value = decodeURIComponent(pair[1]);
		  
		  // Handle arrays by checking for square brackets
		  if (key.endsWith('[]')) {
			key = key.slice(0, -2); // Remove the square brackets
			if (!jsonObject[key]) {
			  jsonObject[key] = [];
			}
			jsonObject[key].push(value);
		  } else {
			jsonObject[key] = value;
		  }
		});
	  
		return JSON.stringify(jsonObject);
	}


})( jQuery );
