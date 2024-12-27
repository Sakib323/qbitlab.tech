<?php
/**
 * Sala Define constants
 * This is where all Theme Functions runs.
 *
 * @package sala
 */

$sala_theme = wp_get_theme();

if ( ! defined( 'DS' ) ) {
	define( 'DS', DIRECTORY_SEPARATOR );
}

if ( !empty( $sala_theme['Template'] ) ) {
	$sala_theme = wp_get_theme( $sala_theme['Template'] );
}

if ( ! defined('SALA_THEME_NAME') ) {
	define('SALA_THEME_NAME', $sala_theme['Name'] );
}

if ( ! defined('SALA_THEME_SLUG') ) {
	define('SALA_THEME_SLUG', $sala_theme['Template'] );
}

if ( ! defined('SALA_THEME_VERSION') ) {
	define( 'SALA_THEME_VERSION', $sala_theme['Version'] );
}

if ( ! defined('SALA_THEME_DIR') ) {
	define('SALA_THEME_DIR', trailingslashit( get_template_directory() ) );
}

if ( ! defined('SALA_THEME_URI') ) {
	define('SALA_THEME_URI', get_template_directory_uri() );
}

if ( ! defined('SALA_THEME_PREFIX') ) {
    define('SALA_THEME_PREFIX', 'sala_');
}

if ( ! defined('SALA_METABOX_PREFIX') ) {
    define('SALA_METABOX_PREFIX', 'sala-');
}

if ( ! defined('SALA_IMAGES') ) {
	define('SALA_IMAGES', SALA_THEME_URI . DS . '/assets/images/' );
}

if ( ! defined('SALA_CUSTOMIZER_DIR') ) {
  define('SALA_CUSTOMIZER_DIR', SALA_THEME_DIR . 'inc/admin/customizer' );
}

if ( ! defined('SALA_CUSTOMIZER_URL') ) {
	define('SALA_CUSTOMIZER_URL', get_template_directory_uri() . DS . '/inc/admin/customizer' );
}

if ( ! defined('SALA_ELEMENTOR_DIR') ) {
	define( 'SALA_ELEMENTOR_DIR', get_template_directory() . DS . '/inc/elementor' );
}

if ( ! defined('SALA_ELEMENTOR_URI') ) {
	define( 'SALA_ELEMENTOR_URI', get_template_directory_uri() . DS . '/inc/elementor' );
}

if ( ! defined('SALA_ELEMENTOR_ASSETS') ) {
	define( 'SALA_ELEMENTOR_ASSETS', get_template_directory_uri() . DS . '/inc/elementor/assets' );
}

if ( ! defined('SALA_WIDGET_DIR') ) {
	define( 'SALA_WIDGET_DIR', get_template_directory() . DS . '/inc/widgets' );
}

if ( ! defined('SALA_WIDGET_URI') ) {
	define( 'SALA_WIDGET_URI', get_template_directory_uri() . DS . '/inc/widgets' );
}

/**
 * Require Classes
 */
require SALA_THEME_DIR . '/inc/classes/class-sala-setup.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-debug.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-enqueue.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-hook.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-kirki.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-merlin.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-mega-menu.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-helpers.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-minify.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-performance.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-global.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-image.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-templates.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-advanced.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-ajax.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-metabox.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-custom-css.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-page-title.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-breadcrumb.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-seo.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-maintenance.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-post.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-profile.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-footer.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-notices.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-woo.php';
require SALA_THEME_DIR . '/inc/classes/class-tgm-plugin-activation.php';
require SALA_THEME_DIR . '/inc/classes/class-walker-nav-menu.php';
require SALA_THEME_DIR . '/inc/classes/class-sala-plugins.php';
if( get_theme_mod('sala_portfolio', 0) ){
	require SALA_THEME_DIR . '/inc/classes/class-sala-portfolio.php';
}
if( get_theme_mod('sala_job', 0) ){
	require SALA_THEME_DIR . '/inc/classes/class-sala-job.php';
}

/**
 * Require Admin
 */
require_once SALA_THEME_DIR . '/inc/admin/admin-init.php';

/**
 * Require Elementor
 */
require_once SALA_ELEMENTOR_DIR . '/class-elementor.php';

/**
 * Base Widget
 */
require_once SALA_WIDGET_DIR . '/base.php';

add_action( 'after_switch_theme', 'sala_load_elementor_options' );
function sala_load_elementor_options() {
    update_option( 'elementor_disable_typography_schemes', 'yes' );
}
