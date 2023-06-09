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

    public function validate_required_fields( $fields, $params ) {

        global $eot_errors;

        foreach ($fields as $field) {
            if (!isset($params[$field]) || empty($params[$field]) || !is_string($params[$field])) {
                $error_message = sprintf(__('Parameter "%s" is required'), $field);
                $eot_errors->add($field, $error_message);
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
     * Validate integers
     * @since 1.0.0
     */

    public function validate_integers( $integers, $params ) {

        global $eot_errors;

        foreach ($integers as $integer) {
            if ( isset($params[$integer]) && !is_int($params[$integer]) ) {
                $error_message = sprintf(__('Parameter "%s" must be integer'), $integer);
                $eot_errors->add($integer, $error_message);
            }
        }

        return $eot_errors;

    }
    
    /**
     * Validate dates
     * @since 1.0.0
     */

    public function validate_dates( $dates, $params ) {

        global $eot_errors;

        foreach ($dates as $integer) {
            if ( isset($params[$date]) && !$this->is_valid_date($params[$date]) ) {
                $error_message = sprintf(__('Parameter "%s" is not valid date'), $date);
                $eot_errors->add($date, $error_message);
            }
        }

        return $eot_errors;

    }
    
    /**
     * Validate times
     * @since 1.0.0
     */

    public function validate_times( $times, $params ) {

        global $eot_errors;

        foreach ($times as $integer) {
            if ( isset($params[$time]) && !$this->is_valid_date($params[$time], 'H:i:s') ) {
                $error_message = sprintf(__('Parameter "%s" is not valid time'), $time);
                $eot_errors->add($time, $error_message);
            }
        }

        return $eot_errors;

    }

    function is_valid_date($date, $format = 'Y-m-d') {
        $dateTime = DateTime::createFromFormat($format, $date);
        return $dateTime && $dateTime->format($format) === $date;
    }
    
    /**
     * Validate emails
     * @since 1.0.0
     */

    public function validate_emails( $emails, $params ) {

        global $eot_errors;

        foreach ($emails as $email) {
            if ( isset($params[$email]) && !is_array($params[$email]) ) {
                $error_message = sprintf(__('Parameter "%s" is not valid email'), $email);
                $eot_errors->add($email, $error_message);
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
            if ( isset($params[$array]) ) {
                if( !is_array($params[$array]) ) {
                    $error_message = sprintf(__('Parameter "%s" must be array'), $array);
                    $eot_errors->add($array, $error_message);
                } else {
                    $this->validate_array_values( $array, $params );
                }
            } 
        }

        return $eot_errors;

    }

    /**
     * Method to validate values in array
     */

     function validate_array_values( $array, $params ) {

        foreach ($array as $key => $field) { 
            $format = $value['format'];
            if( $value[$format] == 'string' ) {
                if ( !is_string($params[$field['key'][$key]]) ) {
                    $error_message = sprintf(__('Values in parameter "%s" must be text'), $field);
                    $eot_errors->add($field, $error_message);
                }
            }
            if( $value[$format] == 'int' ) {
                if ( !is_int($params[$field['key'][$key]]) ) {
                    $error_message = sprintf(__('Values in parameter "%s" must be integers'), $field);
                    $eot_errors->add($field, $error_message);
                }
            }
        }

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
        if( $check_duplicate && isset( $data[$check_duplicate] ) ) {
            
            if ( $this->similar_exists( $data[$check_duplicate], $table, $check_duplicate ) ) {
                $message = sprintf(__('An %1$s with similar %2$s already exists: %3$s.', 'event-organizer-toolkit'), $property_name, $check_duplicate, $data[$check_duplicate]);
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

    function validate_international_zip_code($zipcode, $countryCode) {
        // Regular expressions for different countries' ZIP code formats
        $patterns = [
            'US' => '/^\d{5}(-\d{4})?$/',
            'CA' => '/^[A-Z]\d[A-Z] \d[A-Z]\d$/',
            'AL' => '/^\d{4}$/',
            'AD' => '/^[A-Z]\d{3}$/',
            'AT' => '/^\d{4}$/',
            'BY' => '/^\d{6}$/',
            'BE' => '/^\d{4}$/',
            'BA' => '/^\d{5}$/',
            'BG' => '/^\d{4}$/',
            'HR' => '/^\d{5}$/',
            'CY' => '/^\d{4}$/',
            'CZ' => '/^\d{3} \d{2}$/',
            'DK' => '/^\d{4}$/',
            'EE' => '/^\d{5}$/',
            'FO' => '/^\d{3}$/',
            'FI' => '/^\d{5}$/',
            'FR' => '/^\d{5}$/',
            'DE' => '/^\d{5}$/',
            'GI' => '/^[A-Z]{2} \d{1,2}$/',
            'GR' => '/^\d{3} \d{2}$/',
            'HU' => '/^\d{4}$/',
            'IS' => '/^\d{3}$/',
            'IE' => '/^[A-Z]\d{2} \d{2}$/',
            'IT' => '/^\d{5}$/',
            'LV' => '/^\d{4}$/',
            'LI' => '/^(948[5-9]|949[0-7])$/',
            'LT' => '/^\d{5}$/',
            'LU' => '/^\d{4}$/',
            'MK' => '/^\d{4}$/',
            'MT' => '/^[A-Z]{3} \d{2,3}$/',
            'MD' => '/^\d{4}$/',
            'MC' => '/^980\d{2}$/',
            'ME' => '/^\d{5}$/',
            'NL' => '/^\d{4} [A-Z]{2}$/',
            'NO' => '/^\d{4}$/',
            'PL' => '/^\d{2}-\d{3}$/',
            'PT' => '/^\d{4}-\d{3}$/',
            'RO' => '/^\d{6}$/',
            'RU' => '/^\d{6}$/',
            'SM' => '/^4789\d$/',
            'RS' => '/^\d{5}$/',
            'SK' => '/^\d{3} \d{2}$/',
            'SI' => '/^\d{4}$/',
            'ES' => '/^\d{5}$/',
            'SE' => '/^\d{3} \d{2}$/',
            'CH' => '/^\d{4}$/',
            'UA' => '/^\d{5}$/',
            'GB' => '/^[A-Z]\d[A-Z] \d[A-Z]{2}$/',
            'AF' => '/^\d{4}$/',
            'AM' => '/^\d{6}$/',
            'AZ' => '/^\d{4}$/',
            'BH' => '/^\d{3,4}$/',
            'BD' => '/^\d{4}$/',
            'BN' => '/^[A-Z]{2}\d{4}$/',
            'KH' => '/^\d{5}$/',
            'CN' => '/^\d{6}$/',
            'GE' => '/^\d{4}$/',
            'IN' => '/^\d{6}$/',
            'ID' => '/^\d{5}$/',
            'IR' => '/^\d{10}$/',
            'IQ' => '/^\d{5}$/',
            'IL' => '/^\d{5}|\d{7}$/',
            'JP' => '/^\d{3}-\d{4}$/',
            'JO' => '/^\d{5}$/',
            'KZ' => '/^\d{6}$/',
            'KP' => '/^\d{6}$/',
            'KR' => '/^\d{5}$/',
            'KW' => '/^\d{5}$/',
            'KG' => '/^\d{6}$/',
            'LA' => '/^\d{5}$/',
            'LB' => '/^\d{4}( \d{4})?$/',
            'MY' => '/^\d{5}$/',
            'MV' => '/^\d{5}$/',
            'MN' => '/^\d{5}$/',
            'MM' => '/^\d{5}$/',
            'NP' => '/^\d{5}$/',
            'OM' => '/^\d{3}$/',
            'PK' => '/^\d{5}$/',
            'PH' => '/^\d{4}$/',
            'QA' => '/^\d{4}$/',
            'SA' => '/^\d{5}$/',
            'SG' => '/^\d{6}$/',
            'LK' => '/^\d{5}$/',
            'SY' => '/^\d{5}$/',
            'TW' => '/^\d{3}(\d{2})?$/',
            'TJ' => '/^\d{6}$/',
            'TH' => '/^\d{5}$/',
            'TR' => '/^\d{5}$/',
            'TM' => '/^\d{6}$/',
            'AE' => '/^\d{5}$/',
            'UZ' => '/^\d{6}$/',
            'VN' => '/^\d{6}$/',
            'YE' => '/^\d{5}$/',
            'AR' => '/^[A-Z]\d{4}[A-Z]{3}$/',
            'BO' => '/^\d{4}$/',
            'BR' => '/^\d{5}-\d{3}$/',
            'CL' => '/^\d{7}$/',
            'CO' => '/^\d{6}$/',
            'CR' => '/^\d{4,5}$/',
            'CU' => '/^\d{5}$/',
            'DO' => '/^\d{5}$/',
            'EC' => '/^\d{6}$/',
            'SV' => '/^\d{4}$/',
            'GT' => '/^\d{5}$/',
            'HT' => '/^\d{4}$/',
            'HN' => '/^\d{5}$/',
            'JM' => '/^\d{2}$/',
            'MX' => '/^\d{5}$/',
            'NI' => '/^\d{5}$/',
            'PA' => '/^\d{6}$/',
            'PY' => '/^\d{4}$/',
            'PE' => '/^\d{5}$/',
            'PR' => '/^\d{5}$/',
            'SR' => '/^[A-Z]{2}-\d{4}$/',
            'TT' => '/^\d{6}$/',
            'UY' => '/^\d{5}$/',
            'VE' => '/^\d{4}$/',
            'AU' => '/^\d{4}$/',
            'NZ' => '/^\d{4}$/',
            'FM' => '/^\d{5}(-\d{4})?$/',
        ];
    
        if (isset($patterns[$countryCode])) {
            $pattern = $patterns[$countryCode];
            return preg_match($pattern, $zipcode) === 1;
        }
    
        return false; // Country code not supported
    }

}