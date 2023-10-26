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

    protected $table;

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
     * Method to get accommodation fields
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
                'type' => 'textarea',
                // 'container-classes' => '',
            ),
            array(
                'name' => 'rooms',
                'label' => __('Rooms:', 'event-organizer-toolkit'),
                'sub-type' => 'repeater',
                'singular-name' => 'room',
                // 'container-classes' => '',
            ),
            
        );

        return $fields;
    }


    /**
     * Method for adding and updating an accommodation
     *
     * @since 1.0.0
     */
    public function update(WP_REST_Request $request)
    {

        $fields = $this->get_fields();
        $property_name = 'Accommodations';
        $check_duplicate = 'title';
        parent::update( $fields, $request, $property_name, $check_duplicate );
        
    }
    
    /**
     * Handler for wp-json/event-organizer-toolkit/v1/list-accommodation endpoint
     * 
     * @since 1.0.0
     */   

     public function list() {

        parent::list_data( $this->table );       

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

    /*public function similar_exists( ) {
        // Check if similar title exists
        if( $check_duplicate && isset( $data[$check_duplicate] ) ) {
            
            if ( $this->similar_exists( $data[$check_duplicate], $table, $check_duplicate ) ) {
                $message = sprintf(
                    esc_html__('An %1$s with similar %2$s already exists: %3$s.', 'event-organizer-toolkit'),
                    esc_html($property_name),
                    esc_html($check_duplicate),
                    esc_html($data[$check_duplicate])
                );
                $response['message'] = $message;
                wp_send_json_error($response, 409);
            }

        }
    }*/

}