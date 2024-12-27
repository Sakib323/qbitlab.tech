<?php
/**
 * Theme functions and definitions.
 */
function sala_child_enqueue_styles() {

    if ( SCRIPT_DEBUG ) {
        wp_enqueue_style( 'sala-style' , get_template_directory_uri() . '/style.css' );
    } else {
        wp_enqueue_style( 'sala-minified-style' , get_template_directory_uri() . '/style.min.css' );
    }

    wp_enqueue_style( 'sala-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'sala-style' ),
        wp_get_theme()->get('Version')
    );
}

add_action(  'wp_enqueue_scripts', 'sala_child_enqueue_styles' );
