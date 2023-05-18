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
        
        $required_params = array(
            'title' => __('Parameter title is required'),
            'plural_title' => __('Parameter plural_title is required'),
            'name' => __('Parameter name is required'),
            'plural_name' => __('Parameter plural_name is required'),
            'primary_title' => __('Parameter primary_title is required'),
            'primary_name' => __('Parameter primary_name is required')
        );
    
        foreach ($required_params as $param => $error_message) {
            if (!isset($params[$param]) || empty($params[$param])) {
                $errors->add($param, $error_message);
            }
        }
        
        parent::check_errors($errors);
        
        // Collect data

        if( isset( $params['id'] ) )
            $id = $params['id'];

        foreach( $params['taxonomies'] as $taxonomy ) {
            $taxonomies[] =  $taxonomy;
        }
        $taxonomies_s = $taxonomies;

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
            $id = (int) $params['id'];

            // Check that id exists
            $existingId = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT id FROM $table WHERE id = %d",
                $id
                )
            );
            
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