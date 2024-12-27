<?php
/**
 * Default Customizer Options
 *
 * @package sala
 */

/**
*  Get default options
*/
if ( !function_exists( 'sala_get_default_theme_options' ) ) {
	function sala_get_default_theme_options() {
		$defaults = array();

		/**
		*  General
		*/
		$defaults['logo_width']        = 110;
		$defaults['logo_dark']         = SALA_IMAGES . 'logo-dark.png';
		$defaults['logo_dark_retina']  = SALA_IMAGES . 'logo-dark-retina.png';
		$defaults['logo_light']        = SALA_IMAGES . 'logo-light.png';
		$defaults['logo_light_retina'] = SALA_IMAGES . 'logo-light-retina.png';

		$defaults['type_loading_effect']      = 'none';
		$defaults['animation_loading_effect'] = 'css-1';
		$defaults['image_loading_effect']     = '';

		$defaults['user_account']    = '0';
		$defaults['url_phone']       = '68689888';
		$defaults['url_email']       = 'sala@uxper.co';
		$defaults['url_facebook']    = '';
		$defaults['url_twitter']     = '';
		$defaults['url_instagram']   = '';
		$defaults['url_youtube']     = '';
		$defaults['url_google_plus'] = '';
		$defaults['url_skype']       = '';
		$defaults['url_linkedin']    = '';
		$defaults['url_pinterest']   = '';
		$defaults['url_slack']       = '';
		$defaults['url_rss']         = '';

		/**
		*  Color
		*/
		$defaults['primary_color'] =	'#111111';
		$defaults['text_color']    = 	'#555555';
		$defaults['accent_color']  = 	'#0057fc';

		/**
		*  Typography
		*/
		$defaults['font-family']    = 'Poppins';
		$defaults['font-size']      = '16px';
		$defaults['variant']        = 400;
		$defaults['line-height']    = 1.63;
		$defaults['letter-spacing'] = 'inherit';

		$defaults['heading-font-family']    = 'Poppins';
		$defaults['heading-line-height']    = 'inherit';
		$defaults['heading-variant']        = 700;
		$defaults['heading-letter-spacing'] = 'inherit';

		/**
		*  Button
		*/
		// General
		$defaults['button_font_family']            = '';
		$defaults['button_font_size']              = '15px';
		$defaults['button_line_height']            = '1.4';
		$defaults['button_variant']                = 500;
		$defaults['button_letter_spacing']         = '1';
		$defaults['button_text_transform']         = 'uppercase';

		// Full Filled
		$defaults['button_full_filled_color']                  = '#ffffff';
		$defaults['button_full_filled_hover_color']            = '#ffffff';
		$defaults['button_full_filled_background_color']       = '#0057fc';
		$defaults['button_full_filled_hover_background_color'] = '#1043B2';
		$defaults['button_full_filled_radius']                 = 3;
		$defaults['button_full_filled_border']                 = 'none';
		$defaults['button_full_filled_border_color']           = '#0057fc';

		// Underline
		$defaults['button_underline_color']                  = '#1a1a1a';
		$defaults['button_underline_hover_color']            = '#0057fc';
		$defaults['button_underline_background_color']       = '';
		$defaults['button_underline_hover_background_color'] = '';
		$defaults['button_underline_radius']                 = 0;
		$defaults['button_underline_border']                 = 'solid';
		$defaults['button_underline_border_color']           = '#1a1a1a';

		// Border Line
		$defaults['button_border_line_color']                  = '#1a1a1a';
		$defaults['button_border_line_hover_color']            = '#0057fc';
		$defaults['button_border_line_background_color']       = '';
		$defaults['button_border_line_hover_background_color'] = '';
		$defaults['button_border_line_radius']                 = 3;
		$defaults['button_border_line_border']                 = 'solid';
		$defaults['button_border_line_border_color']           = '#1a1a1a';

		/**
		*  Layout
		*/
		$defaults['layout_content']           = 'fullwidth';
		$defaults['boxed_width']              = 1170;
		$defaults['body_background_color']    = '#ffffff';
		$defaults['content_background_color'] = '#ffffff';
		$defaults['bg_body_image']            = '';
		$defaults['bg_body_size']             = 'auto';
		$defaults['bg_body_repeat']           = 'no-repeat';
		$defaults['bg_body_position']         = 'left top';
		$defaults['bg_body_attachment']       = 'scroll';

		/**
		*  Header
		*/
		$defaults['header_type']           = '01';
		$defaults['top_bar_type']          = '';
		$defaults['header_overlay']        = '0';
		$defaults['header_float']          = '0';
		$defaults['header_skin']           = 'light';
		$defaults['header_padding_top']    = '20';
		$defaults['header_padding_bottom'] = '20';

		/**
		*  Footer
		*/
		$defaults['footer_type']           = '5690';
		$defaults['footer_copyright_text'] = esc_attr__('© 2021 Uxper. All rights reserved', 'sala');

		/**
		*  Blog
		*/
		$defaults['blog_archive_active_sidebar']           = 'blog_sidebar';
		$defaults['blog_archive_sidebar_position']         = 'none';
		$defaults['blog_archive_sidebar_width']            = 370;
		$defaults['blog_archive_page_title_layout']        = '01';
		$defaults['blog_archive_display_categories']       = 'hide';
		$defaults['blog_archive_display_count_categories'] = 'hide';
		$defaults['blog_archive_display_action']       	   = 'hide';
		$defaults['blog_archive_display_count_post']       = 'show';
		$defaults['blog_archive_display_post_filter']      = 'show';
		$defaults['blog_archive_pagination_type']          = 'navigation';
		$defaults['blog_archive_pagination_position']      = 'center';
		$defaults['blog_desktop_column']                   = '3';
		$defaults['blog_tablet_column']                    = '2';
		$defaults['blog_mobile_column']                    = '1';
		$defaults['blog_content_post_gutter']              = '30';
		$defaults['blog_archive_post_layout']              = 'default';
		$defaults['blog_content_post_image_size']          = '740x740';
		$defaults['blog_content_post_card']                = 'hide';
		$defaults['blog_content_post_box']                 = 'hide';
		$defaults['blog_content_post_box_background']      = 'hide';
		$defaults['blog_content_post_categories']          = 'show';
		$defaults['blog_content_post_time']                = 'hide';
		$defaults['blog_content_post_comment']             = 'hide';
		$defaults['blog_content_post_excerpt']             = 'show';
		$defaults['blog_content_post_button']              = 'show';
		$defaults['blog_content_post_excerpt_number']      = 15;
		$defaults['blog_archive_header_type']              = '';
		$defaults['blog_archive_header_overlay']           = '';
		$defaults['blog_archive_header_float']             = '';
		$defaults['blog_archive_header_skin']              = '';

		$defaults['single_post_layout']                 = '01';
		$defaults['single_post_active_sidebar']         = 'blog_sidebar';
		$defaults['single_post_sidebar_position']       = 'right';
		$defaults['single_post_sidebar_width']          = 370;
		$defaults['single_post_title_fullscreen']       = 'hide';
		$defaults['single_post_page_title_layout']      = '01';
		$defaults['single_post_boxed']     				= 'show';
		$defaults['single_post_display_categories']     = 'show';
		$defaults['single_post_display_date_time']      = 'show';
		$defaults['single_post_display_comment_count']  = 'hide';
		$defaults['single_post_display_title']          = 'show';
		$defaults['single_post_display_featured_image'] = 'show';
		$defaults['single_post_display_tags']           = 'show';
		$defaults['single_post_display_sharing']        = 'show';
		$defaults['single_post_display_author']         = 'show';
		$defaults['single_post_display_related']        = 'show';
		$defaults['single_post_display_comments']       = 'show';
		$defaults['single_post_header_type']            = '';
		$defaults['single_post_header_overlay']         = '';
		$defaults['single_post_header_float']           = '';
		$defaults['single_post_header_skin']            = '';


		/**
		*  Portfolio
		*/
		$defaults['portfolio_archive_active_sidebar']           = 'portfolio_sidebar';
		$defaults['portfolio_archive_sidebar_position']         = 'none';
		$defaults['portfolio_archive_sidebar_width']            = 370;
		$defaults['portfolio_archive_page_title_layout']        = '01';
		$defaults['portfolio_archive_display_taxonomy']       	= 'hide';
		$defaults['portfolio_archive_display_count_taxonomy'] 	= 'hide';
		$defaults['portfolio_archive_display_action']       	= 'hide';
		$defaults['portfolio_archive_display_count_post']       = 'show';
		$defaults['portfolio_archive_display_post_filter']      = 'show';
		$defaults['portfolio_archive_pagination_type']          = 'navigation';
		$defaults['portfolio_archive_pagination_position']      = 'center';
		$defaults['portfolio_desktop_column']                   = '3';
		$defaults['portfolio_tablet_column']                    = '2';
		$defaults['portfolio_mobile_column']                    = '1';
		$defaults['portfolio_content_post_gutter']              = '30';
		$defaults['portfolio_archive_post_layout']              = 'grid';
		$defaults['portfolio_content_post_image_size']          = '740x740';
		$defaults['portfolio_content_post_card']                = 'hide';
		$defaults['portfolio_content_minimal_style']            = 'hide';
		$defaults['portfolio_content_modern_style']      		= 'hide';
		$defaults['portfolio_content_post_taxonomy']          	= 'show';
		$defaults['portfolio_content_post_excerpt']             = 'show';
		$defaults['portfolio_content_post_button']              = 'show';
		$defaults['portfolio_content_post_excerpt_number']      = 15;
		$defaults['portfolio_archive_header_type']              = '';
		$defaults['portfolio_archive_header_overlay']           = '';
		$defaults['portfolio_archive_header_float']             = '';
		$defaults['portfolio_archive_header_skin']              = '';

		$defaults['single_portfolio_layout']                 = '01';
		$defaults['single_portfolio_active_sidebar']         = 'blog_sidebar';
		$defaults['single_portfolio_sidebar_position']       = 'right';
		$defaults['single_portfolio_sidebar_width']          = 370;
		$defaults['single_portfolio_title_fullscreen']       = 'hide';
		$defaults['single_portfolio_page_title_layout']      = '01';
		$defaults['single_portfolio_boxed']     			 = 'show';
		$defaults['single_portfolio_display_taxonomy']     	 = 'show';
		$defaults['single_portfolio_display_date_time']      = 'show';
		$defaults['single_portfolio_display_comment_count']  = 'hide';
		$defaults['single_portfolio_display_title']          = 'show';
		$defaults['single_portfolio_display_meta']           = 'show';
		$defaults['single_portfolio_display_featured_image'] = 'show';
		$defaults['single_portfolio_display_tags']           = 'show';
		$defaults['single_portfolio_display_sharing']        = 'show';
		$defaults['single_portfolio_display_author']         = 'show';
		$defaults['single_portfolio_gallery']        	 	 = 'show';
		$defaults['single_portfolio_gallery_title']        	 = 'show';
		$defaults['single_portfolio_video_enable']        	 = 'show';
		$defaults['single_portfolio_video_title_enable']     = 'show';
		$defaults['single_portfolio_paginate']        		 = 'show';
		$defaults['single_portfolio_display_related']        = 'show';
		$defaults['single_portfolio_display_comments']       = 'show';
		$defaults['single_portfolio_header_type']            = '';
		$defaults['single_portfolio_header_overlay']         = '';
		$defaults['single_portfolio_header_float']           = '';
		$defaults['single_portfolio_header_skin']            = '';

		/**
		*  Page
		*/
		$defaults['page_header_type']       = '01';
		$defaults['page_header_overlay']    = '';
		$defaults['page_header_float']      = '';
		$defaults['page_header_skin']       = '';
		$defaults['page_active_sidebar']    = 'page_sidebar';
		$defaults['page_sidebar_position']  = 'none';
		$defaults['page_sidebar_width']     = 370;
		$defaults['page_page_title_layout'] = '01';

		if ( class_exists( 'WooCommerce' ) ) {
			/**
			*  Shop
			*/
			$defaults['product_archive_active_sidebar']      = 'shop_sidebar';
			$defaults['product_archive_sidebar_position']    = 'none';
			$defaults['product_archive_sidebar_width']       = 370;
			$defaults['product_archive_page_title_layout']   = '01';
			$defaults['product_archive_sorting']             = '1';
			$defaults['product_archive_number_item']         = 9;
			$defaults['product_archive_pagination_type']     = 'navigation';
			$defaults['product_archive_pagination_position'] = 'center';
			$defaults['product_archive_desktop_column']      = '3';
			$defaults['product_archive_tablet_column']       = '2';
			$defaults['product_archive_mobile_column']       = '1';
			$defaults['product_archive_layout']              = 'grid';
			$defaults['product_archive_image_size']          = '740x840';
			$defaults['product_archive_header_type']         = '';
			$defaults['product_archive_header_overlay']      = '';
			$defaults['product_archive_header_float']        = '';
			$defaults['product_archive_header_skin']         = '';

			$defaults['single_product_active_sidebar']     = 'shop_sidebar';
			$defaults['single_product_sidebar_position']   = 'right';
			$defaults['single_product_sidebar_width']      = 370;
			$defaults['single_product_page_title_layout']  = '01';
			$defaults['single_product_breadcrumb_enable']  = '1';
			$defaults['single_product_sale_flash_enable']  = '1';
			$defaults['single_product_images_enable']      = '1';
			$defaults['single_product_title_enable']       = '1';
			$defaults['single_product_rating_enable']      = '1';
			$defaults['single_product_price_enable']       = '1';
			$defaults['single_product_excerpt_enable']     = '1';
			$defaults['single_product_add_to_cart_enable'] = '1';
			$defaults['single_product_meta_enable']        = '1';
			$defaults['single_product_tabs_enable']        = '1';
			$defaults['single_product_up_sells_enable']    = '1';
			$defaults['single_product_related_enable']     = '1';
			$defaults['single_product_header_type']        = '';
			$defaults['single_product_header_overlay']     = '';
			$defaults['single_product_header_float']       = '';
			$defaults['single_product_header_skin']        = '';
		}

		return $defaults;
	}
}

/**
 * Get Setting
 */
if ( ! function_exists('sala_get_setting') ) {
	function sala_get_setting($key, $default = '') {
		$option = '';
		$option = Sala_Kirki::get_option( 'theme', $key );

		return ( !empty($option) ) ? $option: $default;
	}
}
