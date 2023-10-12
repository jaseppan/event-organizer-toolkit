(function( $ ) {
	'use strict';

	/**
	 * Submit add accommodation form
	 */

	jQuery(document).ready(function($) {

		const page = eotScriptData.page;
		const formId = '#' + page + '-form';

		$(formId).on('submit', function(e) {
			e.preventDefault();
	
			// Get data of the current form
			var formData = getFormData(formId);
	
			// AJAX request
			$.ajax({
				type: 'POST',
				url: eotScriptData.url,
				data: JSON.stringify(formData),
				contentType: 'application/json',
				beforeSend: function(xhr) {
					xhr.setRequestHeader('X-WP-Nonce', eotScriptData.nonce);
				},
				success: function(response) {
					// Check if the response indicates failure

					if (!response.success) {

						console.log('Backend Error:', response);

						// Change message class
						var actions = '';
						$('#form-message').removeClass('notice-success').addClass('notice error');
						
					} else {

						console.log('Success:', response);

						var accommodation_id =  response.data.data.id;
						var edit_link = eotScriptData.current_url + '&tab=edit&id=' + accommodation_id;
						var actions = 
							'<a href="' + edit_link + '" class="accommodation-edit-button" data-id="' + accommodation_id + '">Edit</a>' +
							'<a href="#" class="add-new-item">Add New</a>';
						// Change message class
						$('#form-message').removeClass('error').addClass('notice notice-success');
						$(formId).trigger('reset');
						$('.form-field').addClass('hidden');
						
					}

					var message = response.data.message;
					$('#form-message').html(message).show();
					$('#form-actions').html( actions ).show();

				},
				error: function(error) {
					// Handle error, e.g., display an error message
					// Handle other errors, e.g., display a generic error message
					console.log('Frontend Error:', error.responseText);
					var message = 'An error occurred. Please try again.';
					var actions = '';
					$('#form-message').removeClass('success').addClass('notice error');
					$('#form-message').html(message).show();
					$('#form-actions').html( actions );
				}
			});
		});

		$(document).on('click', '.add-new-item', function(e) {
			e.preventDefault(); // Prevent the default link behavior
				// Assuming your form has an ID like 'accommodation-form', you can empty it like this:
				$(formId).trigger('reset');
				$('.form-field').removeClass('hidden');
			}
		);
		

	});

	const getFormData = (formId) => {

		if (formId === undefined) {
			throw new Error('No form ID provided');
		}
	
		let formData;
	
		if (formId === '#event-organizer-toolkit-accommodations-form') {
			formData = {
				'title': $('#accommodation-title').val(),
				'description': $('#accommodation-description').val(),
				'rooms': []
			}
	
			$('.room-name').each(function() {
				formData.rooms.push($(this).val());
			});
		}
	
		return formData;
	};

})( jQuery );


