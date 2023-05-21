<?php

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Event_Organizer_Toolkit
 * @subpackage Event_Organizer_Toolkit/includes
 * @author     Janne Seppänen <j.v.seppanen@gmail.com>
 */
class Event_Organizer_Toolkit_Activator {

	/**
	 * This method executes database and directory creations 
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		global $wpdb;
        global $jal_db_version;
        $charset_collate = $wpdb->get_charset_collate();

        $sql = self::create_tables_sql();

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

        add_option( 'jal_db_version', $jal_db_version );

		// Create directory for files

		if (!file_exists(ABSPATH . 'event-organizer-toolkit-files')) {
			mkdir(ABSPATH . 'wp-content/event-organizer-toolkit-files', 0755, true);
		}

	}

	public function create_tables_sql() {
		
		$sql = self::create_events_table();
        $sql .= self::create_participants_table();
		$sql .= self::create_participants_roles_table();
		$sql .= self::create_participants_parents_table();
        $sql .= self::create_event_types_table();
        $sql .= self::create_particitant_roles_table();
        $sql .= self::create_eot_fields_table();
        $sql .= self::create_eot_field_values_table();
        $sql .= self::create_eot_meals_table();
        $sql .= self::create_eot_accommodation_table();
        $sql .= self::create_eot_participants_meals_table();
        $sql .= self::create_eot_participants_accommodation_table();

		return $sql;

	}

	public function create_events_table() {

		global $wpdb;

		$sql =  "CREATE TABLE " . $wpdb->prefix . EVENT_ORGANIZER_TOOLKIT_EVENTS_TABLE . " (
			id INT NOT NULL AUTO_INCREMENT,
			title varchar(50) NOT NULL,
			event_type_id INT NOT NULL,
			post_id INT NULL,
			archive INT NULL,
			PRIMARY KEY (id) );";

		return $sql;

	}
	
	public function create_event_types_table() {

		global $wpdb;

		$sql =  "CREATE TABLE " . $wpdb->prefix . EVENT_ORGANIZER_TOOLKIT_EVENT_TYPES_TABLE . " (
			id INT NOT NULL AUTO_INCREMENT,
			title varchar(50) NOT NULL,
			plural_title varchar(50) NOT NULL,
			name varchar(50) NOT NULL,
			plural_name varchar(50) NOT NULL,
			primary_title varchar(50) NOT NULL,
			primary_name varchar(50) NOT NULL,
			description varchar(255),
			taxonomies varchar(1000),
			PRIMARY KEY (id) );";

		return $sql;

	}
	

	public function create_participants_table() {

		global $wpdb;

		$sql =  "CREATE TABLE " . $wpdb->prefix . EVENT_ORGANIZER_TOOLKIT_PARTICIPANTS_TABLE . " (
			id INT NOT NULL AUTO_INCREMENT,
			first_name varchar(50) NOT NULL,
			last_name varchar(50) NOT NULL,
			email varchar(50) NOT NULL,
			phone varchar(50) NOT NULL,
			address varchar(50) NOT NULL,
			zip varchar(50) NOT NULL,
			city varchar(50) NOT NULL,
			role_id INT,
			user_id INT NOT NULL,
			parent_id INT NOT NULL,
			diet varchar(255),
			PRIMARY KEY (id) );";

		return $sql;

	}
	
	public function create_participants_parents_table() {

		global $wpdb;

		$sql =  "CREATE TABLE " . $wpdb->prefix . VENT_ORGANIZER_TOOLKIT_PARTICIPANTS_PARENTS_TABLE . " (
			id INT NOT NULL AUTO_INCREMENT,
			first_name varchar(50) NOT NULL,
			last_name varchar(50) NOT NULL,
			email varchar(50) NOT NULL,
			phone varchar(50) NOT NULL,
			address varchar(50) NOT NULL,
			zip varchar(50) NOT NULL,
			city varchar(50) NOT NULL,
			user_id INT NOT NULL,
			PRIMARY KEY (id) );";

		return $sql;

	}
	
	public function create_particitant_roles_table() {

		global $wpdb;

		$sql =  "CREATE TABLE " . $wpdb->prefix . EVENT_ORGANIZER_TOOLKIT_PARTICIPANT_ROLES_TABLE . " (
			id INT NOT NULL AUTO_INCREMENT,
			title varchar(50) NOT NULL,
			type varchar(50) NOT NULL,
			PRIMARY KEY (id) );";

		return $sql;

	}
	
	public function create_eot_fields_table() {

		global $wpdb;

		$sql =  "CREATE TABLE " . $wpdb->prefix . EVENT_ORGANIZER_TOOLKIT_FIELDS_TABLE . " (
			id INT NOT NULL AUTO_INCREMENT,
			participant_id int NOT NULL,
			type varchar(20) NOT NULL DEFAULT '',
			label varchar(255) NOT NULL DEFAULT '',
			desc varchar(255) NOT NULL DEFAULT '',
			value text NOT NULL,
			maxlength smallint NOT NULL DEFAULT '0',
			saved tinyint(1) NOT NULL DEFAULT '0',
			required tinyint(1) NOT NULL DEFAULT '0',
			visibility varchar(25) NOT NULL DEFAULT 'both',
			validation varchar(25) NOT NULL DEFAULT '',
			format varchar(255) NOT NULL DEFAULT '',
			dependency int NOT NULL DEFAULT '0',
			dependency_state int NOT NULL DEFAULT '0',
			class varchar(255) NOT NULL DEFAULT '',
			ordering int NOT NULL DEFAULT '0',
			published tinyint(1) NOT NULL DEFAULT '0',
			access int UNSIGNED NOT NULL DEFAULT '0',
			PRIMARY KEY (id) );";

		return $sql;

	}
	
	public function create_eot_field_values_table() {

		global $wpdb;

		$sql =  "CREATE TABLE " . $wpdb->prefix . EVENT_ORGANIZER_TOOLKIT_FIELD_VALUES_TABLE . " (
			id INT NOT NULL AUTO_INCREMENT,
			participant_id int NOT NULL,
			field_id int NOT NULL,
			value varchar(1000)
			PRIMARY KEY (id) );";

		return $sql;

	}
	
	public function create_eot_meals_table() {

		global $wpdb;

		$sql = "CREATE TABLE " . $wpdb->prefix . EVENT_ORGANIZER_TOOLKIT_MEALS_TABLE . " (
			id INT NOT NULL AUTO_INCREMENT,
			title varchar(255) NOT NULL,
			date date NOT NULL,
			start_time time NOT NULL,
			end_time time NOT NULL,
			venue varchar(50) NOT NULL,
			menu varchar(50) NOT NULL,
			PRIMARY KEY (id)
		);";

		return $sql;

	}

	public function create_eot_accommodations_table() {

		global $wpdb;

		$sql =  "CREATE TABLE " . $wpdb->prefix . EVENT_ORGANIZER_TOOLKIT_ACCOMMODATIONS_TABLE . " (
			id INT NOT NULL AUTO_INCREMENT,
			title varchar(50) NOT NULL,
			description varchar(255),
			rooms varchar(255),
			PRIMARY KEY (id) );";

		return $sql;

	}

	public function create_eot_participants_meals_table() {

		global $wpdb;

		$sql =  "CREATE TABLE " . $wpdb->prefix . EVENT_ORGANIZER_TOOLKIT_PARTICIPANT_MEALS_TABLE . " (
			id INT NOT NULL AUTO_INCREMENT,
			customer_id int NOT NULL,
			meal_id int NOT NULL,
			PRIMARY KEY (id) );";


	}
	
	public function create_eot_participants_accommodation_table() {

		global $wpdb;

		$sql =  "CREATE TABLE " . $wpdb->prefix . EVENT_ORGANIZER_TOOLKIT_PARTICIPANT_ACCOMMODATIONS_TABLE . " (
			id INT NOT NULL AUTO_INCREMENT,
			customer_id int NOT NULL,
			meal_id int NOT NULL,
			PRIMARY KEY (id) );";

	}


}
