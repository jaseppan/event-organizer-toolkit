<?php

/**
 * Class contains handling CRUD related to participants
 *
 * @link       https://janneseppanen.site
 * @since      1.0.0
 *
 * @package    Event_Organizer_Toolkit
 * @subpackage Event_Organizer_Toolkit/models/rest-api
 * @author     Janne Seppänen <j.v.seppanen@gmail.com>
 */

 class Event_Organizer_Toolkit_Participants_Handler extends Event_Organizer_Toolkit_Request_Handler {

    /**
	 * The database table for participants.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $table    The database table for participants.
	 */

     public $table;

     /**
      * Initialize the class and set its properties.
      *
      * @since    1.0.0
      * @param      string    $table       The database table for participants.
      */
 
     public function __construct() {
 
         global $wpdb;
 
         $this->table = $wpdb->prefix . VENT_ORGANIZER_TOOLKIT_PARTICIPANTS_TABLE;
 
     }
 
     /**
      * Handler for both wp-json/event-organizer-toolkit/v1/add-participant and ../update-participant endpoints
      * 
      * @since 1.0.0
      */ 
 
     public function update( WP_REST_Request $request ) {

        require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/participant-roles' );
 
        global $wpdb;
        global $eot_errors;
        $eot_errors = new WP_Error();
 
        $params = apply_filters( 'eot_json_params', $request->get_json_params() );
    
        // Validate parameters
        parent::validate_required_fields( [
            'first_name',
            'last_name',
            'role_id',
            'event_ids'
        ], $params );
        parent::validate_texts( [
            'first_name',
            'last_name',
            'diet',
        ], $params );    
        parent::validate_integers( [
            'role_id',
            'parent_id',
        ], $params );   
        parent::validate_arrays( [
            [
                'key' => 'event_ids',
                'format' => 'int',
            ]
        ], $params );   
         
        // Collect data

        $id = isset($params['id']) ? (int)$params['id'] : null;

        // Sanitize and collect data
        $data = array(
            'first_name' => sanitize_text_field($params['first_name']),
            'last_name' => sanitize_text_field($params['last_name']),
            'diet' => sanitize_text_field($params['last_name']),
            'role_id' => (int)$params['role_id'],
            'event_ids' => (int)$params['event_ids'],
            'parent_id' => (int)$params['event_id'],
        );

        // Check that the event is valid

        // Check that role is valid

        // Check does registration for same person exist


        parent::check_errors();
 
         // Update if ID exists
         if ( $id !== null ) {
 
             parent::update_data( $this->table, $params, $data, 'Event type' );
 
         } else {
 
             parent::insert_data( $this->table, $data, 'Event type', false );
 
         }
 
     }
    
    /**
     * Handler for wp-json/event-organizer-toolkit/v1/list-participants endpoint
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
     * Handler for wp-json/event-organizer-toolkit/v1/get-participants endpoint
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
     * Handler for wp-json/event-organizer-toolkit/v1/delete-participants endpoint
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