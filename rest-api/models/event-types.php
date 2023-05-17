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

     public function update( WP_REST_Request $request ) {

        global $wpdb;
        $table = $wpdb->prefix . EVENT_ORGANIZER_TOOLKIT_EVENT_TYPES_TABLE;

        $params = apply_filters( 'eot_json_params', $request->get_json_params() );
        $errors = new WP_Error();

        // validate parameters
        
        if( !isset( $params['title'] ) || empty( $params['title'] ) )
            $errors->add( 'title', __('Parameter title is required') );
        
        if( !isset( $params['plural_title'] ) || empty( $params['plural_title'] ) )
            $errors->add( 'title', __('Parameter plural_title is required') );

        if( !isset( $params['name'] ) || empty( $params['name'] ) )
            $errors->add( 'name', __('Parameter name is required') );

        if( !isset( $params['plural_name'] ) || empty( $params['plural_name'] ) )
            $errors->add( 'plural_name', __('Parameter plural_name is required') );
        
        if( !isset( $params['primary_title'] ) || empty( $params['primary_title'] ) )
            $errors->add( 'primary_title', __('Parameter primary_title is required') );

        if( !isset( $params['primary_name'] ) || empty( $params['primary_name'] ) )
            $errors->add( 'primary_name', __('Parameter primary_name is required') );
        
        parent::check_errors($errors);
        
        // Sanitize parameters
        if( isset( $params['id'] ) )
            $id = intval($params['id']);

        $data['title'] = sanitize_text_field( $params['title'] );
        $data['plural_title'] = sanitize_text_field( $params['plural_title'] );
        $data['name'] = sanitize_text_field( $params['name'] );
        $data['plural_name'] = sanitize_text_field( $params['plural_name'] );
        $data['primary_title'] = sanitize_text_field( $params['primary_title'] );
        $data['primary_name'] = sanitize_text_field( $params['primary_name'] );
        $data['description'] = (isset($params['description'])) ? sanitize_text_field( $params['description'] ) : '';
        $data['taxonomies'] = [];
        foreach( $params['taxonomies'] as $taxonomy ) {
            $data['taxonomies'] = sanitize_text_field( $taxonomy );
        }
        
        // wp_send_json_success( $taxonomies );

        // Update if id exists
        if( isset( $id ) ) {
 

            $result = $wpdb->update($table, $data, [
                'id' => $id
            ]);

            if( $result ) {
                $message = sprintf( __('Event type %1$s updated.', 'event-organizer-toolkit'), $data['title'] );
                $status  ='success';
            } else {
                $message = sprintf( __('Error updating event type %1$s.', 'event-organizer-toolkit'), $data['title'] );
                $status  ='error';
            }

        } else {

            $result = $wpdb->insert($table, $data);

            if( $result ) {
                $message = sprintf( __('Event type %1$s inserted.', 'event-organizer-toolkit'), $data['title'] );
                $status  ='success';
                $id = $wpdb->insert_id;
            } else {
                $message = sprintf( __('Error inserting event type %1$s.', 'event-organizer-toolkit'), $data['title'] );
                $status  ='error';
            }

        }

        if( $status == 'success' ) {
            if( isset($id) )
                $response['id'] = $id;

            $response['message'] = $message;
            wp_send_json_success( $response );

        } else {

            $response['message'] = $message;
            wp_send_json_error( $response );

        }



        parent::success( $response );
           
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