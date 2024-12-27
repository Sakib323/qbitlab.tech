<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Sala_Advanced' ) ) {
	class Sala_Advanced {

		protected static $instance = null;

		static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self:: $instance;
		}

		public function initialize() {
			add_action( 'wp_head', array( $this, 'header_scripts') );
			add_action( 'wp_footer', array( $this, 'footer_scripts') );
			add_action( 'sala_after_body_open', array( $this, 'after_body_open') );
			add_action( 'wp_footer', array( $this, 'before_body_close') );
			add_action( 'wp_print_styles', array( $this, 'deregister_block_styles'), 100 );
			add_action( 'wp_default_scripts', array( $this, 'remove_jquery_migrate') );
		}

		function header_scripts() {
			if ( get_theme_mod( 'html_scripts_header' ) && ! is_admin() ) {
				echo get_theme_mod( 'html_scripts_header' );
			}
		}

		function footer_scripts() {
			if ( get_theme_mod( 'html_scripts_footer' ) ) {
				echo do_shortcode(get_theme_mod('html_scripts_footer'));
			}
		}

		function after_body_open() {
			if ( get_theme_mod( 'html_scripts_after_body' ) && ! is_admin() ) {
				echo get_theme_mod( 'html_scripts_after_body' );
			}
		}

		function before_body_close() {
			if ( get_theme_mod( 'html_scripts_before_body' ) && ! is_admin() ) {
				echo get_theme_mod( 'html_scripts_before_body' );
			}
		}

		function get_md_media_query() {
			return '@media (max-width: 1199px)';
		}

		function get_sm_media_query() {
			return '@media (max-width: 991px)';
		}

		function get_xs_media_query() {
			return '@media (max-width: 767px)';
		}

		function custom_css() {
			ob_start();
			?>
				<style id="custom-css" type="text/css">
					<?php
					echo '/* Custom CSS */';
					echo get_theme_mod('html_custom_css');
					echo '/* Custom CSS Tablet */';
					echo get_md_media_query();
					echo get_theme_mod('html_custom_css_tablet');
					echo '}';
					echo '/* Custom CSS Mobile */';
					echo get_xs_media_query();
					echo get_theme_mod('html_custom_css_mobile');
					echo '}';
					?>
				</style>
			<?php
			$css = ob_get_clean();
			return $css;
		}

		function deregister_block_styles() {
			if ( ! is_admin() && get_theme_mod( 'disable_blockcss', 0 ) ) {
				wp_dequeue_style( 'wp-block-library' );
		  	}
		}

		function remove_jquery_migrate( $scripts ) {
			if ( ! get_theme_mod( 'jquery_migrate' ) ) return;
			if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
				$script = $scripts->registered['jquery'];

				if ( $script->deps ) {
					$script->deps = array_diff( $script->deps, array(
						'jquery-migrate',
					) );
				}
			}
		}

		public static function api_url() {
			$api_url = '';

			if ( defined( 'SALA_API_URL' ) && SALA_API_URL ) {
			  $api_url = SALA_API_URL;
			}

			return $api_url;
		}

		public static function facebook_accounts() {
			$theme_mod = get_theme_mod( 'facebook_accounts', array() );

			return array_filter( $theme_mod, function ( $account ) {
			  	return ! empty( $account );
			});
		}
	}

	Sala_Advanced::instance()->initialize();
}
