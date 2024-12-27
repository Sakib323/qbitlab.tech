<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
   exit;
}

if ( ! class_exists('Sala_Maintenance') ){
	
    /**
     *  Class Sala_Enqueue
     */
    class Sala_Maintenance {

    	/**
		 * The constructor.
		 */
		function __construct() {
			add_action( 'wp_loaded', array( $this, 'maintenance_mode') );
			if ( get_theme_mod( 'maintenance_mode', 0 ) && get_theme_mod( 'maintenance_mode_admin_notice', 1 ) ) {
				add_action( 'admin_notices', array( $this, 'maintenance_admin_notice') );
			}
		}
		
		function maintenance_admin_notice() {
			$advanced_url = get_admin_url() . 'admin.php?page=optionsframework&tab=';
			?>
			<div class="notice notice-info">
				<p><?php echo sprintf( __( 'Sala Maintenance Mode is <strong>active</strong>. Please don\'t forget to <a href="%s">deactivate</a> it as soon as you are done.', 'sala' ), $advanced_url . 'of-option-maintenancemode' ); ?></p>
			</div>
			<?php
		}

		public function maintenance_mode() {

			// Exit if not active.
			if ( ! get_theme_mod( 'maintenance_mode', 0 ) ) {
				return;
			}

			global $pagenow;

			nocache_headers();

			if ( $pagenow !== 'wp-login.php' && ! current_user_can( 'manage_options' ) && ! is_admin() ) {

				// Remove Woocommerce store notice.
				remove_action( 'wp_footer', 'woocommerce_demo_store' );

				// Clear Cachify Cache.
				if ( has_action( 'cachify_flush_cache' ) ) {
					do_action( 'cachify_flush_cache' );
				}

				// Clear Super Cache.
				if ( function_exists( 'wp_cache_clear_cache' ) ) {
					ob_end_clean();
					wp_cache_clear_cache();
				}

				// Clear W3 Total Cache.
				if ( function_exists( 'w3tc_pgcache_flush' ) ) {
					ob_end_clean();
					w3tc_pgcache_flush();
				}

				$protocol = wp_get_server_protocol();
				header( "$protocol 503 Service Unavailable", true, 503 );
				header( 'Content-Type: text/html; charset=utf-8' );
				header( 'Retry-After: 600' );

				get_template_part( 'maintenance' );
				die();
			}
		}
	}

	new Sala_Maintenance();
}
