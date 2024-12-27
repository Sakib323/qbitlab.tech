<?php
defined( 'ABSPATH' ) || exit;

/**
 * Enqueue custom styles.
 */
if ( ! class_exists( 'Sala_Custom_Css' ) ) {
	class Sala_Custom_Css {

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function initialize() {
			add_action( 'wp_enqueue_scripts', array( $this, 'extra_css' ) );
		}

		/**
		 * Responsive styles.
		 *
		 * @access public
		 */
		public function extra_css() {
			$extra_style = '';

			$custom_logo_width        = Sala_Helper::get_post_meta( 'custom_logo_width', '' );
			$custom_sticky_logo_width = Sala_Helper::get_post_meta( 'custom_sticky_logo_width', '' );
			if ( $custom_logo_width !== '' ) {
				$extra_style .= ".site-header .site-logo img {
                    max-width: {$custom_logo_width} !important;
                }";
			}
			if ( $custom_sticky_logo_width !== '' ) {
				$extra_style .= ".header-sticky .site-logo img {
                    max-width: {$custom_sticky_logo_width} !important;
                }";
			}

			$site_width = Sala_Helper::get_post_meta( 'site_width', '' );
			if ( $site_width === '' ) {
				$site_width = Sala_Helper::setting( 'site_width' );
			}
			if ( $site_width !== '' ) {
				$extra_style .= "
				body .container
				{
	                max-width: $site_width;
	            }";
			}

			$site_accent_color = Sala_Helper::get_post_meta( 'site_accent_color', '' );
			if ( $site_accent_color !== '' ) {
				$extra_style .= "
				.accent-color,.sala-blog-categories li.active a,.sala-pagination li .page-numbers.current,.sala-pagination li a:hover,.regular-price
				{
	                color: $site_accent_color!important;
	            }
				.sala-button
				{
	                background-color: $site_accent_color!important;
	            }
				";
			}

			$site_top_spacing = Sala_Helper::get_post_meta( 'site_top_spacing', '' );
			if ( $site_top_spacing !== '' ) {
				$extra_style .= "
				body.boxed
				{
	                margin-top: {$site_top_spacing};
	            }";
			}

			$site_bottom_spacing = Sala_Helper::get_post_meta( 'site_bottom_spacing', '' );
			if ( $site_bottom_spacing !== '' ) {
				$extra_style .= "
				body.boxed
				{
	                margin-bottom: {$site_bottom_spacing};
	            }";
			}

			$content_top_spacing = Sala_Helper::get_post_meta( 'content_top_spacing', '' );

			if ( $content_top_spacing !== '' ) {
				$extra_style .= "
				.site-content
				{
	                padding-top: {$content_top_spacing};
	            }";
			}

			$content_bottom_spacing = Sala_Helper::get_post_meta( 'content_bottom_spacing', '' );
			if ( $content_bottom_spacing !== '' ) {
				$extra_style .= "
				.site-content
				{
	                padding-bottom: {$content_bottom_spacing};
	            }";
			}

			$content_top_spacing_tablet = Sala_Helper::get_post_meta( 'content_top_spacing_tablet', '' );
			if ( $content_top_spacing_tablet !== '' ) {
				$extra_style .= "
				@media (max-width: 1024px) {
				.site-content
					{
						padding-top: {$content_top_spacing_tablet};
					}
				}";
			}

			$content_bottom_spacing_tablet = Sala_Helper::get_post_meta( 'content_bottom_spacing_tablet', '' );
			if ( $content_bottom_spacing_tablet !== '' ) {
				$extra_style .= "
				@media (max-width: 1024px) {
					.site-content
					{
						padding-bottom: {$content_bottom_spacing_tablet};
					}
				}";
			}

			$content_top_spacing_mobile = Sala_Helper::get_post_meta( 'content_top_spacing_mobile', '' );
			if ( $content_top_spacing_mobile !== '' ) {
				$extra_style .= "
				@media (max-width: 767px) {
				.site-content
					{
						padding-top: {$content_top_spacing_mobile};
					}
				}";
			}

			$content_bottom_spacing_mobile = Sala_Helper::get_post_meta( 'content_bottom_spacing_mobile', '' );
			if ( $content_bottom_spacing_mobile !== '' ) {
				$extra_style .= "
				@media (max-width: 767px) {
					.site-content
					{
						padding-bottom: {$content_bottom_spacing_mobile};
					}
				}";
			}

			$content_overflow_hidden = Sala_Helper::get_post_meta( 'content_overflow_hidden', '' );
			if ( $content_overflow_hidden == 'inherit' ) {
				$extra_style .= "
				.site-content
				{
	                overflow: {$content_overflow_hidden};
	            }";
			}

			$tmp = '';

			$site_background_color = Sala_Helper::get_post_meta( 'site_background_color', '' );
			if ( $site_background_color !== '' ) {
				$tmp .= "background-color: $site_background_color !important;";
			}

			$site_background_image = Sala_Helper::get_post_meta( 'site_background_image', '' );
			if ( $site_background_image !== '' ) {
				$site_background_repeat = Sala_Helper::get_post_meta( 'site_background_repeat', '' );
				$tmp .= "background-image: url( $site_background_image ) !important; background-repeat: $site_background_repeat !important;";
			}

			$site_background_position = Sala_Helper::get_post_meta( 'site_background_position', '' );
			if ( $site_background_position !== '' ) {
				$tmp .= "background-position: $site_background_position !important;";
			}

			$site_background_size = Sala_Helper::get_post_meta( 'site_background_size', '' );
			if ( $site_background_size !== '' ) {
				$tmp .= "background-size: $site_background_size !important;";
			}

			$site_background_attachment = Sala_Helper::get_post_meta( 'site_background_attachment', '' );
			if ( $site_background_attachment !== '' ) {
				$tmp .= "background-attachment: $site_background_attachment !important;";
			}

			if ( $tmp !== '' ) {
				$extra_style .= "html { $tmp; }";
			}

			$tmp = '';

			$content_background_color = Sala_Helper::get_post_meta( 'content_background_color', '' );
			if ( $content_background_color !== '' ) {
				$tmp .= "background-color: $content_background_color !important;";
			}

			$content_background_image = Sala_Helper::get_post_meta( 'content_background_image', '' );
			if ( $content_background_image !== '' ) {
				$content_background_repeat = Sala_Helper::get_post_meta( 'content_background_repeat', '' );
				$tmp .= "background-image: url( $content_background_image ) !important; background-repeat: $content_background_repeat !important;";
			}

			$content_background_position = Sala_Helper::get_post_meta( 'content_background_position', '' );
			if ( $content_background_position !== '' ) {
				$tmp .= "background-position: $content_background_position !important;";
			}

			$content_background_size = Sala_Helper::get_post_meta( 'content_background_size', '' );
			if ( $content_background_size !== '' ) {
				$tmp .= "background-size: $content_background_size !important;";
			}

			$content_background_attachment = Sala_Helper::get_post_meta( 'content_background_attachment', '' );
			if ( $content_background_attachment !== '' ) {
				$tmp .= "background-attachment: $content_background_attachment !important;";
			}

			if ( $tmp !== '' ) {
				$extra_style .= "body { $tmp; }";
			}

			$extra_style .= $this->header_css();
			$extra_style .= $this->page_title_css();
			$extra_style .= $this->light_gallery_css();
			$extra_style .= $this->off_canvas_menu_css();
			$extra_style .= $this->mobile_menu_css();

			$extra_style = Sala_Minify::css( $extra_style );

			wp_add_inline_style( 'sala-style', html_entity_decode( $extra_style, ENT_QUOTES ) );
		}

		function header_css() {
			$header_type = Sala_Global::instance()->get_header_type();
			$css         = '';

			$nav_bg_type = Sala_Helper::setting( "header_style_{$header_type}_navigation_background_type" );

			if ( $nav_bg_type === 'gradient' ) {

				$gradient = Sala_Helper::setting( "header_style_{$header_type}_navigation_background_gradient" );
				$_color_1 = $gradient['from'];
				$_color_2 = $gradient['to'];

				$css .= "
				.header-$header_type {
					background: {$_color_1};
                    background: -webkit-linear-gradient(-136deg, {$_color_2} 0%, {$_color_1} 100%);
                    background: linear-gradient(-136deg, {$_color_2} 0%, {$_color_1} 100%);
				}";
			}

			return $css;
		}

		function page_title_css() {
			$css = $page_title_tmp = $overlay_tmp = '';

			$type    = Sala_Global::instance()->get_page_title_type();
			$bg_type = Sala_Helper::setting( "page_title_{$type}_background_type" );

			if ( 'gradient' === $bg_type ) {
				$gradient_color = Sala_Helper::setting( "page_title_{$type}_background_gradient" );
				$color1         = $gradient_color['color_1'];
				$color2         = $gradient_color['color_2'];

				$css .= "
					.page-title-bg
					{
						background-color: $color1;
						background-image: linear-gradient(-180deg, {$color1} 0%, {$color2} 100%);
					}
				";
			}

			$bg_color   = Sala_Helper::get_post_meta( 'page_page_title_background_color', '' );
			$bg_image   = Sala_Helper::get_post_meta( 'page_page_title_background', '' );
			$bg_overlay = Sala_Helper::get_post_meta( 'page_page_title_background_overlay', '' );

			if ( $bg_color !== '' ) {
				$page_title_tmp .= "background-color: {$bg_color}!important;";
			}

			if ( '' !== $bg_image ) {
				$page_title_tmp .= "background-image: url({$bg_image})!important;";
			}

			if ( '' !== $bg_overlay ) {
				$overlay_tmp .= "background-color: {$bg_overlay}!important;";
			}

			if ( '' !== $page_title_tmp ) {
				$css .= ".page-title-bg{ {$page_title_tmp} }";
			}

			if ( '' !== $overlay_tmp ) {
				$css .= ".page-title-bg:before{ {$overlay_tmp} }";
			}

			$text_color = Sala_Helper::get_post_meta( 'page_page_title_color', '' );
			if ( '' !== $text_color ) {
				$css .= "#page-title .heading{ color: {$text_color}; }";
			}

			$breadcrumb_color = Sala_Helper::get_post_meta( 'page_page_title_breadcrumb_color', '' );
			if ( '' !== $breadcrumb_color ) {
				$css .= "#page-title .sala_breadcrumb li{ color: {$breadcrumb_color}; }";
			}

			$breadcrumb_link_color = Sala_Helper::get_post_meta( 'page_page_title_breadcrumb_link_color', '' );
			if ( '' !== $breadcrumb_link_color ) {
				$css .= "#page-title .sala_breadcrumb a{ color: {$breadcrumb_link_color}; }";
			}

			$bottom_spacing = Sala_Helper::get_post_meta( 'page_page_title_bottom_spacing', '' );
			if ( '' !== $bottom_spacing ) {
				$css .= "#page-title{ margin-bottom: {$bottom_spacing}; }";
			}

			return $css;
		}

		function light_gallery_css() {
			$css                    = '';
			$primary_color          = Sala_Helper::setting( 'primary_color' );
			$secondary_color        = Sala_Helper::setting( 'secondary_color' );
			$cutom_background_color = Sala_Helper::setting( 'light_gallery_custom_background' );
			$background             = Sala_Helper::setting( 'light_gallery_background' );

			$tmp = '';

			if ( $background === 'primary' ) {
				$tmp .= "background-color: {$primary_color} !important;";
			} elseif ( $background === 'secondary' ) {
				$tmp .= "background-color: {$secondary_color} !important;";
			} else {
				$tmp .= "";
			}

			$css .= ".lg-backdrop { $tmp }";

			return $css;
		}

		function off_canvas_menu_css() {
			$css  = '';
			$type = Sala_Helper::setting( 'navigation_minimal_01_background_type' );
			if ( $type === 'gradient' ) {
				$gradient = Sala_Helper::setting( 'navigation_minimal_01_background_gradient_color' );

				$css .= ".canvas-menu {
				    background-color: {$gradient['color_1']};
					background-image: linear-gradient(138deg, {$gradient['color_1']} 0%, {$gradient['color_2']} 100%);
				}";
			}

			return $css;
		}

		function mobile_menu_css() {
			$css  = '';
			$type = Sala_Helper::setting( 'mobile_menu_background_type' );
			if ( $type === 'gradient' ) {
				$gradient = Sala_Helper::setting( 'mobile_menu_background_gradient_color' );

				$css .= ".mobile-menu {
				    background-color: {$gradient['color_1']};
					background-image: linear-gradient(138deg, {$gradient['color_1']} 0%, {$gradient['color_2']} 100%);
				}";
			}

			return $css;
		}

	}

	Sala_Custom_Css::instance()->initialize();
}
