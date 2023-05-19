<?php

/**
 * This class serves as a parent class for the classes in the "models" directory
 *
 * @link       https://janneseppanen.site
 * @since      1.0.0
 *
 * @package    Event_Organizer_Toolkit
 * @subpackage Event_Organizer_Toolkit/rest-api
 * @author     Janne Seppänen <j.v.seppanen@gmail.com>
 */

class Event_Organizer_Toolkit_Request_Handler {

    public function __construct(  ) {
        add_filter( 'eot_json_params', array( $this, 'json_params' ) );
    }

    /**
     * Get params from ajax forms and verify nonce
     */

    public function json_params( $json_params ) {

        if( !$json_params ) {

            if( wp_verify_nonce( $_POST['nonce'], 'wp_rest' ) ) {
                $json_params = $_POST;
                return $json_params;
            }
            
            if( wp_verify_nonce( $_GET['nonce'], 'wp_rest' ) ) {
                $json_params = $_GET;
                return $json_params;
            }
            
            wp_send_json_error( ['message' => [['No permission']] ] );
        
        }

        return $json_params;

    }

    /**
     * Handle errors
     */

     public function check_errors() {

        global $eot_errors;
        
        if (count($eot_errors->errors) > 0)
            wp_send_json_error( ((array)$eot_errors) );

     }

     /**
      * Validate required texts
      * @since 1.0.0
      */

    public function validate_required_texts( $required_texts, $params ) {

        global $eot_errors;

        foreach ($required_texts as $text) {
            if (!isset($params[$text]) || empty($params[$text]) || !is_string($params[$text])) {
                $error_message = sprintf(__('Parameter "%s" is required and must be text'), $text);
                $eot_errors->add($text, $error_message);
            }
        }

        return $eot_errors;

    }
     
    /**
     * Validate texts
     * @since 1.0.0
     */

    public function validate_texts( $texts, $params ) {

        global $eot_errors;

        foreach ($texts as $text) {
            if ( isset($params[$text]) && !is_string($params[$text]) ) {
                $error_message = sprintf(__('Parameter "%s" must be text'), $text);
                $eot_errors->add($text, $error_message);
            }
        }

        return $eot_errors;

    }
    
    /**
     * Validate arrays
     * @since 1.0.0
     */

    public function validate_arrays( $arrays, $params ) {

        global $eot_errors;

        foreach ($arrays as $array) {
            if ( isset($params[$array]) && !is_array($params[$array]) ) {
                $error_message = sprintf(__('Parameter "%s" must be array'), $array);
                $eot_errors->add($array, $error_message);
            }
        }

        return $eot_errors;

    }

     /**
      * Method for check if similar title exists
      */

     public function id_exists( $id, $table ) {

        global $wpdb;

        $sql = $wpdb->prepare(
            "SELECT id FROM $table WHERE id= %d",
            $id
        );
        
        $existingTitle = $wpdb->get_var($sql);
        
        return $existingTitle;

    }
     
    /**
      * Method for check if similar title exists
      */

     public function similar_exists( $title, $table, $check_duplicate ) {

        global $wpdb;

        $sql = $wpdb->prepare(
            "SELECT id FROM $table WHERE $check_duplicate = %s",
            $title
        );

        
        $existingDuplicate = $wpdb->get_var($sql);
        
        return $existingDuplicate;

    }

    public function insert_data( $table, $data, $property_name, $check_duplicate = 'title' ) {

        global $wpdb;
        // Check if similar title exists
        if( $check_duplicate ) {
            
            if ( $this->similar_exists( $data[$check_duplicate], $table, $check_duplicate ) ) {
                $message = sprintf(__('An %1$s with similar %2$s already exists: %3$s.', 'event-organizer-toolkit'), $property_name, $check_duplicate, $data['title']);
                $response['message'] = $message;
                wp_send_json_error($response);
            }

        }

        
        $result = $wpdb->insert($table, $data);
       
        wp_send_json_success( $data );
        
        if ($result !== false) {
            $message = sprintf(__('%1$s %2$s inserted.', 'event-organizer-toolkit'), $property_name, $data['title']);
            $status = 'success';
            $id = $wpdb->insert_id;
        } else {
            $message = sprintf(__('Error inserting %1$s %2$s.', 'event-organizer-toolkit'), $property_name, $data['title']);
            $status = 'error';
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

    public function update_data( $table, $params, $data, $property_name ) {

        global $wpdb;

        // Check if id is numeric
        if ( !is_numeric($params['id']) || $params['id'] == 0) {
            $message = sprintf(__('The parameter "id" must be numeric.', 'event-organizer-toolkit'), $data['title']);
            $response['message'] = $message;
            wp_send_json_error( $response );
        }

        $id = (int) $params['id'];

        // Check that id exists
        if ( !$this->id_exists( $id, $this->table ) ) {
            $message = sprintf(__('The provided ID does not correspond to an existing record.', 'event-organizer-toolkit'), $data['title']);
            $response['message'] = $message;
            wp_send_json_error( $response );
        }

        $result = $wpdb->update(
            $this->table,
            $data,
            array('id' => $id),
        );

        if( $result ) {
            $message = sprintf( __('%1$s %2$s updated.', 'event-organizer-toolkit'), $property_name, $data['title'] );
            $status = 'success';
        } else {
            $message = sprintf(__('%1$s %2$s not updated. No changes were made to the data.', 'event-organizer-toolkit'), $property_name, $data['title']);
            $status = 'error';
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

}