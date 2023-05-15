<?php

/**
 * The rest-api functionality of the plugin.
 *
 * @since      1.0.0
 *
 * @package    Event_Organizer_Toolkit
 * @subpackage Tet_Harjoittelut/includes
 * @author     Janne Seppänen <j.v.seppanen@gmail.com>
 */
class Event_Organizer_Toolkit_Rest_Api {

	public function __construct() {

        // Events
        add_action('rest_api_init', array($this, 'add_event'));
        add_action('rest_api_init', array($this, 'list_events'));
        add_action('rest_api_init', array($this, 'get_event'));
        add_action('rest_api_init', array($this, 'edit_event'));
        add_action('rest_api_init', array($this, 'detele_event'));
        
        // Participants
        add_action('rest_api_init', array($this, 'add_participant'));
        add_action('rest_api_init', array($this, 'list_participants'));
        add_action('rest_api_init', array($this, 'get_participant'));
        add_action('rest_api_init', array($this, 'edit_participant'));
        add_action('rest_api_init', array($this, 'detele_participant'));
        add_action('rest_api_init', array($this, 'detele_participant'));
        
        // Meals
        add_action('rest_api_init', array($this, 'add_meal'));
        add_action('rest_api_init', array($this, 'list_meals'));
        add_action('rest_api_init', array($this, 'get_meal'));
        add_action('rest_api_init', array($this, 'edit_meal'));
        add_action('rest_api_init', array($this, 'detele_meal'));

        // Accommodation
        add_action('rest_api_init', array($this, 'add_acoommodation'));
        add_action('rest_api_init', array($this, 'list_acoommodations'));
        add_action('rest_api_init', array($this, 'get_acoommodation'));
        add_action('rest_api_init', array($this, 'edit_acoommodation'));
        add_action('rest_api_init', array($this, 'detele_acoommodation'));

    }

    /**
     * Routes to for events handling
     */

    /**
     * Endpoint to add new event
     * @since 1.0.0
     */

    public function add_event() {
        register_rest_route( 'event-organizer-toolkit/v1', '/add-event',array(
                 'methods' => 'POST',
                 'callback' => function() {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/events.php' );
                     $handler = NEW Event_Organizer_Toolkit_Events_Handler();
                     array($this->handler, 'add');
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }

    /**
     * Endpoint to list events
     * @since 1.0.0
     */
    
    public function list_events() {
        register_rest_route( 'event-organizer-toolkit/v1', '/list-events',array(
                 'methods' => 'GET',
                 'callback' => function() {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/events.php' );
                     $handler = NEW vent_Organizer_Toolkit_Events_Handler();
                     array($this->handler, 'list');
                 },
                 'permission_callback' => '__return_true',
             )
         );
    }

    /**
     * Endpoint to edit event
     * @since 1.0.0
     */

    public function edit_event() {
        register_rest_route( 'event-organizer-toolkit/v1', '/edit-event',array(
                 'methods' => 'PATCH',
                 'callback' => function() {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/events.php' );
                     $handler = NEW Event_Organizer_Toolkit_Events_Handler();
                     array($this->handler, 'edit');
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }
    
    /**
     * Endpoint to delete events
     * @since 1.0.0
     */

    public function delete_event() {
        register_rest_route( 'event-organizer-toolkit/v1', '/delete-event',array(
                 'methods' => 'DELETE',
                 'callback' => function() {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/events.php' );
                     $handler = NEW Event_Organizer_Toolkit_Events_Handler();
                     array($this->handler, 'delete');
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }

    /**
     * Routes to for participants handling
     */

    /**
     * Endpoint to add new participant
     * @since 1.0.0
     */

     public function add_participant() {
        register_rest_route( 'event-organizer-toolkit/v1', '/add-participant',array(
                 'methods' => 'POST',
                 'callback' => function() {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/participants.php' );
                     $handler = NEW Event_Organizer_Toolkit_Participants_Handler();
                     array($this->handler, 'add');
                 },
                 'permission_callback' => '__return_true',
             )
         );
    }

    /**
     * Endpoint to list participants
     * @since 1.0.0
     */
    
    public function list_participants() {
        register_rest_route( 'event-organizer-toolkit/v1', '/list-participants',array(
                 'methods' => 'GET',
                 'callback' => function() {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/participants.php' );
                     $handler = NEW Event_Organizer_Toolkit_Participants_Handler();
                     array($this->handler, 'list');
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }

    /**
     * Endpoint to edit participant
     * @since 1.0.0
     */

    public function edit_participant() {
        register_rest_route( 'event-organizer-toolkit/v1', '/edit-participant',array(
                 'methods' => 'PATCH',
                 'callback' => function() {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/participants.php' );
                     $handler = NEW Event_Organizer_Toolkit_Participants_Handler();
                     array($this->handler, 'edit');
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }
    
    /**
     * Endpoint to delete participants
     * @since 1.0.0
     */

    public function delete_participant() {
        register_rest_route( 'event-organizer-toolkit/v1', '/delete-participant',array(
                 'methods' => 'DELETE',
                 'callback' => function() {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/participants.php' );
                     $handler = NEW Event_Organizer_Toolkit_Participants_Handler();
                     array($this->handler, 'delete');
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }

    /**
     * Routes to for meals handling
     */

    /**
     * Endpoint to add new meal
     * @since 1.0.0
     */

     public function add_meal() {
        register_rest_route( 'event-organizer-toolkit/v1', '/add-meal',array(
                 'methods' => 'POST',
                 'callback' => function() {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/meals.php' );
                     $handler = NEW Event_Organizer_Toolkit_Meals_Handler();
                     array($this->handler, 'add');
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }

    /**
     * Endpoint to list meals
     * @since 1.0.0
     */
    
    public function list_meals() {
        register_rest_route( 'event-organizer-toolkit/v1', '/list-meals',array(
                 'methods' => 'GET',
                 'callback' => function() {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/meals.php' );
                     $handler = NEW Event_Organizer_Toolkit_Meals_Handler();
                     array($this->handler, 'list');
                 },
                 'permission_callback' => '__return_true',
             )
         );
    }

    /**
     * Endpoint to edit meal
     * @since 1.0.0
     */

    public function edit_meal() {
        register_rest_route( 'event-organizer-toolkit/v1', '/edit-meal',array(
                 'methods' => 'PATCH',
                 'callback' => function() {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/meals.php' );
                     $handler = NEW Event_Organizer_Toolkit_Meals_Handler();
                     array($this->handler, 'edit');
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }
    
    /**
     * Endpoint to delete meals
     * @since 1.0.0
     */

    public function delete_meal() {
        register_rest_route( 'event-organizer-toolkit/v1', '/delete-meal',array(
                 'methods' => 'DELETE',
                 'callback' => function() {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/meals.php' );
                     $handler = NEW Event_Organizer_Toolkit_Meals_Handler();
                     array($this->handler, 'delete');
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
        );
    }

    /**
     * Routes to for accommodations handling
     */

    /**
     * Endpoint to add new accommodation
     * @since 1.0.0
     */

     public function add_accommodation() {
        register_rest_route( 'event-organizer-toolkit/v1', '/add-accommodation',array(
                 'methods' => 'POST',
                 'callback' => function() {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/accommodations.php' );
                     $handler = NEW Event_Organizer_Toolkit_Accommodations_Handler();
                     array($this->handler, 'add');
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }

    /**
     * Endpoint to list accommodations
     * @since 1.0.0
     */
    
    public function list_accommodations() {
        register_rest_route( 'event-organizer-toolkit/v1', '/list-accommodations',array(
                 'methods' => 'GET',
                 'callback' => function() {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/accommodations.php' );
                     $handler = NEW Event_Organizer_Toolkit_Accommodations_Handler();
                     array($this->handler, 'list');
                 },
                 'permission_callback' => '__return_true',
             )
         );
    }

    /**
     * Endpoint to edit accommodation
     * @since 1.0.0
     */

    public function edit_accommodation() {
        register_rest_route( 'event-organizer-toolkit/v1', '/edit-accommodation',array(
                 'methods' => 'PATCH',
                 'callback' => function() {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/accommodations.php' );
                     $handler = NEW Event_Organizer_Toolkit_Accommodations_Handler();
                     array($this->handler, 'edit');
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }
    
    /**
     * Endpoint to delete accommodations
     * @since 1.0.0
     */

    public function delete_accommodation() {
        register_rest_route( 'event-organizer-toolkit/v1', '/delete-accommodation',array(
                 'methods' => 'DELETE',
                 'callback' => function() {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/accommodations.php' );
                     $handler = NEW Event_Organizer_Toolkit_Accommodations_Handler();
                     array($this->handler, 'delete');
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }



    /**
     * Permission callback for logged in user.
     * @since 1.0.0
     */

    public function validate_cookie( $cap = false ) {

        $user_id = wp_validate_auth_cookie( '', 'logged_in' );
        $current_user = wp_set_current_user($user_id);
  
        if( current_user_can( 'administrator' ) )
          return true;
  
        if( is_array( $cap ) ) {
          if ( array_intersect( $cap, $current_user->roles ) ) {
            return true;
          } else {
            return false;
          }
        }
  
        if( $cap ) {
          return current_user_can( $cap );
        } else {
          return current_user_can( 'eot_manage_event' );
        }
  
      }


}

$rest_api = new Event_Organizer_Toolkit_Rest_Api();