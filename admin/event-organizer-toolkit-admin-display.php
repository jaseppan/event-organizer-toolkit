<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://janneseppanen.site/
 * @since      1.0.0
 *
 * @package    Event_Organizer_Toolkit
 * @subpackage Event_Organizer_Toolkit/admin/partials
 */

 
 function event_organizer_toolkit_menu() {
     add_menu_page(
         'Event Organizer Toolkit',
         'Event Organizer Toolkit',
         'manage_options',
         'event-organizer-toolkit',
         'event_organizer_toolkit_page'
     );
 
     // Add sub-menu items
     add_submenu_page(
         'event-organizer-toolkit',
         'Events',
         'Events',
         'manage_options',
         'event-organizer-toolkit-events',
         'event_organizer_toolkit_events_page'
     );
 
     add_submenu_page(
         'event-organizer-toolkit',
         'Participants',
         'Participants',
         'manage_options',
         'event-organizer-toolkit-participants',
         'event_organizer_toolkit_participants_page'
     );
 
     add_submenu_page(
         'event-organizer-toolkit',
         'Meals',
         'Meals',
         'manage_options',
         'event-organizer-toolkit-meals',
         'event_organizer_toolkit_meals_page'
     );
 
     add_submenu_page(
         'event-organizer-toolkit',
         'Accommodations',
         'Accommodations',
         'manage_options',
         'event-organizer-toolkit-accommodations',
         'event_organizer_toolkit_accommodations_page'
     );
 
     add_submenu_page(
         'event-organizer-toolkit',
         'Forms',
         'Forms',
         'manage_options',
         'event-organizer-toolkit-forms',
         'event_organizer_toolkit_forms_page'
     );
 }
 
 // Callback function for the main menu page
 function event_organizer_toolkit_page() {
     // Your main menu page content goes here
     echo '<h1>Event Organizer Toolkit</h1>';
     // You can add more content or settings for your plugin here
 }
 
 // Callback function for the Events sub-menu page
 function event_organizer_toolkit_events_page() {
     // Your Events page content goes here
 }
 
 // Callback function for the Participants sub-menu page
 function event_organizer_toolkit_participants_page() {
     // Your Participants page content goes here
 }
 
 // Callback function for the Meals sub-menu page
 function event_organizer_toolkit_meals_page() {
     // Your Meals page content goes here
 }
 
 // Callback function for the Accommodations sub-menu page
 function event_organizer_toolkit_accommodations_page() {
     // Display the title
    
     printf(
        '<h1>%s</h1>',
        _e('Accommodations', 'event-toolkit-organizer')
    );
    
    // Add tabs for navigation
    printf('<div class="nav-tab-wrapper">');

    printf(
        '<a href="?page=%s&tab=list" class="nav-tab">%s</a>',
        'event-organizer-toolkit-accommodations',
        __('List Accommodations', 'event-toolkit-organizer')
    );
    printf(
        '<a href="?page=%s&tab=add" class="nav-tab">%s</a>',
        'event-organizer-toolkit-accommodations',
        __('Add New Accommodation', 'event-toolkit-organizer')
    );
    if( $_GET['tab'] == 'edit' ) {
        printf(
            '<a href="?page=%s&tab=edit" class="nav-tab">%s</a>',
            'event-organizer-toolkit-accommodations',
            __('Edit New Accommodation', 'event-toolkit-organizer')
        );
    }
    
    printf('</div>');

    // Check which tab is active and display the appropriate content
    $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'list';

    if ($active_tab === 'list') {
        // Content for the "List Accommodations" tab
        echo '<p>This is where you can view a list of accommodations.</p>';
        // Add your code to display the list of accommodations here.
    } elseif ($active_tab === 'add') {
        // Content for the "Add New Accommodation" tab
        require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/forms/accommodation.php');
        // Add your code to create a new accommodation here.
    }
 }
 
 // Callback function for the Forms sub-menu page
 function event_organizer_toolkit_forms_page() {
     // Your Forms page content goes here
 }
 
 // Hook into the admin menu to add the menu items
 add_action('admin_menu', 'event_organizer_toolkit_menu');