<?php

/**
 * Class contains handling CRUD related to meals
 *
 * @link       https://janneseppanen.site
 * @since      1.0.0
 *
 * @package    Event_Organizer_Toolkit
 * @subpackage Event_Organizer_Toolkit/models/rest-api
 * @author     Janne Seppänen <j.v.seppanen@gmail.com>
 */

 class Event_Organizer_Toolkit_Meals_Handler extends Event_Organizer_Toolkit_Request_Handler {

    /**
	 * The database table for meals.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $table    The database table for meals.
	 */

     public $table;

     /**
      * Initialize the class and set its properties.
      *
      * @since    1.0.0
      * @param      string    $table       The database table for meals.
      */
 
     public function __construct() {
 
         global $wpdb;
 
         $this->table = $wpdb->prefix . EVENT_ORGANIZER_TOOLKIT_MEALS_TABLE;
 
     }

    /**
     * Method to get definitions fields
     * @since    1.0.0
     * @return array
     */

    public function get_fields() {
        $fields = array(
            array(
                'name' => 'title',
                'label' => __('Title', 'event-organizer-toolkit'),
                'type' => 'select',
                'attributes' => 'required',
                'options' => $this->get_meal_names(),
                // 'container-classes' => '',
            ),
            array(
                'name' => 'date',
                'label' => __('Date', 'event-organizer-toolkit'),
                'type' => 'date',
                'attributes' => 'required',
                // 'container-classes' => '',
            ),
            array(
                'name' => 'start_time',
                'label' => __('Start time', 'event-organizer-toolkit'),
                'type' => 'time',
                // 'container-classes' => '',
            ),
            array(
                'name' => 'end_time',
                'label' => __('Start time', 'event-organizer-toolkit'),
                'type' => 'time',
                // 'container-classes' => '',
            ),
            array(
                'name' => 'venue',
                'label' => __('Venue', 'event-organizer-toolkit'),
                // 'type' => '',
                // 'container-classes' => '',
            ),
            array(
                'name' => 'menu',
                'label' => __('Menu', 'event-organizer-toolkit'),
                // 'type' => '',
                // 'container-classes' => '',
            ),
            
            
            
        );

        return $fields;

    }

    public function get_meal_names() {

        $meals = array(
            'Breakfast' => __('Breakfast', 'event-organizer-toolkit'),
            'Lunch' => __('Lunch', 'event-organizer-toolkit'),
            'Dinner' => __('Dinner', 'event-organizer-toolkit'),
            'Snack' => __('Snack', 'event-organizer-toolkit'),
            'Supper' => __('Supper', 'event-organizer-toolkit'),
        );

        return $meals;

    }
    
 
     /**
      * Handler for both wp-json/event-organizer-toolkit/v1/add-meal and ../update-meal endpoints
      * 
      * @since 1.0.0
      */ 
 
     public function update( WP_REST_Request $request ) {
 
        $fields = $this->get_fields();
        $property_name = 'Meals';
        parent::updater( $fields, $request, $property_name );
 
     }
    
    /**
     * Handler for wp-json/event-organizer-toolkit/v1/list-accommodation endpoint
     * 
     * @since 1.0.0
     */   

     public function list( WP_REST_Request $request ) {

        $allowed_for_search = array(
            array(
                'key' => 'id',
                'placeholder' => '%d', 
            ),
            array(
                'key' => 'title',
                'placeholder' => '%s',
            ),
        );

        parent::list_data( $this->table, $allowed_for_search );      

    }
    
    /**
     * Handler for wp-json/event-organizer-toolkit/v1/get-accommodation endpoint
     * 
     * @since 1.0.0
     */   

     public function get( WP_REST_Request $request ) {

        $allowed_params = array(
            array(
                'key' => 'id',
                'placeholder' => '%d', 
            ),
            array(
                'key' => 'title',
                'placeholder' => '%s',
            )
        );

        $response = parent::get_data( $this->table, $allowed_params ); 
        wp_send_json_success( $response );       

    }
    
    /**
     * Handler for wp-json/event-organizer-toolkit/v1/delete-accommodation endpoint
     * 
     * @since 1.0.0
     */   

     public function delete( WP_REST_Request $request ) {

        parent::delete_item( $this->table, $_GET['id'] );     

    }


}