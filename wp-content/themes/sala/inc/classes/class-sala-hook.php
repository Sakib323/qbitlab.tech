<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Hook action
 */
if ( ! class_exists( 'Sala_Hook' ) ) {

	class Sala_Hook
	{
		/**
		 * The constructor.
		 */
		function __construct()
		{
			add_action( 'sala_after_body_open', array($this, 'pre_loader') );
			add_action( 'sala_after_footer', array($this, 'global_template') );
		}

		/**
		 * Register global template
		 */
		public static function pre_loader() {
			get_template_part( 'templates/global/site-loading' );
		}

		/**
		 * Register global template
		 */
		public static function global_template() {
			self::scroll_top();
			self::content_protected();
			self::dark_mode_switcher();
		}

		public static function scroll_top() {
			$scroll_top_enable = get_theme_mod( 'scroll_top_enable' );

			if ( ! $scroll_top_enable ) {
				return;
			}
			?>
				<a class="page-scroll-up" id="page-scroll-up">
					<i class="arrow-top fal fa-angle-up"></i>
					<i class="arrow-bottom fal fa-angle-up"></i>
				</a>
			<?php
		}

		public static function content_protected() {
			$content_protected = get_theme_mod( 'content_protected_enable' );

			if ( ! $content_protected ) {
				return;
			}
			?>
				<div id="sala-content-protected-box" class="sala-content-protected-box">
					<?php printf( esc_html__(
						'%sAlert:%s You are not allowed to copy content or view source !!', 'sala'
					), '<span class="alert-label">', '</span>' ); ?>
				</div>
			<?php
		}

		public static function dark_mode_switcher() {
			$enable_dark_theme 		= get_theme_mod( 'enable_dark_theme' );
			$switcher 				= get_theme_mod( 'enable_dark_mode_switcher' );
			$switcher_text_dark 	= get_theme_mod( 'dark_mode_dark' );
			$switcher_text_light 	= get_theme_mod( 'dark_mode_light' );

			if ( ! $switcher ) {
				return;
			}
			?>
			<div class="sala-mode-switcher-wrap">
				<div class="sala-mode-switcher <?php if( $enable_dark_theme ){ echo 'sala-dark-scheme'; } ?>">
					<div class="sala-mode-switcher-item sala-dark-scheme"><p class="sala-mode-switcher-item-state"><?php esc_html_e( $switcher_text_dark ); ?></p></div>
					<div class="sala-mode-switcher-item light"><p class="sala-mode-switcher-item-state"><?php esc_html_e( $switcher_text_light ); ?></p></div>
					<div class="sala-mode-switcher-toddler">
						<div class="sala-mode-switcher-toddler-wrap">
							<div class="sala-mode-switcher-toddler-item sala-dark-scheme"><p class="sala-mode-switcher-item-state"><?php esc_html_e( $switcher_text_dark ); ?></p></div>
							<div class="sala-mode-switcher-toddler-item light"><p class="sala-mode-switcher-item-state"><?php esc_html_e( $switcher_text_light ); ?></p></div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}

	new Sala_Hook();
}
