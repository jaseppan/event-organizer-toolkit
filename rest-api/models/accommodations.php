<?php

/**
 * Class contains handling CRUD related to accommodations
 *
 * @link       https://janneseppanen.site
 * @since      1.0.0
 *
 * @package    Event_Organizer_Toolkit
 * @subpackage Event_Organizer_Toolkit/models/rest-api
 * @author     Janne Seppänen <j.v.seppanen@gmail.com>
 */

 class Event_Organizer_Toolkit_Accommodations_Handler extends Event_Organizer_Toolkit_Request_Handler {

    /**
	 * The database table for accommodations.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $table    The database table for accommodations.
	 */

    public $table;

    /**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $table       The database table for accommodations.
	 */

    public function __construct() {

        global $wpdb;

        $this->table = $wpdb->prefix . EVENT_ORGANIZER_TOOLKIT_ACCOMMODATIONS_TABLE;

    }


    /**
     * Method for adding and updating an accommodation
     *
     * @since 1.0.0
     */
    public function update(WP_REST_Request $request)
    {
        global $wpdb;
        global $eot_errors;
        $eot_errors = new WP_Error();

        $params = apply_filters( 'eot_json_params', $request->get_json_params() );
    
        // Validate parameters
        parent::validate_required_fields( ['title'], $params );
        parent::validate_texts( ['title','description'], $params );
        parent::validate_arrays( [
            [
                'key' => 'rooms',
                'format' => 'string',
            ]
        ], $params );        
        
        parent::check_errors();
        
        // Collect data

        $id = isset($params['id']) ? (int)$params['id'] : null;

        // Sanitize and collect data
        $data = array(
            'title' => sanitize_text_field($params['title']),
            'description' => isset($params['description']) ? wp_kses_post($params['description']) : '',
            'rooms' => isset($params['rooms']) ? serialize(array_map('sanitize_text_field', $params['rooms'])) : '',
        );

        // Update if ID exists
        if ( $id !== null ) {

            parent::update_data( $this->table, $params, $data, 'Accommodation' );

        } else {

            parent::insert_data( $this->table, $data, 'Accommodation' );

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