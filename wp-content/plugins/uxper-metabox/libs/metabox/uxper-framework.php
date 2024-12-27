<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! defined( 'UXPER_DIR_URL' ) ) {
	define( 'UXPER_DIR_URL', plugin_dir_url( __FILE__ ) );
}

define( 'UXPER_VERSION', '1.0.0' );
define( 'UXPER_JS_URL', trailingslashit( UXPER_DIR_URL . 'js' ) );
define( 'UXPER_CSS_URL', trailingslashit( UXPER_DIR_URL . 'css' ) );
define( 'UXPER_ASSETS_URL', trailingslashit( UXPER_DIR_URL . 'assets' ) );
define( 'UXPER_FONTS_URL', trailingslashit( UXPER_DIR_URL . 'fonts' ) );
define( 'UXPER_INC_DIR', trailingslashit( plugin_dir_path( __FILE__ ) . 'inc' ) );
define( 'UXPER_FIELDS_DIR', trailingslashit( UXPER_INC_DIR . 'fields' ) );

// Helper class
require_once( UXPER_INC_DIR . 'class.helper.php' );
// Fields class
require_once( UXPER_FIELDS_DIR . 'tabpanel.php' );
require_once( UXPER_FIELDS_DIR . 'accordion.php' );
require_once( UXPER_FIELDS_DIR . 'text.php' );
require_once( UXPER_FIELDS_DIR . 'editor.php' );
require_once( UXPER_FIELDS_DIR . 'textarea.php' );
require_once( UXPER_FIELDS_DIR . 'ace-editor.php' );
require_once( UXPER_FIELDS_DIR . 'range.php' );
require_once( UXPER_FIELDS_DIR . 'media.php' );
require_once( UXPER_FIELDS_DIR . 'message.php' );
require_once( UXPER_FIELDS_DIR . 'gallery.php' );
require_once( UXPER_FIELDS_DIR . 'checkbox.php' );
require_once( UXPER_FIELDS_DIR . 'switch.php' );
require_once( UXPER_FIELDS_DIR . 'radio.php' );
require_once( UXPER_FIELDS_DIR . 'select.php' );
require_once( UXPER_FIELDS_DIR . 'image-select.php' );
require_once( UXPER_FIELDS_DIR . 'color.php' );
require_once( UXPER_FIELDS_DIR . 'typography.php' );
require_once( UXPER_FIELDS_DIR . 'audio.php' );
require_once( UXPER_FIELDS_DIR . 'attach.php' );

if ( ! class_exists( 'Uxper_Framework' ) ) {
	class Uxper_Framework {

		/**
		 * Plugin version, used for cache-busting of style and script file references.
		 *
		 * @since   1.0.0
		 *
		 * @var     string
		 */
		const VERSION = UXPER_VERSION;

		/**
		 * Instance of this class.
		 *
		 * @since    1.0.0
		 *
		 * @var      object
		 */
		protected static $instance = null;

		/**
		 * Initialize the plugin by setting localization and loading public scripts
		 * and styles.
		 *
		 * @since     1.0.0
		 */
		function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

			add_action( 'after_setup_theme', array( $this, 'require_files_if_theme_support' ), 13 );
		}

		/**
		 * Enqueue the admin page CSS and JS
		 *
		 * @return    void
		 */
		function enqueue_scripts( $hook ) {
			wp_enqueue_style( 'uxper_admin_css', UXPER_CSS_URL . 'admin-style.css', false, UXPER_VERSION );
		}

		function require_files_if_theme_support() {
			require_if_theme_supports( 'uxper-metabox', UXPER_INC_DIR . 'class.meta-box.php' );
		}
	}

	new Uxper_Framework();
}
