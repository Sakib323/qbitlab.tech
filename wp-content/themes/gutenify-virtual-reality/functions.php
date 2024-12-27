<?php
/**
 * Gutenify Virtual Reality functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Gutenify Virtual Reality
 */

if ( ! function_exists( 'gutenify_virtual_reality_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function gutenify_virtual_reality_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Gutenify Virtual Reality, use a find and replace
		 * to change 'gutenify-virtual-reality' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'gutenify-virtual-reality', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'align-wide' );

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		// Experimental support for adding blocks inside nav menus
		add_theme_support( 'block-nav-menus' );

		// Add support for experimental link color control.
		add_theme_support( 'experimental-link-color' );

		// Load theme main style in editor.
		add_editor_style('css/font-awesome/css/all.css');

		// Load theme main style in editor.
		add_editor_style('style.css');
	}
endif;
add_action( 'after_setup_theme', 'gutenify_virtual_reality_setup' );

/**
 * Theme Fonts.
 *
 * @return array
 */
function gutenify_virtual_reality_theme_font_families() {
	return array_filter( array( '' ) );
}

if ( ! function_exists( 'gutenify_virtual_reality_fonts_url' ) ) :
	/**
	 * Register Google fonts for Gutenify Virtual Reality
	 *
	 * Create your own gutenify_virtual_reality_fonts_url() function to override in a child theme.
	 *
	 * @since 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function gutenify_virtual_reality_fonts_url() {
		$fonts_url = '';

		/* Translators: If there are characters in your language that are not
		* supported by Poppins, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$font_families = gutenify_virtual_reality_theme_font_families();

		if ( ! empty( $font_families ) ) {

			$query_args = array(
				'family' => implode( '&family=', $font_families ), //urlencode( implode( '|', $font_families ) ),
				// 'subset' => urlencode( 'latin,latin-ext' ),
				'display' => 'swap',
			);

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css2' );
		}

		if ( ! class_exists( 'WPTT_WebFont_Loader' ) ) {
			// Load Google fonts from Local.
			require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );
		}

		return esc_url( wptt_get_webfont_url( $fonts_url ) );
	}
endif;

/**
 * Enqueue scripts and styles.
 */
function gutenify_virtual_reality_scripts() {
	$min  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	// Register theme stylesheet.
	$theme_version = wp_get_theme()->get( 'Version' );

	$font_families = gutenify_virtual_reality_theme_font_families();
	if ( ! empty( $font_families ) ) {
		wp_enqueue_style( 'gutenify-virtual-reality-fonts', gutenify_virtual_reality_fonts_url(), array(), null );
	}

	if ( file_exists( get_template_directory() . '/js/animate' . $min . '.js' ) ) {
		$deps = array( 'jquery' );
		wp_enqueue_script( 'gutenify-virtual-reality-animate', get_template_directory_uri() . '/js/animate' . $min . '.js', $deps, date( 'Ymd-Gis', filemtime( get_theme_file_path( 'style.css' ) ) ) );
	}

}
add_action( 'wp_enqueue_scripts', 'gutenify_virtual_reality_scripts' );

/**
 * Enqueue admin scripts and styles.
 */
function gutenify_virtual_reality_admin_scripts() {
	$min  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	// Register theme stylesheet.
	$theme_version = wp_get_theme()->get( 'Version' );

	$deps = array();

	// FontAwesome.
	wp_register_style( 'gutenify-virtual-reality-admin-style', get_template_directory_uri() . '/css/admin-style.css', $deps, date( 'Ymd-Gis', filemtime( get_theme_file_path( 'style.css' ) ) ) );

	$deps = array( 'wp-api-fetch' );
	$handle = 'gutenify-virtual-reality-admin';
	wp_register_script( $handle, get_template_directory_uri() . '/js/admin' . $min . '.js', $deps, date( 'Ymd-Gis', filemtime( get_theme_file_path( 'js/admin.js' ) ) ) );

	wp_localize_script( $handle, 'gutenify_virtual_reality',
        array(
            'gutenify_kit_gallery' => esc_url( admin_url( 'admin.php?page=gutenify-template-kits' ) ),
            'gutenify_virtual_reality_nonce' => wp_create_nonce( "gutenify_virtual_reality-nonce" ),
        )
    );

	if ( ! empty( $_GET['page'] ) && 'gutenify-virtual-reality-info' === $_GET['page'] ) {
		wp_enqueue_style( 'gutenify-virtual-reality-admin-style' );
		wp_enqueue_script( 'gutenify-virtual-reality-admin' );
	}

}
add_action( 'admin_enqueue_scripts', 'gutenify_virtual_reality_admin_scripts' );

/**
 *
 * Enqueue scripts and styles.
 */
function gutenify_virtual_reality_editor_styles() {
	$font_families = gutenify_virtual_reality_theme_font_families();
	if ( empty( $font_families ) ) {
		return false;
	}
	// Enqueue editor styles.
	add_editor_style(
		array(
			gutenify_virtual_reality_fonts_url(),
		)
	);
}
add_action( 'admin_init', 'gutenify_virtual_reality_editor_styles' );

/**
 *
 * Register scripts and styles.
 */
function gutenify_virtual_reality_register_assets() {
	$min  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	// FontAwesome.
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome/css/all' . $min . '.css', array(), '5.15.3', 'all' );

	$deps = array( 'font-awesome' );

	if ( file_exists( get_template_directory() . '/css/animate.css' ) ) {
		wp_register_style( 'gutenify-virtual-reality-animate', get_template_directory_uri() . '/css/animate.css', array(), filemtime( get_theme_file_path( '/css/animate.css' ) ), 'all' );
		$deps[] = 'gutenify-virtual-reality-animate';
	}

	global $wp_styles;
	if ( in_array( 'wc-blocks-vendors-style', $wp_styles->queue ) ) {
		$deps[] = 'wc-blocks-vendors-style';
	}

	wp_register_style( 'gutenify-virtual-reality-style', get_stylesheet_uri(), $deps, date( 'Ymd-Gis', filemtime( get_theme_file_path( 'style.css' ) ) ) );
	wp_style_add_data( 'gutenify-virtual-reality-style', 'rtl', 'replace' );

	if ( file_exists( get_template_directory() . '/css/theme-style.css' ) ) {
		wp_register_style( 'gutenify-virtual-reality-theme-style', get_template_directory_uri() . '/css/theme-style.css',  array(), date( 'Ymd-Gis', filemtime( get_theme_file_path( 'css/theme-style.css' ) ) ) );
	}

}
add_action( 'init', 'gutenify_virtual_reality_register_assets' );

/**
 *
 * Enqueue blocks scripts and styles.
 */
function gutenify_virtual_reality_enqueue_block_assets() {
	wp_enqueue_style( 'gutenify-virtual-reality-style' );
	wp_enqueue_style( 'gutenify-virtual-reality-theme-style' );
}
add_action( 'wp_enqueue_scripts', 'gutenify_virtual_reality_enqueue_block_assets' );

/**
 * Load core file.
 */
require_once get_template_directory() . '/inc/core/bootstrap.php';
