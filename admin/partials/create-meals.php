<?php 

/**
 * This form is for creating meals between selected dates
 * 
 * @since 1.0
 * @version 1.0
 * @author Janne Seppänen
 */

// Prevent direct access
if (!defined('ABSPATH')) exit;
?>

<div class="wrap">
    <div id="form-actions"></div>
    <?php if(isset( $view_title )) { ?>
        <h1><?php echo $view_title ?></h1>
    <?php } ?>
    <div id="form-message"></div>
    <form id="event-organizer-toolkit-create-meals-form" method="post" action="" autocomplete="off">
        
    <div class="form-group">    
        <label for="start-date"><?php _e('Start date', 'event-manager-toolkit'); ?></label>
        <input type="text" id="start-date" class="eot-datepicker" name="start-date" required/>
        <label for="end-date"><?php _e('End date', 'event-manager-toolkit'); ?></label>
        <input type="text" id="end-date" class="eot-datepicker" name="end-date" required/>
    </div>
    <input type="checkbox" id="delete-previous" name="delete-previous" value="1" />
    <label for="delete-previous"><?php _e('Delete previous', 'event-manager-toolkit'); ?></label>
        <input type="submit" id="event-organizer-toolkit-<?php echo sanitize_title($page_title) ?>-submit" name="event-organizer-toolkit-<?php echo sanitize_title($page_title)
        ?>-submit" value="<?php _e('Create Meals') ?>" />
        <?php wp_nonce_field('event-organizer-toolkit-' . sanitize_title($page_title)   . '-form', 'event-organizer-toolkit-' . sanitize_title($page_title) . '-form'
        ) ?>
    </form>
    <div id="event-organizer-toolkit-batch-messages"></div>
</div>

<script>
    jQuery(document).ready(function($) {
        // Cache jQuery selectors
        var $startDate = $('#start-date');
        var $endDate = $('#end-date');
        var $deletePrevious = $('#delete-previous');

        $('#event-organizer-toolkit-create-meals-form').on('submit', function(e) {
            e.preventDefault();
            jQuery('#event-organizer-toolkit-batch-messages').html('');

            var start_date = parseDate($startDate.val());
            var end_date = parseDate($endDate.val());
            var delete_previous = $deletePrevious.is(':checked');
            var get_meals_url = eotScriptData.get_meals_url;
            var delete_meal_url = eotScriptData.delete_meal_url;
            var get_meal_types_url = eotScriptData.get_meal_types_url;
            var create_meal_url = eotScriptData.create_meal_url;

            // Check that end date is after start date
            if (end_date < start_date) {
                alert('End date must be after start date');
                return;
            }

            appendMessage('Batch workflow started');

            // Function to delete meals
            function deleteMeals() {
                appendMessage('Delete command executed');
                
                return $.ajax({
                    url: get_meals_url,
                    method: 'GET'
                }).then(function(response) {
                    return Promise.all(response.data.data.map(function(meal) {
                        return $.ajax({
                            url: delete_meal_url + '?id=' + meal.id,
                            method: 'DELETE'
                        }).then(function(response) {
                            appendMessage(response.data.message);
                        });
                    }));
                }).fail(function(xhr, status, error) {
                    console.error('Error deleting meals:', error);
                });
            }

            // Function to create meals
            function createMeals(mealTypes) {
                appendMessage('Create meals command executed');
                var startDate = new Date(start_date);
                var endDate = new Date(end_date);
                var currentDate = new Date(startDate);

                appendMessage('Creating meals for date between ' + start_date + ' and ' + end_date);

                while (currentDate <= endDate) {
                    var date = formatDateToYYYYMMDD(currentDate);
                    
                    mealTypes.data.data.forEach(function(mealType) {

                        appendMessage('Creating meal: ' + mealType.type + ' ' + date);
                        
                        $.ajax({
                            url: create_meal_url,
                            method: 'POST',
                            data: JSON.stringify({
                                "title": mealType.type,
                                "date": date,
                                "start_time": mealType.start_time,
                                "end_time": mealType.end_time,                        
                            }),
                            contentType: 'application/json',
                            beforeSend: function(xhr) {
                                xhr.setRequestHeader('X-WP-Nonce', eotScriptData.nonce);
                            },
                        }).then(function(response, status, xhr) {
                            appendMessage(response.data.message);
                        }).fail(function(xhr, status, error) {
                            console.error('Error creating meal:', error);
                        });
                    });
                    currentDate.setDate(currentDate.getDate() + 1);
                }
            }

            // Delete previous meals if necessary
            var deletePreviousPromise = delete_previous ? deleteMeals() : Promise.resolve();

            deletePreviousPromise.then(function() {
                
                $.ajax({
                    url: get_meal_types_url,
                    method: 'GET'
                }).then(function(response) {
                    appendMessage('Got meal types:', response);
                    createMeals(response);
                }).fail(function(xhr, status, error) {
                    console.error('Error fetching meal types:', error);
                });
            });

            
        });
    });

    // Function to convert date from DD.MM.YYYY to a Date object
    function parseDate(input) {
        // Regular expression to match various date formats (DD/MM/YYYY, MM/DD/YYYY, YYYY/MM/DD, etc.)
        var regex = /(\d{1,4})[\/\.\-](\d{1,2})[\/\.\-](\d{1,4})/;
        var parts = input.match(regex);

        if (!parts) {
            console.error("Invalid date format");
            return null;
        }

        // Try to intelligently guess the format
        var first = parseInt(parts[1], 10);
        var second = parseInt(parts[2], 10);
        var third = parseInt(parts[3], 10);

        // Assuming formats could be DD/MM/YYYY, MM/DD/YYYY, or YYYY/MM/DD
        if (first > 31) { // Likely YYYY/MM/DD
            return new Date(first, second - 1, third);
        } else if (third > 31) { // Likely DD/MM/YYYY
            return new Date(third, second - 1, first);
        } else { // Ambiguous, assuming MM/DD/YYYY for US formats
            return new Date(third, first - 1, second);
        }
    }

    function formatDateToYYYYMMDD(date) {
        return date.toISOString().split('T')[0];
    }
    

    function appendMessage( message ) {
        jQuery('#event-organizer-toolkit-batch-messages').append(message + '<br />');
    }

</script>