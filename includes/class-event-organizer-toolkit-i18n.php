<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://janneseppanen.site/
 * @since      1.0.0
 *
 * @package    Event_Organizer_Toolkit
 * @subpackage Event_Organizer_Toolkit/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Event_Organizer_Toolkit
 * @subpackage Event_Organizer_Toolkit/includes
 * @author     Janne Seppänen <j.v.seppanen@gmail.com>
 */
class Event_Organizer_Toolkit_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'event-organizer-toolkit',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
