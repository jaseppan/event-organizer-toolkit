<?php

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'blocks/includes/student-registration-form.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'blocks/includes/participant-registration-form.php';

/**
 *  Register the script for blocks
 */

 function eot_enqueue_assets() {

    wp_register_script(
        'eot-block',
        plugins_url( 'build/index.js', __FILE__ ),
        array( 'wp-blocks', 'wp-element', 'wp-editor' ),
        filemtime( plugin_dir_path( __FILE__ ) . 'build/index.js' )
    );

    // Register styles
    wp_register_style(
        'eot-block-editor-style',
        plugins_url( 'build/index.css', __FILE__ ),
        array( 'wp-edit-blocks' ),
        filemtime( plugin_dir_path( __FILE__ ) . 'build/index.css' )
    );
}
add_action( 'init', 'eot_enqueue_assets' );

/**
 * Register the blocks
 */

 function eot_register_blocks() {
    
    // Register student registration form

    register_block_type( 'eot/eot-student-registration-form', array(
        'editor_script' => 'eot-block',
        'editor_style'  => 'eot-block-editor-style', // if you have styles
        'attributes' => array(
            'formID' => array(
                'type' => 'number',
            ),
            // ... other attributes
        ),
        'render_callback' => 'eot_render_student_registration_form',
    ) );

    // Register participant registration form
    register_block_type( 'eot/eot-participant-registration-form', array(
        'editor_script' => 'eot-block',
        'editor_style'  => 'eot-block-editor-style', // if you have styles
        'attributes' => array(
            'formID' => array(
                'type' => 'number',
            ),
            // ... other attributes
        ),
        'render_callback' => 'eot_render_participant_registration_form',
    ) );
}
add_action( 'init', 'eot_register_blocks' );