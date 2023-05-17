<?php

/**
 * @link              https://janneseppanen.site/
 * @since             1.0.0
 * @package           Event_Organizer_Toolkit
 *
 * @wordpress-plugin
 * Plugin Name:       Event Organizer Toolkit
 * Plugin URI:        https://janneseppanen.site/event-organizer-toolkit
 * Description:       Event Organizer Toolkit is a powerful WordPress plugin designed to streamline and simplify the event organizing process. With a range of intuitive features, this plugin assists event organizers in executing routine tasks effortlessly. Generate professional nameplates, meal tickets, and accommodation lists with ease, using the participant registration data as the foundation. Say goodbye to manual labor and hello to automated efficiency with EventPro Organizer Toolkit, your all-in-one solution for seamless event management.
 * Version:           1.0.0
 * Author:            Janne Seppänen
 * Author URI:        https://janneseppanen.site/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       event-organizer-toolkit
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */

define( 'EVENT_ORGANIZER_TOOLKIT_VERSION', '1.0.0' );

/**
 * Current plugin root directory.
 */
define( 'EVENT_ORGANIZER_TOOLKIT_DIR', plugin_dir_path(__FILE__) );

/**
 * Current plugin root URL.
 */
define( 'EVENT_ORGANIZER_TOOLKIT_URL', plugin_dir_url( __FILE__ ) );

/**
 * Configure tables and columns
 * Custom tables can be defined in wp-config.init
 */

if( !defined('EVENT_ORGANIZER_TOOLKIT_EVENTS_TABLE') )
	define( 'EVENT_ORGANIZER_TOOLKIT_EVENTS_TABLE', 'eot_events' );
if( !defined('EVENT_ORGANIZER_TOOLKIT_EVENT_TYPES_TABLE') )
	define( 'EVENT_ORGANIZER_TOOLKIT_EVENT_TYPES_TABLE', 'eot_event_types' );
if( !defined('EVENT_ORGANIZER_TOOLKIT_PARTICIPANTS_TABLE') )
	define( 'EVENT_ORGANIZER_TOOLKIT_PARTICIPANTS_TABLE', 'eot_particitants' );
if( !defined('EVENT_ORGANIZER_TOOLKIT_PARTICIPANT_ROLES_TABLE') ) 
	define( 'EVENT_ORGANIZER_TOOLKIT_PARTICIPANT_ROLES_TABLE', 'eot_particitants_roles' );
if( !defined('EVENT_ORGANIZER_TOOLKIT_FIELDS_TABLE') ) 
	define( 'EVENT_ORGANIZER_TOOLKIT_FIELDS_TABLE', 'eot_fields' );
if( !defined('EVENT_ORGANIZER_TOOLKIT_FIELD_VALUES_TABLE') ) 
	define( 'EVENT_ORGANIZER_TOOLKIT_FIELD_VALUES_TABLE', 'eot_field_values' );
if( !defined('EVENT_ORGANIZER_TOOLKIT_MEALS_TABLE') ) 
	define( 'EVENT_ORGANIZER_TOOLKIT_MEALS_TABLE', 'eot_meals' );
if( !defined('EVENT_ORGANIZER_TOOLKIT_PARTICIPANT_MEALS_TABLE') ) 
	define( 'EVENT_ORGANIZER_TOOLKIT_PARTICIPANT_MEALS_TABLE', 'eot_participants_meals' );
if( !defined('EVENT_ORGANIZER_TOOLKIT_ACCOMMODATION_TABLE') ) 
	define( 'EVENT_ORGANIZER_TOOLKIT_ACCOMMODATION_TABLE', 'eot_accommodations' );
if( !defined('EVENT_ORGANIZER_TOOLKIT_PARTICIPANT_ACCOMMODATIONS_TABLE') ) 
	define( 'EVENT_ORGANIZER_TOOLKIT_PARTICIPANT_ACCOMMODATIONS_TABLE', 'eot_participant_accommodations' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-event-organizer-toolkit-activator.php
 */
function activate_event_organizer_toolkit() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-event-organizer-toolkit-activator.php';
	Event_Organizer_Toolkit_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-event-organizer-toolkit-deactivator.php
 */
function deactivate_event_organizer_toolkit() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-event-organizer-toolkit-deactivator.php';
	Event_Organizer_Toolkit_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_event_organizer_toolkit' );
register_deactivation_hook( __FILE__, 'deactivate_event_organizer_toolkit' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-event-organizer-toolkit.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_event_organizer_toolkit() {

	$plugin = new Event_Organizer_Toolkit();
	$plugin->run();

}

run_event_organizer_toolkit();
