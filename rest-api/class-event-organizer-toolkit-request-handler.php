<?php

/**
 * This class is responsible for handling REST-API requests
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

}