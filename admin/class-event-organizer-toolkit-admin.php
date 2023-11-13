<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://janneseppanen.site/
 * @since      1.0.0
 *
 * @package    Event_Organizer_Toolkit
 * @subpackage Event_Organizer_Toolkit/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Event_Organizer_Toolkit
 * @subpackage Event_Organizer_Toolkit/admin
 * @author     Janne Seppänen <j.v.seppanen@gmail.com>
 */
class Event_Organizer_Toolkit_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Event_Organizer_Toolkit_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Event_Organizer_Toolkit_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/event-organizer-toolkit-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript dependencies for the admin area.
	 *
	 * @since    1.0.0
	 */

	public function enqueue_scripts_dependencies() {

		wp_register_style('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');
		wp_enqueue_style('jquery-ui');
		// enqueue datepicker addon script
		wp_enqueue_script( 'jquery-ui-datepicker' );
		// enqueue timepicker addon CSS
		wp_enqueue_style('jquery-ui-timepicker-addon-css', 'https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css');
		// enqueue timepicker addon script
		wp_enqueue_script('jquery-ui-timepicker-addon', 'https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js', array('jquery-ui-datepicker'));
		
		

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/event-organizer-toolkit-admin.js', array( 'jquery' ), $this->version, true );

	}

	/**
	 * Localize the JavaScript for the admin area.
	 * 
	 * @since    1.0.0
	 */

	public function localize_script() {

		if( !isset($_GET['page']) )
			return;

		$page = esc_attr($_GET['page']);
		//$url = $this->get_endpoint_url( $page,  $_GET['tab'] );
		$tab = (isset($_GET['tab'])) ? esc_attr($_GET['tab']) : 'list';
		$script_data = $this->get_script_data( $page, $tab );
		
		if( !$script_data || empty($script_data) || !isset($script_data['url']) )
			return;

		// Pass the REST API URL to the JavaScript file
		wp_localize_script( $this->plugin_name, 'eotScriptData', $script_data );
	
	}

	/**
	 * Get script data for the admin area.
	 * 
	 * @param string $page The page name.
	 * @param string string|false $tab (Optional) The tab name. Default is false.
	 * @return string The endpoint URL.
	 * @since 1.0
	 * @version 1.0
	 * @access public
	 * @author Janne Seppänen
	 */

	public function get_script_data( $page, $tab = false ) {

		// List of end point urls and their pages and tabs
		$end_points = array(
			// Add accommodation
			array(
				'page' => 'event-organizer-toolkit-accommodations',
				'action' => 'add',
				'url' => rest_url('event-organizer-toolkit/v1/add-accommodation'),
				'method' => 'POST',
			),
			// Edit accommodation
			array(
				'page' => 'event-organizer-toolkit-accommodations',
				'action' => 'edit',
				'url' => rest_url('event-organizer-toolkit/v1/update-accommodation'),
				'method' => 'PUT',
				'get_url' => rest_url('event-organizer-toolkit/v1/get-accommodation'),
				'item_id' => (isset($_GET['id'])) ? (int) $_GET['id'] : '',
			),
			// List accommodation
			array(
				'page' => 'event-organizer-toolkit-accommodations',
				'action' => 'list',
				'url' => rest_url('event-organizer-toolkit/v1/list-accommodations'),
				'method' => 'GET',
				// Define fields in list view
				'fields' => array(
					array(					
						'name' => 'title',
						'label' => __( 'Title', 'event-organizer-toolkit' ),
					)
				),
				'deletion_url' => rest_url('event-organizer-toolkit') . '/v1/delete-accommodation',
			),
			// Add meal
			array(
				'page' => 'event-organizer-toolkit-meals',
				'action' => 'add',
				'url' => rest_url('event-organizer-toolkit/v1/add-meal'),
				'method' => 'POST',
			),
			// Edit meal
			array(
				'page' => 'event-organizer-toolkit-meals',
				'action' => 'edit',
				'url' => rest_url('event-organizer-toolkit/v1/update-meal'),
				'method' => 'PUT',
				'get_url' => rest_url('event-organizer-toolkit/v1/get-meal'),
				'item_id' => (isset($_GET['id'])) ? (int) $_GET['id'] : '',
			),
			// List meal
			array(
				'page' => 'event-organizer-toolkit-meals',
				'action' => 'list',
				'url' => rest_url('event-organizer-toolkit/v1/list-meals'),
				'method' => 'GET',
				// Define fields in list view
				'fields' => array(
					array(					
						'name' => 'title',
						'label' => __( 'Title', 'event-organizer-toolkit' ),
					),
					array(					
						'name' => 'date',
						'label' => __( 'Date', 'event-organizer-toolkit' ),
						'format' => 'date'
					),
					array(					
						'name' => 'order_num',
						'label' => __( 'Order Number', 'event-organizer-toolkit' ),
					)
				),
				'deletion_url' => rest_url('event-organizer-toolkit') . '/v1/delete-meal',
			),
			// Add meal type
			array(
				'page' => 'event-organizer-toolkit-meal-types',
				'action' => 'add',
				'url' => rest_url('event-organizer-toolkit/v1/add-meal-type'),
				'method' => 'POST',
			),
			// Edit meal type
			array(
				'page' => 'event-organizer-toolkit-meal-types',
				'action' => 'edit',
				'url' => rest_url('event-organizer-toolkit/v1/update-meal-type'),
				'method' => 'PUT',
				'get_url' => rest_url('event-organizer-toolkit/v1/get-meal-type'),
				'item_id' => (isset($_GET['id'])) ? (int) $_GET['id'] : '',
			),
			// List meal types
			array(
				'page' => 'event-organizer-toolkit-meal-types',
				'action' => 'list',
				'url' => rest_url('event-organizer-toolkit/v1/list-meal-types'),
				'method' => 'GET',
				// Define fields in list view
				'fields' => array(
					array(					
						'name' => 'type',
						'label' => __( 'Title', 'event-organizer-toolkit' ),
					),
					array(					
						'name' => 'start_time',
						'label' => __( 'Start Time', 'event-organizer-toolkit' ),
						'format' => 'time'
					),
					array(					
						'name' => 'end_time',
						'label' => __( 'End Time', 'event-organizer-toolkit' ),
						'format' => 'time'
					),
					array(					
						'name' => 'price',
						'label' => __( 'Price', 'event-organizer-toolkit' ),
					),
					array(					
						'name' => 'order_num',
						'label' => __( 'Order Number', 'event-organizer-toolkit' ),
					)
				),
				'deletion_url' => rest_url('event-organizer-toolkit') . '/v1/delete-meal-type',
			),
			// Add Event type
			array(
				'page' => 'event-organizer-toolkit-event-types',
				'action' => 'add',
				'url' => rest_url('event-organizer-toolkit/v1/add-event-type'),
				'method' => 'POST',
			),
			// Edit Event type
			array(
				'page' => 'event-organizer-toolkit-event-types',
				'action' => 'edit',
				'url' => rest_url('event-organizer-toolkit/v1/update-event-type'),
				'method' => 'PUT',
				'get_url' => rest_url('event-organizer-toolkit/v1/get-event-type'),
				'item_id' => (isset($_GET['id'])) ? (int) $_GET['id'] : '',
			),
			// List Event types
			array(
				'page' => 'event-organizer-toolkit-event-types',
				'action' => 'list',
				'url' => rest_url('event-organizer-toolkit/v1/list-event-types'),
				'method' => 'GET',
				// Define fields in list view
				'fields' => array(
					array(					
						'name' => 'name',
						'label' => __( 'Name', 'event-organizer-toolkit' ),
					),
					array(					
						'name' => 'post_type',
						'label' => __( 'Post type', 'event-organizer-toolkit' ),
					),
					array(					
						'name' => 'taxonomy',
						'label' => __( 'Taxonomy', 'event-organizer-toolkit' ),
					)
				),
				'deletion_url' => rest_url('event-organizer-toolkit') . '/v1/delete-event-type',
			),
			array(
				'page' => 'event-organizer-toolkit-participants',
				'action' => 'add',
				'url' => rest_url('event-organizer-toolkit/v1/add-participant'),
				'method' => 'POST',
			),
			array(
				'page' => 'event-organizer-toolkit-events',
				'action' => 'add',
				'url' => rest_url('event-organizer-toolkit/v1/add-event'),	
				'method' => 'POST',
			),
		);

		
		$script_data = array();

		// Get the endpoint URL depending on page and optional tab.
		foreach ( $end_points as $data ) {
			if( $tab && isset($data['action']) ) {
				if( $data['page'] == $page && $data['action'] == $tab ) {
					// Stop the loop. The latest $script_data is chosen
					$script_data = $data;
					break;
				} 
				
			} elseif( $data['page'] == $page && !isset($data['action']) ) {
				// Stop the loop. The latest $script_data is chosen
				$script_data = $data;
				break;
			}
		}

		if( empty($script_data) )
			return false;


		// Set default action
		if( !isset($script_data['action']) ) {
			$end_point['action'] = 'list';
		}

		// Merge default data
		$script_data = array_merge($script_data, array(
				'nonce' 		=> wp_create_nonce('wp_rest'),
				'current_url' 	=> esc_url_raw(admin_url(sprintf('admin.php?page=%s', $page))),
				'texts' 		=> $this->script_texts($script_data['action']),
			)
		);

		return $script_data;

	}

	/**
	 * Texts for scripts will be displayed on the list, add and edit views
	 * 
	 * @return array
	 * @since 1.0
	 * @version 1.0
	 * @access public
	 * @author Janne Seppänen
	 */

	public function script_texts( $action ) {

		switch ($action) :
			case 'add':
				$texts = array(
					'remove' => __('Remove', 'event-organizer-toolkit'),
				);
				break;
			case 'edit':
				$texts = array(
					'remove' => __('Remove', 'event-organizer-toolkit'),
				);
				break;
			case 'list':
				$texts = array(
					'error_fetching_items' => __('Error fetching list items:', 'event-organizer-toolkit'),
					'actions' => __('Actions', 'event-organizer-toolkit'),
					'edit' => __('Edit', 'event-organizer-toolkit'),
					'delete' => __('Delete', 'event-organizer-toolkit'),
					'confirm_delete_item' => __('Are you sure you want to delete this item?', 'event-organizer-toolkit'),
					'confirm_delete_items' => __('Are you sure you want to delete selected items?', 'event-organizer-toolkit'),
					'no_items_for_deletion' => __('No items selected for deletion.', 'event-organizer-toolkit'),
					'deletion_completed' => __('Deletion completed.', 'event-organizer-toolkit'),
					'error_deleting_items' => __('Error deleting items', 'event-organizer-toolkit'),
				);
				break;
			default:
				$texts = array(

				);
				break;
		endswitch;

		return $texts;
	}

}
