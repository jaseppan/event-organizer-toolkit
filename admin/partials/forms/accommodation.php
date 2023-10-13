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
        <?php if(isset($id)) : ?>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <?php endif; ?>
        
        <!-- Title -->
        <div class="form-field">
            <label for="accommodation_title"><?php _e('Title:', 'event-organizer-toolkit'); ?></label>
            <input type="text" id="accommodation-title" name="title" value="<?php echo (isset($title)) ? $title : '' ?>" required>
        </div>

        <!-- Description -->
        <div class="form-field">
            <label><?php _e('Description:', 'event-organizer-toolkit'); ?></label>
            <textarea id="accommodation-description" name="description" rows="4"><?php echo (isset($description)) ? $description : '' ?></textarea>
        </div>

        <!-- Rooms -->
        <div class="form-field" id="room-fields">
            <label><?php _e('Rooms:', 'event-organizer-toolkit'); ?></label>
            <?php if (isset($rooms) && !empty($rooms)) : ?>
                <?php foreach ($rooms as $room) : ?>
                    <div class="room">
                        <input type="text" class="room-name" name="room_names[]" value="<?php echo (isset($room)) ? $room : '' ?>">
                        <a href="#" class="remove-room"><?php _e('Remove', 'event-organizer-toolkit') ?></a>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="room">
                    <input type="text" class="room-name" name="room_names[]">
                    <a href="#" class="remove-room"><?php _e('Remove', 'event-organizer-toolkit') ?></a>
                </div>
            <?php endif; ?>
        </div>
        <a href="#" id="add-room"><?php _e('Add room', 'event-organizer-toolkit') ?></a>

        <!-- Submit Button -->
        <div class="submit">
            <input type="submit" name="submit_accommodation" value="<?php _e('Add Accommodation', 'event-organizer-toolkit'); ?>" class="button button-primary">
        </div>
    </form>
</div>

<script>
    jQuery(document).ready(function($) {

        // Add Room
        $('#add-room').click(function(e) {
            e.preventDefault();
            var roomField = '<div class="room"><input type="text" class="room-name" name="room_names[]"><a href="#" class="' + '<?php _e('Remove', 'event-organizer-toolkit') ?>' + '">Remove</a></div>';
            $('#room-fields').append(roomField);
        });

        // Remove Room
        $('#room-fields').on('click', '.remove-room', function(e) {
            e.preventDefault();
            $(this).parent('.room').remove();
        });
    });
</script>