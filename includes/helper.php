<?php

/**
 * Check if we are on an EOT admin page.
 * 
 * @return bool
 * @since 1.0
 * @version 1.0
 * @author janne
 * @access public
 */

function is_eot_admin_page() {

    global $is_eot_admin_page;

    if (isset($is_eot_admin_page)) 
        return $is_eot_admin_page;

    $eot_admin_pages = array(
        'event-organizer-toolkit',
        'event-organizer-toolkit-event-types',
        'event-organizer-toolkit-events',
        'event-organizer-toolkit-participants',
        'event-organizer-toolkit-meals',
        'event-organizer-toolkit-accommodations',
        'event-organizer-toolkit-forms',
    );

    $is_eot_admin_page = false; // Initialize the flag as false

    foreach ($eot_admin_pages as $page) {
        if (isset($_GET['page']) && $_GET['page'] == $page) {
            $is_eot_admin_page = true; // Set to true if any condition is met
            break; // Exit the loop since the flag is already set
        }
    }

    return $is_eot_admin_page;

}

/**
 * This function adds a submit button
 * 
 * @return void
 * @since 1.0.0
 * @version 1.0.0
 * @author janne
 */

function eot_submit_button($submit_button_text = 'Save Changes') {
    ?>
    <div class="submit">
        <input id="eot-submit-button" type="submit" name="submit" value="<?php echo $submit_button_text ?>" class="button button-primary">
        <?php eot_spinner(); ?>
    </div>
    <?php 
}

/**
 * This function adds a spinner
 * 
 * @return void
 * @since 1.0.0
 * @version 1.0.0
 * @author janne
 */

function eot_spinner( $id = 'eot-submit-button-loading' ) {
    ?>
    <div id="<?php echo $id ?>" class="loadingio-spinner-spinner hidden"><div class="ldio">
    <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
    </div></div>
    <?php
}

/**
 * Function for selecting form field
 */

function eot_select_form_field( $field ) {

    /**
     * If sub-type is set
     */
    
    if( isset($field['sub-type']) ) { 
        if( $field['sub-type'] == 'repeater' ) {
            require( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/forms/fields/repeatable-field.php' );
            return;
        }
        return;
    }

    if( !isset($field['type']) )
        $field['type'] = 'text';

    switch( $field['type'] ) {
        case 'text':
            require( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/forms/fields/field.php' );
            break;
        case 'textarea':
            require( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/forms/fields/textarea.php' );
            break;
        case 'select':
            require( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/forms/fields/select.php' );
            break;
        case 'checkbox':
            require( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/forms/fields/checkbox.php' );
            break;
        case 'radio':
            require( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/forms/fields/radio.php' );
            break;
        case 'date':
            require( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/forms/fields/date.php' );
            break;
        case 'time':
            require( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/forms/fields/time.php' );
            break;
        case 'datetime':
            require( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/forms/fields/datetime.php' );
            break;
        case 'color':
            require( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/forms/fields/color.php' );
            break;
        case 'image':
            require( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/forms/fields/image.php' );
            break;
        case 'file':
            require( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/forms/fields/file.php' );
            break;
        default:
            require( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/forms/fields/field.php' );
            break;
    }
 }

 /**
  * Function to create list of post types
  */

 function eot_get_post_types() {

    $post_types = get_post_types( array( 'public' => true ), 'objects' );

    $post_types_list = array();

    foreach ( $post_types as $post_type ) {
        $post_types_list[ $post_type->name ] = $post_type->label;
    }

    return $post_types_list;

 }