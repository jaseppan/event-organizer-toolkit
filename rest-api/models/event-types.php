<?php

/**
 * Class contains handling CRUD related to event types
 *
 * @link       https://janneseppanen.site
 * @since      1.0.0
 *
 * @package    Event_Organizer_Toolkit
 * @subpackage Event_Organizer_Toolkit/models/rest-api
 * @author     Janne Seppänen <j.v.seppanen@gmail.com>
 */

 class Event_Organizer_Toolkit_Event_Types_Handler extends Event_Organizer_Toolkit_Request_Handler {

     
    /**
	 * The database table for event types.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $table    The database table for event types.
	 */

    public $table;

    /**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $table       The database table for event types.
	 */

    public function __construct() {

        global $wpdb;

        $this->table = $wpdb->prefix . EVENT_ORGANIZER_TOOLKIT_EVENT_TYPES_TABLE;

    }

    /**
     * Handler for both wp-json/event-organizer-toolkit/v1/add-event-type and ../update-event-type endpoints
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
            'plural_title',
            'name',
            'plural_name',
            'primary_title',
            'primary_name',
        ], $params );
        parent::validate_texts( [
            'title',
            'plural_title',
            'name',
            'plural_name',
            'primary_title',
            'primary_name',
            'description'
        ], $params );
        parent::validate_arrays( [
            [
                'key' => 'taxonomies',
                'format' => 'string',
            ]
        ], $params );        
        
        parent::check_errors();
        
        // Collect data

        $id = isset($params['id']) ? (int)$params['id'] : null;

        // Sanitize and collect data
        $data = array(
            'title' => sanitize_text_field($params['title']),
            'plural_title' => sanitize_text_field($params['plural_title']),
            'name' => sanitize_text_field($params['name']),
            'plural_name' => sanitize_text_field($params['plural_name']),
            'primary_title' => sanitize_text_field($params['primary_title']),
            'primary_name' => sanitize_text_field($params['primary_name']),
            'description' => isset($params['description']) ? wp_kses_post($params['description']) : '',
            'taxonomies' => isset($params['taxonomies']) ? serialize(array_map('sanitize_text_field', $params['taxonomies'])) : '',
        );

        // Update if ID exists
        if ( $id !== null ) {

            parent::update_data( $this->table, $params, $data, 'Event type' );

        } else {

            parent::insert_data( $this->table, $data, 'Event type' );

        }

    }
    
    
    /**
     * Handler for wp-json/event-organizer-toolkit/v1/list-event-type endpoint
     * 
     * @since 1.0.0
     */   

     public function list( WP_REST_Request $request ) {

        wp_send_json_success( ['test'] );
        return ['test'];

        $params = apply_filters( 'eot_json_params', $request->get_json_params() );

        $response = [
            'state' => 'test list',
        ];


        return $response;       

    }
    
    /**
     * Handler for wp-json/event-organizer-toolkit/v1/get-event-type endpoint
     * 
     * @since 1.0.0
     */   

     public function get( WP_REST_Request $request ) {

        $params = apply_filters( 'eot_json_params', $request->get_json_params() );

        $response = [
            'state' => 'test get',
        ];

        return $response;       

    }
    
    /**
     * Handler for wp-json/event-organizer-toolkit/v1/delete-event-type endpoint
     * 
     * @since 1.0.0
     */   

     public function delete( WP_REST_Request $request ) {

        $params = apply_filters( 'eot_json_params', $request->get_json_params() );

        $response = [
            'state' => 'test delete',
        ];

        return $response;       

    }

}