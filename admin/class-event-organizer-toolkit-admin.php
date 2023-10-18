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
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/event-organizer-toolkit-admin.js', array( 'jquery' ), $this->version, false );

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
		$script_data = $this->get_script_data( $page, $_GET['tab'] );
		
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
			array(
				'page' => 'event-organizer-toolkit-accommodations',
				'action' => 'add',
				'url' => rest_url('event-organizer-toolkit/v1/add-accommodation'),
				'method' => 'POST',
			),
			array(
				'page' => 'event-organizer-toolkit-accommodations',
				'action' => 'edit',
				'url' => rest_url('event-organizer-toolkit/v1/update-accommodation'),
				'method' => 'PUT',
			),
			array(
				'page' => 'event-organizer-toolkit-accommodations',
				'action' => 'list',
				'url' => rest_url('event-organizer-toolkit/v1/list-accommodations'),
				'method' => 'GET',
				'fields' => array(
					array(					
						'name' => 'title'
					)
				),
				'deletion_url' => rest_url('event-organizer-toolkit') . '/v1/delete-accommodation',
			),
			array(
				'page' => 'event-organizer-toolkit-meals',
				'action' => 'add',
				'url' => rest_url('event-organizer-toolkit/v1/add-meal'),
				'method' => 'POST',
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
		foreach ( $end_points as $end_point ) {
			if( $tab && isset($end_point['action']) ) {
				if( $end_point['page'] == $page && $end_point['action'] == $tab ) {
					if( isset($end_point['url'] ) )
						$script_data['url'] = $end_point['url'];
					if( isset($end_point['method'] ) )
						$script_data['method'] = $end_point['method'];
					if( isset($end_point['deletion_url']) )
						$script_data['deletion_url'] = $end_point['deletion_url'];
					if( isset($end_point['fields']) )
						$script_data['fields'] = $end_point['fields'];
					break;
				} 
			} elseif( $end_point['page'] == $page && !isset($end_point['action']) ) {
				if( isset($end_point['url'] ) )
					$script_data['url'] = $end_point['url'];
				if( isset($end_point['method'] ) )
					$script_data['method'] = $end_point['method'];
				if( isset($end_point['deletion_url']) )
					$script_data['deletion_url'] = $end_point['deletion_url'];
				if( isset($end_point['fields']) )
					$script_data['fields'] = $end_point['fields'];
				break;
			}
		}

		if( empty($script_data) )
			return false;

		// Merge default data
		$script_data = array_merge($script_data, array(
				'nonce' => wp_create_nonce('wp_rest'),
				'current_url' => esc_url_raw(admin_url(sprintf('admin.php?page=%s', $page))),
			)
		);

		return $script_data;

	}

	/**
	 * Get the endpoint URL for the REST API depending on page and optional tab.
	 * 
	 * @param string $page The page name.
	 * @param string string|false $tab (Optional) The tab name. Default is false.
	 * @return string The endpoint URL.
	 * @since 1.0
	 * @version 1.0
	 * @access public
	 * @author Janne Seppänen
	 */

	public function get_endpoint_url( $page, $tab = false ) {

		// List of end point urls and their pages and tabs
		$end_points = array(
			array(
				'page' => 'event-organizer-toolkit-accommodations',
				'tab' => 'add',
				'url' => rest_url('event-organizer-toolkit/v1/add-accommodation'),
			),
			array(
				'page' => 'event-organizer-toolkit-accommodations',
				'tab' => 'edit',
				'url' => rest_url('event-organizer-toolkit/v1/update-accommodation'),
			),
			array(
				'page' => 'event-organizer-toolkit-accommodations',
				'tab' => 'list',
				'url' => rest_url('event-organizer-toolkit/v1/list-accommodations'),
			),
			array(
				'page' => 'event-organizer-toolkit-meals',
				'tab' => 'add',
				'url' => rest_url('event-organizer-toolkit/v1/add-meal'),
			),
			array(
				'page' => 'event-organizer-toolkit-participants',
				'tab' => 'add',
				'url' => rest_url('event-organizer-toolkit/v1/add-participant'),
			),
			array(
				'page' => 'event-organizer-toolkit-events',
				'tab' => 'add',
				'url' => rest_url('event-organizer-toolkit/v1/add-event'),
			),
		);

		// Get the endpoint URL depending on page and optional tab.
		foreach ( $end_points as $end_point ) {
			if( $tab && isset($end_point['tab']) ) {
				if( $end_point['page'] == $page && $end_point['tab'] == $tab ) {
					return $end_point['url'];
				} 
			} elseif( $end_point['page'] == $page && !isset($end_point['tab']) ) {
				return $end_point['url'];
			}
		}

		return false;

	}

}
