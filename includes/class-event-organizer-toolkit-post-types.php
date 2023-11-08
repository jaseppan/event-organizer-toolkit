<?php

/**
 * The file that defines custom post types of Event Organizer Toolkit.
 *
 *
 * @since      1.0.0
 * @package    Event_Organizer_Toolkit
 * @subpackage Event_Organizer_Toolkit/includes
 * @author     Janne Seppänen <j.v.seppanen@gmail.com>
 */
class Event_Organizer_Toolkit_Post_Types {

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

	public function __construct($plugin_name, $version) {
        
        add_action( 'init', array( $this, 'add_events_post_type' ) );
        add_action( 'init', array( $this, 'add_events_taxonomies' ) );
        add_action( 'init', array( $this, 'add_courses_post_type' ) );
        add_action( 'init', array( $this, 'add_courses_taxonomies' ) );
    
    }


    public function add_events_post_type() {
        $args = array(
			'labels' => array(
				'name' => __( 'Events', 'event-organizer-toolkit' ),
				'singular_name' => __( 'Event', 'event-organizer-toolkit' ),
				'add_new' => __( 'Add New', 'event-organizer-toolkit' ),
				'add_new_item' => __( 'Add New Event', 'event-organizer-toolkit' ),
				'edit_item' => __( 'Edit Event', 'event-organizer-toolkit' ),
				'new_item' => __( 'New Event', 'event-organizer-toolkit' ),
				'view_item' => __( 'View Event', 'event-organizer-toolkit' ),
				'search_items' => __( 'Search Events', 'event-organizer-toolkit' ),
				'not_found' => __( 'No Events found', 'event-organizer-toolkit' ),
				'not_found_in_trash' => __( 'No Events found in Trash', 'event-organizer-toolkit' ),
				'parent_item_colon' => __( 'Parent Event:', 'event-organizer-toolkit' ),
				'menu_name' => __( 'Events', 'event-organizer-toolkit' ),
			),
			'description' => __( 'Events', 'event-organizer-toolkit' ),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 5,
			'menu_icon' => 'dashicons-calendar-alt',
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'events', 'with_front' => false ),
			'supports' => array( 'title', 'editor', 'thumbnail', 'author', 'revisions', 'page-attributes' ),
			'has_archive' => true,
            // Enable gutenberg
			'show_in_rest' => true,
        );

        register_post_type( 'events', $args );
    }


    public function add_events_taxonomies() {
        $labels = array(
            'name' => _x( 'Event Categories', 'event-organizer-toolkit' ),
            'singular_name' => _x( 'Event Category', 'event-organizer-toolkit' ),
            'search_items' =>  __( 'Search Event Categories', 'event-organizer-toolkit' ),
            'all_items' => __( 'All Event Categories', 'event-organizer-toolkit' ),
            'parent_item' => __( 'Parent Event Category', 'event-organizer-toolkit' ),
            'parent_item_colon' => __( 'Parent Event Category:', 'event-organizer-toolkit' ),
            'edit_item' => __( 'Edit Event Category', 'event-organizer-toolkit' ),
            'update_item' => __( 'Update Event Category', 'event-organizer-toolkit' ),
            'add_new_item' => __( 'Add New Event Category', 'event-organizer-toolkit' ),
            'new_item_name' => __( 'New Event Category', 'event-organizer-toolkit' ),
            'menu_name' => __( 'Event Categories', 'event-organizer-toolkit' ),
        );
        
        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => __('event-category', 'event-organizer-toolkit' ) ),

        );

        register_taxonomy( 'event-category', array( 'event' ), $args );
    }

    /**
     * Add courses post type
     */

    public function add_courses_post_type() {
        $labels = array(
            'name' => __( 'Courses', 'event-organizer-toolkit' ),
            'singular_name' => __( 'Course', 'event-organizer-toolkit' ),
            'add_new' => __( 'Add New Course', 'event-organizer-toolkit' ),
            'add_new_item' => __( 'Add New Course', 'event-organizer-toolkit' ),
            'edit_item' => __( 'Edit Course', 'event-organizer-toolkit' ),
            'new_item' => __( 'New Course', 'event-organizer-toolkit' ),
            'view_item' => __( 'View Course', 'event-organizer-toolkit' ),
            'search_items' => __( 'Search Courses', 'event-organizer-toolkit' ),
            'not_found' => __( 'No Courses found', 'event-organizer-toolkit' ),
            'not_found_in_trash' => __( 'No Courses found in Trash', 'event-organizer-toolkit' ),
            'parent_item_colon' => __( 'Parent Course:', 'event-organizer-toolkit' ),
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'menu_icon' => 'dashicons-book',
            // Add support for gutenberg
            'show_in_rest' => true,
        );
        register_post_type( 'courses', $args );
    }

    /**
     * Register taxonomy for courses post type
     */

    public function add_courses_taxonomies() {
        $labels = array(
            'name' => _x( 'Categories', 'event-organizer-toolkit' ),
            'singular_name' => _x( 'Category', 'event-organizer-toolkit' ),
            'search_items' => __( 'Search Categories', 'event-organizer-toolkit' ),
            'all_items' => __( 'All Categories', 'event-organizer-toolkit' ),
            'parent_item' => __( 'Parent Category', 'event-organizer-toolkit' ),
            'parent_item_colon' => __( 'Parent Category:', 'event-organizer-toolkit' ),
            'edit_item' => __( 'Edit Category', 'event-organizer-toolkit' ),
            'update_item' => __( 'Update Category', 'event-organizer-toolkit' ),
            'add_new_item' => __( 'Add New Category', 'event-organizer-toolkit' ),
            'new_item_name' => __( 'New Category Name' , 'event-organizer-toolkit'),
            'menu_name' => __( 'Categories', 'event-organizer-toolkit' ),
        );
        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'categories' ),
            // add support for rest api
            'show_in_rest' => true,
        );
    }
}