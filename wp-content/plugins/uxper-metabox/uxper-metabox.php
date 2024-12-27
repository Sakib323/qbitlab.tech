<?php
/*
Plugin Name: Uxper Metabox
Description: Metabox for WordPress theme
Author: Uxper
Version: 1.0.0
Author URI: https://uxper.co
Text Domain: uxper-metabox
Domain Path: /languages/
*/
defined( 'ABSPATH' ) || exit;

$theme = wp_get_theme();
if ( ! empty( $theme['Template'] ) ) {
	$theme = wp_get_theme( $theme['Template'] );
}
define( 'UXPER_SITE_URI', site_url() );
define( 'UXPER_PATH', plugin_dir_url( __FILE__ ) );
define( 'UXPER_DIR', dirname( __FILE__ ) );
define( 'UXPER_DS', DIRECTORY_SEPARATOR );
define( 'UXPER_THEME_NAME', $theme['Name'] );
define( 'UXPER_THEME_SLUG', $theme['Template'] );
define( 'UXPER_THEME_VERSION', $theme['Version'] );
define( 'UXPER_THEME_DIR', get_template_directory() );
define( 'UXPER_THEME_URI', get_template_directory_uri() );

if ( ! class_exists( 'Uxper_Metabox' ) ) {

	class Uxper_Metabox {

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function initialize() {
			add_action( 'init', array( $this, 'load_textdomain' ), 99 );
			add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ), 12 );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 99 );
		}

		function load_textdomain() {
			load_plugin_textdomain( 'uxper-metabox', false, basename( dirname( __FILE__ ) ) . '/languages/' );
		}

		public function admin_enqueue_scripts() {
			wp_enqueue_style( 'font-awesome', UXPER_PATH . 'assets/font-awesome/css/fontawesome-all.min.css' );
			wp_enqueue_style( 'uxper-metabox-css', UXPER_PATH . 'assets/css/admin.css', false, true );
		}

		public function after_setup_theme() {
			require_if_theme_supports( 'uxper-metabox', UXPER_DIR . '/libs/metabox/uxper-framework.php' );
		}

		public function cmb2_meta_box_url() {
			return UXPER_PATH . '/libs/cmb2/';
		}
	}

	Uxper_Metabox::instance()->initialize();
}
