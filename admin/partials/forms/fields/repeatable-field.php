<?php
/**
 * Partial dynamic fields
 */

?>

<div class="form-field repeater-fields" id="<?php echo $field['name'] ?>-repeater-fields">
    <label><?php echo $field['label'] ?></label>
    <?php 
    // Show empty field if action is add
    if (isset($_GET['tab']) && $_GET['tab'] == 'add') : ?>
        
        <div class="repeater-item">
            <input type="<?php echo ( isset($field['type']) ) ? $field['type'] : 'text' ?>" class="repeater-item-name" name="<?php echo $field['name'] ?>[]">
            <a href="#" class="remove-item"><?php _e('Remove', 'event-organizer-toolkit') ?></a>
        </div>

    <?php endif; ?>
</div>
<a href="#" id="add-<?php echo $field['name'] ?>-item" class="add-item" data-repeater-name="<?php echo $field['name'] ?>"><?php _e('Add item', 'event-organizer-toolkit') ?></a>

<script>
    jQuery(document).ready(function($) {

        // Add repeater item
        $('#add-<?php echo $field['name'] ?>-item').click(function(e) {
            e.preventDefault();
            var repeater_name = $(this).attr('data-repeater-name');
            var repeaterField = '<div class="repeater-item"><input type="text" class="repeater-item-name" name="' + repeater_name + '[]"><a href="#" class="remove-item">' + '<?php _e('Remove', 'event-organizer-toolkit') ?>' + '</a></div>';
            $('#<?php echo $field['name'] ?>-repeater-fields').append(repeaterField);
        });

        // Remove repeater item
        $('#<?php echo $field['name'] ?>-repeater-fields').on('click', '.remove-item', function(e) {
            e.preventDefault();
            $(this).parent('.repeater-item').remove();
        });
    });
</script>