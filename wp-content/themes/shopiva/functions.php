<?php
/**
 * Define Theme Version
 */
define( 'SHOPIVA_THEME_VERSION', '7.0' );
	
function shopiva_css() {
	$parent_style = 'storely-parent-style';
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'shopiva-style', get_stylesheet_uri(), array( $parent_style ));
	
	wp_enqueue_style('shopiva-media-query',get_stylesheet_directory_uri().'/assets/css/responsive.css');
	wp_dequeue_style('storely-media-query');
	
	wp_enqueue_script('shopiva-custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), false, true);
}
add_action( 'wp_enqueue_scripts', 'shopiva_css',999);

require get_stylesheet_directory() . '/inc/customizer/customizer-options/shopiva-pro.php';

function shopiva_setup()	{	

	add_theme_support( 'custom-header', apply_filters( 'shopiva_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'ffffff',
		'width'                  => 2000,
		'height'                 => 200,
		'flex-height'            => true,
		'wp-head-callback'       => 'storely_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'shopiva_setup' );


/**
 * Register widget area.
 */

function shopiva_widgets_init() {	
	register_sidebar( array(
		'name' => __( 'Header Navigation Widget', 'shopiva' ),
		'id' => 'storely-header-nav',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
}
add_action( 'widgets_init', 'shopiva_widgets_init' );