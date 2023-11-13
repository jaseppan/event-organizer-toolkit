<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 * 
 * NOTICE: Define colums available in list view in function Event_Organizer_Toolkit_Admin::get_script_data()
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
        'Meal Types',
        'Meal Types',
        'manage_options',
        'event-organizer-toolkit-meal-types',
        'event_organizer_toolkit_meal_types_page'
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
        'Event Types',
        'Event Types',
        'manage_options',
        'event-organizer-toolkit-event-types',
        'event_organizer_toolkit_event_types_page'
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
    $page_title = __('Participants', 'event-organizer-toolkit');
    $singular_title = __('Participant', 'event-organizer-toolkit');
    $page_slug = 'event-organizer-toolkit-participants';
    if( !class_exists('Event_Organizer_Toolkit_Participants_Handler') )
        require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'rest-api/models/participants.php' );

    $property_object = new Event_Organizer_Toolkit_Participants_Handler();

    event_organizer_toolkit_admin_view( 
        $page_title, 
        $singular_title, 
        $page_slug,
        $property_object
    );
 }
 
 // Callback function for the Meals sub-menu page
 function event_organizer_toolkit_meals_page() {
     // Your Meals page content goes here
    $page_title = __('Meals', 'event-organizer-toolkit');
    $singular_title = __('Meal', 'event-organizer-toolkit');
    $page_slug = 'event-organizer-toolkit-meals';
    if( !class_exists('Event_Organizer_Toolkit_Meals_Handler') )
        require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'rest-api/models/meals.php' );

    $property_object = new Event_Organizer_Toolkit_Meals_Handler();

    event_organizer_toolkit_admin_view( 
        $page_title, 
        $singular_title, 
        $page_slug,
        $property_object
    );
 }
 
 // Callback function for the Meal types sub-menu page
 function event_organizer_toolkit_meal_types_page() {
     // Your Meals page content goes here
    $page_title = __('Meal types', 'event-organizer-toolkit');
    $singular_title = __('Meal type', 'event-organizer-toolkit');
    $page_slug = 'event-organizer-toolkit-meal-types';
    if( !class_exists('Event_Organizer_Toolkit_Meal_Types_Handler') )
        require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'rest-api/models/meal-types.php' );

    $property_object = new Event_Organizer_Toolkit_Meal_Types_Handler();

    event_organizer_toolkit_admin_view( 
        $page_title, 
        $singular_title, 
        $page_slug,
        $property_object
    );
 }
 
 // Callback function for the Accommodations sub-menu page
 function event_organizer_toolkit_accommodations_page() {
     // Display the title
    $page_title = __('Accommodations', 'event-organizer-toolkit');
    $singular_title = __('Accommodation', 'event-organizer-toolkit');
    $page_slug = 'event-organizer-toolkit-accommodations';
    if( !class_exists('Event_Organizer_Toolkit_Accommodations_Handler') )
        require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'rest-api/models/accommodations.php' );

    $property_object = new Event_Organizer_Toolkit_Accommodations_Handler();

    event_organizer_toolkit_admin_view( 
        $page_title, 
        $singular_title, 
        $page_slug,
        $property_object
    );
    
 }

function event_organizer_toolkit_event_types_page() {

    // Display the title
    $page_title = __('Event Types', 'event-organizer-toolkit');
    $singular_title = __('Event Type', 'event-organizer-toolkit');
    $page_slug = 'event-organizer-toolkit-event-types';
    if( !class_exists('Event_Organizer_Toolkit_Event_Types_Handler') )
        require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'rest-api/models/event-types.php' );

    $property_object = new Event_Organizer_Toolkit_Event_Types_Handler();

    event_organizer_toolkit_admin_view( 
        $page_title, 
        $singular_title, 
        $page_slug,
        $property_object
    );

}
 
 // Callback function for the Forms sub-menu page
 function event_organizer_toolkit_forms_page() {
     // Your Forms page content goes here
 }
 
 // Hook into the admin menu to add the menu items
 add_action('admin_menu', 'event_organizer_toolkit_menu');

 function event_organizer_toolkit_admin_view( $page_title, $singular_title, $page_slug, $property_object ) {
    
    printf(
        '<h1>%s</h1>',
        $page_title
    );
    
    // Add tabs for navigation
    printf('<div class="nav-tab-wrapper">');

    $active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'list';

    $list_tab_name = sprintf(__('List %s', 'event-organizer-toolkit'), $page_title);
    $add_tab_name = sprintf(__('Add New %s', 'event-organizer-toolkit'), $singular_title);
    $edit_tab_name = sprintf(__('Edit %s', 'event-organizer-toolkit'), $singular_title);
    $submit_add_text = sprintf(__('Add %s', 'event-organizer-toolkit'), $singular_title);
    $submit_edit_text = sprintf(__('Edit %s', 'event-organizer-toolkit'), $singular_title);
    
    $class = ($active_tab == 'list' ) ? 'active' : '';
    printf(
        '<a href="?page=%s&tab=list" class="nav-tab %s">%s</a>',
        $page_slug,
        $class,
        $list_tab_name
    );
    $class = ($active_tab == 'add' ) ? 'active' : '';
    printf(
        '<a href="?page=%s&tab=add" class="nav-tab %s">%s</a>',
        $page_slug,
        $class,
        $add_tab_name
    );
    $class = ($active_tab == 'edit' ) ? 'active' : '';
    if( $active_tab == 'edit' ) {
        // $class = 'active';
        printf(
            '<a href="?page=%s&tab=edit" class="nav-tab %s">%s</a>',
            $page_slug,
            $class,
            $edit_tab_name
        );
    }
    
    printf('</div>');

    if( $active_tab == 'add' || $active_tab == 'edit' )
        $fields = $property_object->get_fields();

    if ($active_tab === 'list') {
        // Content for the "List Accommodations" tab
        require( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/list.php');
        // Add your code to display the list of accommodations here.
    } elseif ($active_tab === 'add') {

        // Submit buttom text
        $view_title = $add_tab_name;
        $submit_button_text = $submit_add_text;
        // Content for the "Add New Accommodation" tab
        require( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/form.php');
        // Add your code to create a new accommodation here.
    } elseif ($active_tab === 'edit') {

        // Submit buttom text
        $view_title = $edit_tab_name;
        $submit_button_text = $submit_edit_text;
        // Content for the "Add New Accommodation" tab
        require( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/form.php');
        // Add your code to create a new accommodation here.
    }
    
 }