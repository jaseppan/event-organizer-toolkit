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

    private $table;

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
     * Method to get definitions fields
     * @since    1.0.0
     * @return array
     */

    public function get_fields() {
        $fields = array(
            array(
                'name' => 'title',
                'label' => __('Title', 'event-organizer-toolkit'),
                // 'type' => '',
                'attributes' => 'required',
                // 'container-classes' => '',
            ),
            array(
                'name' => 'description',
                'label' => __('Description', 'event-organizer-toolkit'),
                // 'type' => '',
                'attributes' => 'required',
                // 'container-classes' => '',
            ),
            array(
                'name' => 'rooms',
                'label' => __('Rooms:', 'event-organizer-toolkit'),
                'sub-type' => 'repeater',
                'singular-name' => 'room',
                'item-format' => 'string'
                // 'container-classes' => '',
            ),
            
        );

        return $fields;

    }

    /**
     * Method to get list of required fields
     * @since    1.0.0
     * @return array
     */

    public function get_required_fields() {
        return array('title');
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

        $fields = $this->get_fields();
    
        // Validate parameters
        parent::validate_required_fields( $this->get_required_fields(), $params );

        foreach( $fields as $field ) {
            if( $field['sub-type'] == 'repeater' ) {
                parent::validate_arrays( [
                    [
                        'key' => $field['name'],
                        'format' => $field['item-format'],
                    ]
                ], $params );
            } else {
                if( $field['type'] == 'text' ) {
                    parent::validate_texts( [
                        'title',
                        'description'
                    ], $params );
                }
            }
        }      
        
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

     public function list() {

        $keywords = array();

        if( isset( $_GET['order_by'] ) )
            $keywords['order_by'] = sanitize_text_field( $_GET['order_by'] );

        if( isset($_GET['order']) )
            $keywords['order'] = sanitize_text_field( $_GET['order'] );

        if( isset($_GET['search']) ) {
            $keywords['search'] = sanitize_text_field( $_GET['search'] );
            if( isset($_GET['search-from']) ) {
                $allowed_params = array(
                    array(
                        'key' => sanitize_key( $_GET['search-from'] ),
                    )
                );
            } else {
                $allowed_params = array(
                    array(
                        'key' => 'id',
                        'placeholder' => '%d', 
                    ),
                    array(
                        'key' => 'title',
                        'placeholder' => '%s',
                    ),
                    array(
                        'key' => 'description',
                        'placeholder' => '%s',
                    ),
                );
            }
        }

        if( isset($_GET['page']) ) 
            $keywords['page'] = (int) $_GET['page'];

        if( isset($_GET['items_per_page']) )
            $keywords['items_per_page'] = (int) $_GET['items_per_page'];

        parent::list_data( $this->table, $allowed_params, $keywords );       

    }
    
    /**
     * Handler for wp-json/event-organizer-toolkit/v1/get-accommodation endpoint
     * 
     * @since 1.0.0
     */   

     public function get() {

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
        $response = $this->unserialize_data( $response );
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