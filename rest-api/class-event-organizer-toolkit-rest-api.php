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

        // Endpoint to add both participant and parent
        add_action('rest_api_init', array($this, 'register_participant'));

        // Events
        add_action('rest_api_init', array($this, 'add_event_type'));
        add_action('rest_api_init', array($this, 'update_event_type'));
        add_action('rest_api_init', array($this, 'list_event_types'));
        add_action('rest_api_init', array($this, 'get_event_type'));
        add_action('rest_api_init', array($this, 'edit_event_type'));
        add_action('rest_api_init', array($this, 'delete_event_type'));
        
        // Participants
        add_action('rest_api_init', array($this, 'add_participant'));
        add_action('rest_api_init', array($this, 'update_participant'));
        add_action('rest_api_init', array($this, 'list_participants'));
        add_action('rest_api_init', array($this, 'get_participant'));
        add_action('rest_api_init', array($this, 'edit_participant'));
        add_action('rest_api_init', array($this, 'delete_participant'));
        add_action('rest_api_init', array($this, 'delete_participant'));
        
        // Participants parent
        add_action('rest_api_init', array($this, 'add_parent'));
        add_action('rest_api_init', array($this, 'update_parent'));
        add_action('rest_api_init', array($this, 'list_parents'));
        add_action('rest_api_init', array($this, 'get_parent'));
        add_action('rest_api_init', array($this, 'edit_parent'));
        add_action('rest_api_init', array($this, 'delete_parent'));
        add_action('rest_api_init', array($this, 'delete_parent'));
        
        // Meal types
        add_action('rest_api_init', array($this, 'add_meal_type'));
        add_action('rest_api_init', array($this, 'update_meal_type'));
        add_action('rest_api_init', array($this, 'list_meal_types'));
        add_action('rest_api_init', array($this, 'get_meal_type'));
        add_action('rest_api_init', array($this, 'edit_meal_type'));
        add_action('rest_api_init', array($this, 'delete_meal_type'));
        
        // Meals
        add_action('rest_api_init', array($this, 'add_meal'));
        add_action('rest_api_init', array($this, 'update_meal'));
        add_action('rest_api_init', array($this, 'list_meals'));
        add_action('rest_api_init', array($this, 'get_meal'));
        add_action('rest_api_init', array($this, 'edit_meal'));
        add_action('rest_api_init', array($this, 'delete_meal'));

        // Accommodation
        add_action('rest_api_init', array($this, 'add_accommodation'));
        add_action('rest_api_init', array($this, 'update_accommodation'));
        add_action('rest_api_init', array($this, 'list_accommodations'));
        add_action('rest_api_init', array($this, 'get_accommodation'));
        add_action('rest_api_init', array($this, 'edit_accommodation'));
        add_action('rest_api_init', array($this, 'delete_accommodation'));

    }

    /**
     * Routes to for events handling
     */

    public function register_participant() {
        register_rest_route( 'event-organizer-toolkit/v1', '/register-participant',array(
                'methods' => 'POST',
                'callback' => function($request) {
                    require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/event-types.php' );
                    $handler = NEW Event_Organizer_Toolkit_Event_Types_Handler();
                    $handler->update( $request ); // Update method is used for both create and update
                }
            )
        );
    }

    /**
     * Endpoint to add new event type
     * @since 1.0.0
     */

    public function add_event_type() {
        register_rest_route( 'event-organizer-toolkit/v1', '/add-event-type',array(
                 'methods' => 'POST',
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/event-types.php' );
                     $handler = NEW Event_Organizer_Toolkit_Event_Types_Handler();
                     $handler->update( $request ); // Update method is used for both create and update
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }
    
    /**
     * Endpoint to update event type
     * @since 1.0.0
     */

    public function update_event_type() {
        register_rest_route( 'event-organizer-toolkit/v1', '/update-event-type',array(
                 'methods' => 'PUT',
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/event-types.php' );
                     $handler = NEW Event_Organizer_Toolkit_Event_Types_Handler();
                     $handler->update( $request );
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }

    /**
     * Endpoint to list event types
     * @since 1.0.0
     */
    
    public function list_event_types() {
        register_rest_route( 'event-organizer-toolkit/v1', '/list-event-types',array(
            'methods' => 'GET',
            'callback' => function($request) {
                require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/event-types.php' );
                $handler = NEW Event_Organizer_Toolkit_Event_Types_Handler();
                $handler->list( $request );
            },
            'permission_callback' => '__return_true',
        ));
    }

    /**
     * Endpoint to get event type
     * @since 1.0.0
     */

     public function get_event_type() {
        register_rest_route( 'event-organizer-toolkit/v1', '/get-event-type',array(
                 'methods' => 'GET',
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/event-types.php' );
                     $handler = NEW Event_Organizer_Toolkit_Event_Types_Handler();
                     $handler->get( $request );
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }

    /**
     * Endpoint to edit event type
     * @since 1.0.0
     */

    public function edit_event_type() {
        register_rest_route( 'event-organizer-toolkit/v1', '/edit-event-type',array(
                 'methods' => 'PATCH',
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/event-types.php' );
                     $handler = NEW Event_Organizer_Toolkit_Event_Types_Handler();
                     $handler->edit( $request );
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }
    
    /**
     * Endpoint to delete event type
     * @since 1.0.0
     */

    public function delete_event_type() {
        register_rest_route( 'event-organizer-toolkit/v1', '/delete-event-type',array(
                 'methods' => 'DELETE',
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/event-types.php' );
                     $handler = NEW Event_Organizer_Toolkit_Event_Types_Handler();
                     $handler->delete( $request );
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
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/participants.php' );
                     $handler = NEW Event_Organizer_Toolkit_Participants_Handler();
                     $handler->update( $request );
                 },
                 'permission_callback' => '__return_true',
             )
         );
    }
    
    /**
     * Endpoint to update participant
     * @since 1.0.0
     */

     public function update_participant() {
        register_rest_route( 'event-organizer-toolkit/v1', '/update-participant',array(
                 'methods' => 'PUT',
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/participants.php' );
                     $handler = NEW Event_Organizer_Toolkit_Participants_Handler();
                     $handler->update( $request );
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
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/participants.php' );
                     $handler = NEW Event_Organizer_Toolkit_Participants_Handler();
                     $handler->list( $request );
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }

    /**
     * Endpoint to get participant
     * @since 1.0.0
     */

     public function get_participant() {
        register_rest_route( 'event-organizer-toolkit/v1', '/get-participant',array(
                 'methods' => 'GET',
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/participants.php' );
                     $handler = NEW Event_Organizer_Toolkit_Event_Types_Handler();
                     $handler->get( $request );
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
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/participants.php' );
                     $handler = NEW Event_Organizer_Toolkit_Participants_Handler();
                     $handler->edit( $request );
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
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/participants.php' );
                     $handler = NEW Event_Organizer_Toolkit_Participants_Handler();
                     $handler->delete( $request );
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }

    /**
     * Routes to for parents handling
     */

    /**
     * Endpoint to add new parent
     * @since 1.0.0
     */

     public function add_parent() {
        register_rest_route( 'event-organizer-toolkit/v1', '/add-parent',array(
                 'methods' => 'POST',
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/parents.php' );
                     $handler = NEW Event_Organizer_Toolkit_Participants_Handler();
                     $handler->update( $request );
                 },
                 'permission_callback' => '__return_true',
             )
         );
    }
    
    /**
     * Endpoint to update parent
     * @since 1.0.0
     */

     public function update_parent() {
        register_rest_route( 'event-organizer-toolkit/v1', '/update-parent',array(
                 'methods' => 'PUT',
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/parents.php' );
                     $handler = NEW Event_Organizer_Toolkit_Participants_Handler();
                     $handler->update( $request );
                 },
                 'permission_callback' => '__return_true',
             )
         );
    }

    /**
     * Endpoint to list parents
     * @since 1.0.0
     */
    
    public function list_parents() {
        register_rest_route( 'event-organizer-toolkit/v1', '/list-parents',array(
                 'methods' => 'GET',
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/parents.php' );
                     $handler = NEW Event_Organizer_Toolkit_Participants_Handler();
                     $handler->list( $request );
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }

    /**
     * Endpoint to get parent
     * @since 1.0.0
     */

     public function get_parent() {
        register_rest_route( 'event-organizer-toolkit/v1', '/get-parent',array(
                 'methods' => 'GET',
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/parents.php' );
                     $handler = NEW Event_Organizer_Toolkit_Event_Types_Handler();
                     $handler->get( $request );
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }

    /**
     * Endpoint to edit parent
     * @since 1.0.0
     */

    public function edit_parent() {
        register_rest_route( 'event-organizer-toolkit/v1', '/edit-parent',array(
                 'methods' => 'PATCH',
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/parents.php' );
                     $handler = NEW Event_Organizer_Toolkit_Participants_Handler();
                     $handler->edit( $request );
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }
    
    /**
     * Endpoint to delete parents
     * @since 1.0.0
     */

    public function delete_parent() {
        register_rest_route( 'event-organizer-toolkit/v1', '/delete-parent',array(
                 'methods' => 'DELETE',
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/parents.php' );
                     $handler = NEW Event_Organizer_Toolkit_Participants_Handler();
                     $handler->delete( $request );
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
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/meals.php' );
                     $handler = NEW Event_Organizer_Toolkit_Meals_Handler();
                     $handler->update( $request );
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }
    
    /**
     * Endpoint to update meal
     * @since 1.0.0
     */

     public function update_meal() {
        register_rest_route( 'event-organizer-toolkit/v1', '/update-meal',array(
                 'methods' => 'PUT',
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/meals.php' );
                     $handler = NEW Event_Organizer_Toolkit_Meals_Handler();
                     $handler->update( $request );
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
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/meals.php' );
                     $handler = NEW Event_Organizer_Toolkit_Meals_Handler();
                     $handler->list( $request );
                 },
                 'permission_callback' => '__return_true',
             )
         );
    }

    /**
     * Endpoint to get meal
     * @since 1.0.0
     */

     public function get_meal() {
        register_rest_route( 'event-organizer-toolkit/v1', '/get-meal',array(
                 'methods' => 'GET',
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/meals.php' );
                     $handler = NEW Event_Organizer_Toolkit_Meals_Handler();
                     $handler->get( $request );
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
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
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/meals.php' );
                     $handler = NEW Event_Organizer_Toolkit_Meals_Handler();
                     $handler->edit( $request );
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
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/meals.php' );
                     $handler = NEW Event_Organizer_Toolkit_Meals_Handler();
                     $handler->delete( $request );
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
        );
    }

    /**
     * Routes to for meal types handling
     */

    /**
     * Endpoint to add new meal type
     * @since 1.0.0
     */

     public function add_meal_type() {
        register_rest_route( 'event-organizer-toolkit/v1', '/add-meal-type',array(
                 'methods' => 'POST',
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/meal-types.php' );
                     $handler = NEW Event_Organizer_Toolkit_Meal_types_Handler();
                     $handler->update( $request );
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }
    
    /**
     * Endpoint to update meal type
     * @since 1.0.0
     */

     public function update_meal_type() {
        register_rest_route( 'event-organizer-toolkit/v1', '/update-meal-type',array(
                 'methods' => 'PUT',
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/meal-types.php' );
                     $handler = NEW Event_Organizer_Toolkit_Meal_Types_Handler();
                     $handler->update( $request );
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }

    /**
     * Endpoint to list meal types
     * @since 1.0.0
     */
    
    public function list_meal_types() {
        register_rest_route( 'event-organizer-toolkit/v1', '/list-meal-types',array(
                 'methods' => 'GET',
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/meal-types.php' );
                     $handler = NEW Event_Organizer_Toolkit_Meal_Types_Handler();
                     $handler->list( $request );
                 },
                 'permission_callback' => '__return_true',
             )
         );
    }

    /**
     * Endpoint to get meal type
     * @since 1.0.0
     */

     public function get_meal_type() {
        register_rest_route( 'event-organizer-toolkit/v1', '/get-meal-type',array(
                 'methods' => 'GET',
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/meal-types.php' );
                     $handler = NEW Event_Organizer_Toolkit_Meal_Types_Handler();
                     $handler->get( $request );
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }

    /**
     * Endpoint to edit meal type
     * @since 1.0.0
     */

    public function edit_meal_type() {
        register_rest_route( 'event-organizer-toolkit/v1', '/edit-meal-type',array(
                 'methods' => 'PATCH',
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/meal-types.php' );
                     $handler = NEW Event_Organizer_Toolkit_Meal_Types_Handler();
                     $handler->edit( $request );
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }
    
    /**
     * Endpoint to delete meal type
     * @since 1.0.0
     */

    public function delete_meal_type() {
        register_rest_route( 'event-organizer-toolkit/v1', '/delete-meal-type',array(
                 'methods' => 'DELETE',
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/meal-types.php' );
                     $handler = NEW Event_Organizer_Toolkit_Meal_Types_Handler();
                     $handler->delete( $request );
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
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/accommodations.php' );
                     $handler = NEW Event_Organizer_Toolkit_Accommodations_Handler();
                     $handler->update( $request );
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
             )
         );
    }
    
    /**
     * Endpoint to update accommodation
     * @since 1.0.0
     */

     public function update_accommodation() {
        register_rest_route( 'event-organizer-toolkit/v1', '/update-accommodation',array(
                 'methods' => 'PUT',
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/accommodations.php' );
                     $handler = NEW Event_Organizer_Toolkit_Accommodations_Handler();
                     $handler->update( $request );
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
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/accommodations.php' );
                     $handler = NEW Event_Organizer_Toolkit_Accommodations_Handler();
                     $handler->list( $request );
                 },
                 'permission_callback' => '__return_true',
             )
         );
    }

    /**
     * Endpoint to get event
     * @since 1.0.0
     */

     public function get_accommodation() {
        register_rest_route( 'event-organizer-toolkit/v1', '/get-accommodation',array(
                 'methods' => 'GET',
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/accommodations.php' );
                     $handler = NEW Event_Organizer_Toolkit_Accommodations_Handler();
                     $handler->get( $request );
                 },
                 'permission_callback' => function () {
                    return $this->validate_cookie();
                  }
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
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/accommodations.php' );
                     $handler = NEW Event_Organizer_Toolkit_Accommodations_Handler();
                     $handler->edit( $request );
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
                 'callback' => function($request) {
                     require_once( EVENT_ORGANIZER_TOOLKIT_DIR . 'rest-api/models/accommodations.php' );
                     $handler = NEW Event_Organizer_Toolkit_Accommodations_Handler();
                     $handler->delete( $request );
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

        return true; // For debugging and developing

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
          return current_user_can( 'eot_manage_events' );
        }
  
      }


}

$rest_api = new Event_Organizer_Toolkit_Rest_Api();