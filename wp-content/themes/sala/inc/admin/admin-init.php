<?php
/**
 * Sala Admin Engine Room.
 * This is where all Admin Functions run
 *
 * @package sala
 */

/**
 * Theme Panel
 */
require SALA_THEME_DIR . '/inc/admin/panel/panel.php';

/**
 * Theme Wizard
 */
if ( !is_customize_preview() && is_admin() ) {
	/**
	 * Theme Options
	 */
	require SALA_THEME_DIR . '/inc/admin/advanced/index.php';

  	// Include Merlin
  	require_once SALA_THEME_DIR . '/inc/admin/merlin/vendor/autoload.php';
  	require_once SALA_THEME_DIR . '/inc/admin/merlin/class-merlin.php';
  	require_once SALA_THEME_DIR . '/inc/admin/merlin/merlin-config.php';
  	require_once SALA_THEME_DIR . '/inc/admin/merlin/merlin-filters.php';
  	require_once SALA_THEME_DIR . '/inc/admin/merlin/sala-merlin.php';
}

/**
 * Include Kirki
 */
require_once dirname( __FILE__ ) . '/kirki/kirki.php';

/**
 * Theme Customizer
 */
require_once SALA_CUSTOMIZER_DIR . '/customizer.php';
