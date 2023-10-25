<?php 

/**
 * This form is for adding and editing data
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
    <form id="event-organizer-toolkit-accommodations-form" method="post" action="">

        <!-- Hidden fields -->
        <?php if(isset($_GET['id'])) : ?>
            <input type="hidden" id="id" name="id" value="">
        <?php endif; ?>

        <?php foreach( $fields as $field ) {
            eot_select_form_field( $field );            
        }
        ?>
        <!-- Submit Button -->
        <?php echo eot_submit_button($submit_button_text) ?>
    </form>
</div>

<script>
    jQuery(document).ready(function($) {
        
        if( eotScriptData.item_id !== undefined ) {
            
            // Get accommodation data
            $.ajax({
                url: eotScriptData.get_url + '?id=' + eotScriptData.item_id, // Update the URL to match your WordPress installation
                type: 'GET',
                success: function(response) {
    
                    responseData = response.data.data;
                    
                    $.each(responseData, function(index, item) {
                        if ( Array.isArray(item) || typeof item === 'object' ) {
                            // Populate repeater fields
                            var repeaterContainer = '#' + index + '-repeater-fields';
                            
                            $.each(item, function(repeater_item_index, repeater_item) {
                                // console.log(index);
                                var repeaterField = '<div class="repeater-item"><input type="text" class="repeater-item-name" name="' + index + '[]" value="' + repeater_item + '"><a href="#" class="remove-item">' + eotScriptData.texts.remove + '</a></div>';
                                $(repeaterContainer).append(repeaterField);
                            });
                        } else {
                            $('#' + index).val(item);
                        }
                    });
    
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.log(error);
                }
            });

        }
        
            

    });


</script>