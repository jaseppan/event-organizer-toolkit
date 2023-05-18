<?php

/**
 * Events handler of the plugin.
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
     * Handler for both wp-json/event-organizer-toolkit/v1/add-event-type and ../update-event-type endpoints
     * 
     * @since 1.0.0
     */   

    private $table;

    public function __construct() {

        global $wpdb;

        $this->table = $wpdb->prefix . EVENT_ORGANIZER_TOOLKIT_EVENT_TYPES_TABLE;

    }

    public function update( WP_REST_Request $request ) {

        global $wpdb;

        $params = apply_filters( 'eot_json_params', $request->get_json_params() );
        $errors = new WP_Error();

        // validate parameters
        
        // Validate that parameter values are text
        $required_params = array(
            'title' => __('Parameter "title" is required and must be text'),
            'plural_title' => __('Parameter "plural_title" is required and must be text'),
            'name' => __('Parameter "name" is required and must be text'),
            'plural_name' => __('Parameter "plural_name" is required and must be text'),
            'primary_title' => __('Parameter "primary_title" is required and must be text'),
            'primary_name' => __('Parameter "primary_name" is required and must be text'),
        );
    
        foreach ($required_params as $param => $error_message) {
            if (!isset($params[$param]) || empty($params[$param]) || !is_string($params[$param])) {
                $errors->add($param, $error_message);
            }
        }

        // Check if description is a text
        if (isset($params['description']) && !is_string($params['description'])) {
            $errors->add('description', 'Parameter "description" must be text');
        }

        // Check if taxonomies is an array
        if ( isset($params['taxonomies']) && !is_array($params['taxonomies']) ) {
            $errors->add('taxonomies', __('Parameter taxonomies must be an array'));
        }
        
        parent::check_errors($errors);
        
        // Collect data

        if( isset( $params['id'] ) )
            $id = $params['id'];


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
        if (isset($params['id'])) {

            // Check if id is numeric
            if ( !is_numeric($params['id']) || $params['id'] == 0) {
                $message = sprintf(__('The parameter "id" must be numeric.', 'event-organizer-toolkit'), $data['title']);
                $response['message'] = $message;
                wp_send_json_error( $response );
            }

            $id = (int) $params['id'];

            // Check that id exists
            if ( !parent::id_exists( $id, $this->table ) ) {
                $message = sprintf(__('The provided ID does not correspond to an existing record.', 'event-organizer-toolkit'), $data['title']);
                $response['message'] = $message;
                wp_send_json_error( $response );
            }

            $result = $wpdb->update(
                $this->table,
                $data,
                array('id' => $id),
                array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'),
                array('%d')
            );

            if( $result ) {
                $message = sprintf( __('Event type %1$s updated.', 'event-organizer-toolkit'), $data['title'] );
                $status = 'success';
            } else {
                $message = sprintf(__('Accommodation not updated. No changes were made to the data.', 'event-organizer-toolkit'), $data['title']);
                $status = 'error';
            }

        } else {

            // Check if similar title exists
            if ( parent::similar_title_exists( $data['title'], $this->table ) ) {
                $message = sprintf(__('An event type with similar title already exists: %1$s.', 'event-organizer-toolkit'), $data['title']);
                $response['message'] = $message;
                wp_send_json_error($response);
            }

            $result = $wpdb->insert($this->table, $data);

            if ($result !== false) {
                $message = sprintf(__('Event type %1$s inserted.', 'event-organizer-toolkit'), $data['title']);
                $status = 'success';
                $id = $wpdb->insert_id;
            } else {
                $message = sprintf(__('Error inserting event type %1$s.', 'event-organizer-toolkit'), $data['title']);
                $status = 'error';
            }
        }

        if ($status === 'success') {
            if (!isset($data['id'])) {
                $data = array_merge(['id' => $id], $data);
            }

            $response['message'] = $message;
            $response['data'] = $data;

            wp_send_json_success($response);
        } else {
            $response['message'] = $message;
            wp_send_json_error($response);
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