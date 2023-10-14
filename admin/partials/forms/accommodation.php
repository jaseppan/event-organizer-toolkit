<?php 

/**
 * This form is for adding and editing accommodations
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
    <h1><?php _e('Add New Accommodation', 'event-organizer-toolkit'); ?></h1>
    <div id="form-message"></div>
    <form id="event-organizer-toolkit-accommodations-form" method="post" action="">

        <!-- Hidden fields -->
        <?php if(isset($_GET['id'])) : ?>
            <input type="hidden" id="accommodation-id" name="id" value="">
        <?php endif; ?>
        
        <!-- Title -->
        <div class="form-field">
            <label for="accommodation_title"><?php _e('Title:', 'event-organizer-toolkit'); ?></label>
            <input type="text" id="accommodation-title" name="title" required>
        </div>

        <!-- Description -->
        <div class="form-field">
            <label for="accommodation-description"><?php _e('Description:', 'event-organizer-toolkit'); ?></label>
            <textarea id="accommodation-description" name="description" rows="4"></textarea>
        </div>

        <!-- Rooms -->
        <div class="form-field" id="room-fields">
            <label><?php _e('Rooms:', 'event-organizer-toolkit'); ?></label>
            <?php if (isset($_GET['tab']) && $_GET['tab'] == 'add') : ?>
                
                <div class="room">
                    <input type="text" class="room-name" name="rooms[]">
                    <a href="#" class="remove-room remove-item"><?php _e('Remove', 'event-organizer-toolkit') ?></a>
                </div>
            
            <?php else : ?>
               
            <?php endif; ?>
        </div>
        <a href="#" id="add-room"><?php _e('Add room', 'event-organizer-toolkit') ?></a>

        <!-- Submit Button -->
        <?php echo eot_submit_button($submit_button_text) ?>
    </form>
</div>

<script>
    jQuery(document).ready(function($) {

        // Add Room
        $('#add-room').click(function(e) {
            e.preventDefault();
            var roomField = '<div class="room"><input type="text" class="room-name" name="rooms[]"><a href="#" class="remove-room remove-item">' + '<?php _e('Remove', 'event-organizer-toolkit') ?>' + '</a></div>';
            $('#room-fields').append(roomField);
        });

        // Remove Room
        $('#room-fields').on('click', '.remove-room', function(e) {
            e.preventDefault();
            $(this).parent('.room').remove();
        });
        <?php if (isset($_GET['tab']) && $_GET['tab'] == 'edit' && isset($_GET['id']) ) { ?>
        
            // Get accommodation data
            $.ajax({
                url: '/wp-json/event-organizer-toolkit/v1/get-accommodation?id=' + <?php echo $_GET['id'] ?>, // Update the URL to match your WordPress installation
                type: 'GET',
                success: function(response) {

                    var id = response.data.data.id,
                        title = response.data.data.title,
                        description = response.data.data.description,
                        rooms = response.data.data.rooms;

                    // Handle the data, e.g., populate the form fields
                    $('#accommodation-id').val(id);
                    $('#accommodation-title').val(title);
                    $('#accommodation-description').val(description);

                    // Populate rooms, assuming data.rooms is an array
                    $.each(rooms, function(index, room) {
                        var roomField = '<div class="room"><input type="text" class="room-name" name="rooms[]" value="' + room + '"><a href="#" class="remove-room remove-item">Remove</a></div>';
                        $('#room-fields').append(roomField);
                    });
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.log(error);
                }
            });
            
        
        <?php } ?>
    });


</script>