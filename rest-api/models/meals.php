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
      * Handler for both wp-json/event-organizer-toolkit/v1/add-meal and ../update-meal endpoints
      * 
      * @since 1.0.0
      */ 
 
     public function update( WP_REST_Request $request ) {
 
         global $wpdb;
         global $eot_errors;
         $eot_errors = new WP_Error();
 
         $params = apply_filters( 'eot_json_params', $request->get_json_params() );
     
         // Validate parameters
         parent::validate_required_fields( [
             'title',
             'date',
             'time',
         ], $params );
         parent::validate_texts( [
            'title',
            'venue', 
            'menu'
        ], $params );       
        parent::validate_dates( [
            'date',
        ], $params );       
        parent::validate_times( [
            'start_time',
            'end_time',
        ], $params );       
         
         parent::check_errors();
         
         // Collect data
 
         $id = isset($params['id']) ? (int)$params['id'] : null;
 
         // Sanitize and collect data
         $data = array(
            'title' => sanitize_text_field($params['title']),
            'date' => sanitize_text_field($params['date']),
            'start_time' => sanitize_text_field($params['start_time']),
            'end_time' => sanitize_text_field($params['end_time']),
            'venue' => isset($params['venue']) ? sanitize_text_field($params['venue']) : '',
            'menu' => isset($params['menu']) ? sanitize_text_field($params['menu']) : ''
        );
 
         // Update if ID exists
         if ( $id !== null ) {
 
             parent::update_data( $this->table, $params, $data, 'Event type' );
 
         } else {
 
             parent::insert_data( $this->table, $data, 'Event type', false );
 
         }
 
     }
    
    /**
     * Handler for wp-json/event-organizer-toolkit/v1/list-accommodation endpoint
     * 
     * @since 1.0.0
     */   

     public function list( WP_REST_Request $request ) {

        $json_params = apply_filters( 'eot_json_params', $request->get_json_params() );

        $response = [
            'state' => 'test list',
        ];

        return $response;       

    }
    
    /**
     * Handler for wp-json/event-organizer-toolkit/v1/get-accommodation endpoint
     * 
     * @since 1.0.0
     */   

     public function get( WP_REST_Request $request ) {

        $json_params = apply_filters( 'eot_json_params', $request->get_json_params() );

        $response = [
            'state' => 'test get',
        ];

        return $response;       

    }
    
    /**
     * Handler for wp-json/event-organizer-toolkit/v1/delete-accommodation endpoint
     * 
     * @since 1.0.0
     */   

     public function delete( WP_REST_Request $request ) {

        $json_params = apply_filters( 'eot_json_params', $request->get_json_params() );

        $response = [
            'state' => 'test delete',
        ];

        return $response;       

    }


}