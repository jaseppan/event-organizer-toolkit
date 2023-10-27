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
     * Method to get definitions fields. The post_types for event types are set by field values
     * @since    1.0.0
     * @return array
     */

     public function get_fields() {
        $fields = array(
            array(
                'name' => 'name',
                'label' => __('Name', 'event-organizer-toolkit'),
                'attributes' => 'required',
                // 'container-classes' => '',
            ),
            array(
                'name' => 'post_type',
                'label' => __('Post type', 'event-organizer-toolkit'),
                'type' => 'select',
                'attributes' => 'required',
                'options' => eot_get_post_types(),
                // 'container-classes' => '',
            ),
            array(
                'name' => 'taxonomy',
                'label' => __('Taxonomy', 'event-organizer-toolkit'),
                'type' => 'text',
                // 'container-classes' => '',
            ),
        );

        return $fields;

    }

    /**
     * Handler for both wp-json/event-organizer-toolkit/v1/add-event-type and ../update-event-type endpoints
     * 
     * @since 1.0.0
     */ 

    public function update( WP_REST_Request $request ) {

        $fields = $this->get_fields();
        $property_name = 'Event types';
        $check_duplicate = 'post_type';
        parent::updater( $fields, $request, $property_name, $check_duplicate );

    }
    
    
    /**
     * Handler for wp-json/event-organizer-toolkit/v1/list-event-type endpoint
     * 
     * @since 1.0.0
     */   

     public function list( WP_REST_Request $request ) {

        parent::list_data( $this->table );   

    }
    
    /**
     * Handler for wp-json/event-organizer-toolkit/v1/get-event-type endpoint
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
                'key' => 'name',
                'placeholder' => '%s',
            ),
            array(
                'key' => 'post_type',
                'placeholder' => '%s',
            ),
            array(
                'key' => 'taxonomy',
                'placeholder' => '%s',
            )
        );

        $response = parent::get_data( $this->table, $allowed_params, '', 'title' ); 
        wp_send_json_success( $response );       

    }
    
    /**
     * Handler for wp-json/event-organizer-toolkit/v1/delete-event-type endpoint
     * 
     * @since 1.0.0
     */   

     public function delete( WP_REST_Request $request ) {

        parent::delete_item( $this->table, $_GET['id'] );      

    }

}