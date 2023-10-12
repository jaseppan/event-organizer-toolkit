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