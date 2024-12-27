<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Sala_Metabox' ) ) {
	class Sala_Metabox
	{

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self:: $instance;
		}

		public function initialize() {
			add_filter( 'uxper_metabox_meta_boxes', array( $this, 'register_meta_boxes' ) );
		}

		/**
		 * Register Metabox
		 *
		 * @param $meta_boxes
		 *
		 * @return array
		 */
		public function register_meta_boxes( $meta_boxes ) {
			$page_registered_sidebars = Sala_Helper::get_registered_sidebars( true );

			$general_options = array(
				array(
					'title'  => esc_attr__( 'Layout', 'sala' ),
					'fields' => array(
						array(
							'id'      => 'site_layout',
							'type'    => 'select',
							'title'   => esc_html__( 'Layout', 'sala' ),
							'desc'    => esc_html__( 'Controls the layout of this page.', 'sala' ),
							'options' => array(
								''          => esc_attr__( 'Default', 'sala' ),
								'boxed'     => esc_attr__( 'Boxed', 'sala' ),
								'fullwidth' => esc_attr__( 'Full Width', 'sala' ),
							),
							'default' => '',
						),
						array(
							'id'    => 'site_accent_color',
							'type'  => 'color',
							'title' => esc_html__( 'Accent Color', 'sala' ),
							'desc'  => esc_html__( 'Controls the accent color this page.', 'sala' ),
						),
						array(
							'id'    => 'site_width',
							'type'  => 'text',
							'title' => esc_html__( 'Site Width', 'sala' ),
							'desc'  => esc_html__( 'Controls the site width for this page. Enter value including any valid CSS unit. For e.g: 1200px. Leave blank to use global setting.', 'sala' ),
						),
						array(
							'id'    => 'site_top_spacing',
							'type'  => 'text',
							'title' => esc_html__( 'Site Top Spacing', 'sala' ),
							'desc'  => esc_html__( 'Controls the top spacing of this page. Enter value including any valid CSS unit. For e.g: 50px. Leave blank to use global setting.', 'sala' ),
						),
						array(
							'id'    => 'site_bottom_spacing',
							'type'  => 'text',
							'title' => esc_html__( 'Site Bottom Spacing', 'sala' ),
							'desc'  => esc_html__( 'Controls the bottom spacing of this page. Enter value including any valid CSS unit. For e.g: 50px. Leave blank to use global setting.', 'sala' ),
						),
						array(
							'id'    => 'body_class',
							'type'  => 'text',
							'title' => esc_html__( 'Body Class', 'sala' ),
							'desc'  => esc_html__( 'Add a class name to body then refer to it in custom CSS.', 'sala' ),
						),
						array(
							'id'    => 'content_top_spacing',
							'type'  => 'text',
							'title' => esc_html__( 'Content Top Spacing', 'sala' ),
							'desc'  => esc_html__( 'Controls the top spacing of content page. Enter value including any valid CSS unit. For e.g: 50px. Leave blank to use global setting.', 'sala' ),
						),
						array(
							'id'    => 'content_bottom_spacing',
							'type'  => 'text',
							'title' => esc_html__( 'Content Bottom Spacing', 'sala' ),
							'desc'  => esc_html__( 'Controls the bottom spacing of content page. Enter value including any valid CSS unit. For e.g: 50px. Leave blank to use global setting.', 'sala' ),
						),
						array(
							'id'    => 'content_top_spacing_tablet',
							'type'  => 'text',
							'title' => esc_html__( 'Content Top Spacing Tablet', 'sala' ),
							'desc'  => esc_html__( 'Controls the top spacing of content page. Enter value including any valid CSS unit. For e.g: 50px. Leave blank to use global setting.', 'sala' ),
						),
						array(
							'id'    => 'content_bottom_spacing_tablet',
							'type'  => 'text',
							'title' => esc_html__( 'Content Bottom Spacing Tablet', 'sala' ),
							'desc'  => esc_html__( 'Controls the bottom spacing of content page. Enter value including any valid CSS unit. For e.g: 50px. Leave blank to use global setting.', 'sala' ),
						),
						array(
							'id'    => 'content_top_spacing_mobile',
							'type'  => 'text',
							'title' => esc_html__( 'Content Top Spacing Mobile', 'sala' ),
							'desc'  => esc_html__( 'Controls the top spacing of content page. Enter value including any valid CSS unit. For e.g: 50px. Leave blank to use global setting.', 'sala' ),
						),
						array(
							'id'    => 'content_bottom_spacing_mobile',
							'type'  => 'text',
							'title' => esc_html__( 'Content Bottom Spacing Mobile', 'sala' ),
							'desc'  => esc_html__( 'Controls the bottom spacing of content page. Enter value including any valid CSS unit. For e.g: 50px. Leave blank to use global setting.', 'sala' ),
						),
						array(
							'id'      => 'content_overflow_hidden',
							'type'    => 'select',
							'title'   => esc_html__( 'Overflow Hidden', 'sala' ),
							'default' => 'inherit',
							'options' => array(
								'hidden'     => esc_html__( 'Yes', 'sala' ),
								'inherit' => esc_html__( 'No', 'sala' ),
							),
						),
					),
				),
				array(
					'title'  => esc_attr__( 'Background', 'sala' ),
					'fields' => array(
						array(
							'id'      => 'site_background_message',
							'type'    => 'message',
							'title'   => esc_html__( 'Background Boxed', 'sala' ),
							'message' => esc_html__( 'These options controls the background on boxed mode.', 'sala' ),
						),
						array(
							'id'    => 'site_background_color',
							'type'  => 'color',
							'title' => esc_html__( 'Background Color', 'sala' ),
							'desc'  => esc_html__( 'Controls the background color of the outer background area in boxed mode of this page.', 'sala' ),
						),
						array(
							'id'    => 'site_background_image',
							'type'  => 'media',
							'title' => esc_html__( 'Background Image', 'sala' ),
							'desc'  => esc_html__( 'Controls the background image of the outer background area in boxed mode of this page.', 'sala' ),
						),
						array(
							'id'      => 'site_background_repeat',
							'type'    => 'select',
							'title'   => esc_html__( 'Background Repeat', 'sala' ),
							'desc'    => esc_html__( 'Controls the background repeat of the outer background area in boxed mode of this page.', 'sala' ),
							'options' => array(
								'no-repeat' => esc_attr__( 'No repeat', 'sala' ),
								'repeat'    => esc_attr__( 'Repeat', 'sala' ),
								'repeat-x'  => esc_attr__( 'Repeat X', 'sala' ),
								'repeat-y'  => esc_attr__( 'Repeat Y', 'sala' ),
							),
						),
						array(
							'id'      => 'site_background_attachment',
							'type'    => 'select',
							'title'   => esc_html__( 'Background Attachment', 'sala' ),
							'desc'    => esc_html__( 'Controls the background attachment of the outer background area in boxed mode of this page.', 'sala' ),
							'options' => array(
								''       => esc_attr__( 'Default', 'sala' ),
								'fixed'  => esc_attr__( 'Fixed', 'sala' ),
								'scroll' => esc_attr__( 'Scroll', 'sala' ),
							),
						),
						array(
							'id'      => 'site_background_position',
							'type'    => 'select',
							'title'   => esc_html__( 'Background Position', 'sala' ),
							'desc'    => esc_html__( 'Controls the background position of the outer background area in boxed mode of this page.', 'sala' ),
							'options' => array(
								''              => esc_attr__( 'Default', 'sala' ),
								'left top'      => esc_attr__( 'Left Top', 'sala' ),
								'left center'   => esc_attr__( 'Left Center', 'sala' ),
								'left bottom'   => esc_attr__( 'Left Bottom', 'sala' ),
								'right top'     => esc_attr__( 'Right Top', 'sala' ),
								'right center'  => esc_attr__( 'Right Center', 'sala' ),
								'right bottom'  => esc_attr__( 'Right Bottom', 'sala' ),
								'center top'    => esc_attr__( 'Center Top', 'sala' ),
								'center center' => esc_attr__( 'Center Center', 'sala' ),
								'center bottom' => esc_attr__( 'Center Bottom', 'sala' ),
							),
						),
						array(
							'id'      => 'site_background_size',
							'type'    => 'select',
							'title'   => esc_html__( 'Background Size', 'sala' ),
							'desc'    => esc_html__( 'Controls the background size of the outer background area in boxed mode of this page.', 'sala' ),
							'options' => array(
								''        => esc_attr__( 'Default', 'sala' ),
								'auto'    => esc_attr__( 'Auto', 'sala' ),
								'cover'   => esc_attr__( 'Cover', 'sala' ),
								'contain' => esc_attr__( 'Contain', 'sala' ),
								'initial' => esc_attr__( 'Initial', 'sala' ),
							),
						),
						array(
							'id'      => 'content_background_message',
							'type'    => 'message',
							'title'   => esc_html__( 'Background Content', 'sala' ),
							'message' => esc_html__( 'These options controls the background of main content on this page.', 'sala' ),
						),
						array(
							'id'    => 'content_background_color',
							'type'  => 'color',
							'title' => esc_html__( 'Background Color', 'sala' ),
							'desc'  => esc_html__( 'Controls the background color of main content on this page.', 'sala' ),
						),
						array(
							'id'    => 'content_background_image',
							'type'  => 'media',
							'title' => esc_html__( 'Background Image', 'sala' ),
							'desc'  => esc_html__( 'Controls the background image of main content on this page.', 'sala' ),
						),
						array(
							'id'      => 'content_background_repeat',
							'type'    => 'select',
							'title'   => esc_html__( 'Background Repeat', 'sala' ),
							'desc'    => esc_html__( 'Controls the background repeat of main content on this page.', 'sala' ),
							'options' => array(
								'no-repeat' => esc_attr__( 'No repeat', 'sala' ),
								'repeat'    => esc_attr__( 'Repeat', 'sala' ),
								'repeat-x'  => esc_attr__( 'Repeat X', 'sala' ),
								'repeat-y'  => esc_attr__( 'Repeat Y', 'sala' ),
							),
						),
						array(
							'id'      => 'content_background_attachment',
							'type'    => 'select',
							'title'   => esc_html__( 'Background Attachment', 'sala' ),
							'desc'    => esc_html__( 'Controls the background attachment of the inner background area in boxed mode of this page.', 'sala' ),
							'options' => array(
								''       => esc_attr__( 'Default', 'sala' ),
								'fixed'  => esc_attr__( 'Fixed', 'sala' ),
								'scroll' => esc_attr__( 'Scroll', 'sala' ),
							),
						),
						array(
							'id'      => 'content_background_position',
							'type'    => 'select',
							'title'   => esc_html__( 'Background Position', 'sala' ),
							'desc'    => esc_html__( 'Controls the background position of main content on this page.', 'sala' ),
							'options' => array(
								''              => esc_attr__( 'Default', 'sala' ),
								'left top'      => esc_attr__( 'Left Top', 'sala' ),
								'left center'   => esc_attr__( 'Left Center', 'sala' ),
								'left bottom'   => esc_attr__( 'Left Bottom', 'sala' ),
								'right top'     => esc_attr__( 'Right Top', 'sala' ),
								'right center'  => esc_attr__( 'Right Center', 'sala' ),
								'right bottom'  => esc_attr__( 'Right Bottom', 'sala' ),
								'center top'    => esc_attr__( 'Center Top', 'sala' ),
								'center center' => esc_attr__( 'Center Center', 'sala' ),
								'center bottom' => esc_attr__( 'Center Bottom', 'sala' ),
							),
						),
						array(
							'id'      => 'content_background_size',
							'type'    => 'select',
							'title'   => esc_html__( 'Background Size', 'sala' ),
							'desc'    => esc_html__( 'Controls the background size of the inner background area in boxed mode of this page.', 'sala' ),
							'options' => array(
								''        => esc_attr__( 'Default', 'sala' ),
								'auto'    => esc_attr__( 'Auto', 'sala' ),
								'cover'   => esc_attr__( 'Cover', 'sala' ),
								'contain' => esc_attr__( 'Contain', 'sala' ),
								'initial' => esc_attr__( 'Initial', 'sala' ),
							),
						),
					),
				),
				array(
					'title'  => esc_html__( 'Header', 'sala' ),
					'fields' => array(
						array(
							'id'    => 'header_type',
							'type'  => 'select',
							'title' => esc_attr__( 'Header Type', 'sala' ),
							'desc'  => wp_kses(
								sprintf(
									__( 'Select header type that displays on this page. When you choose Default, the value in %s will be used.', 'sala' ),
									'<a href="' . admin_url( '/customize.php?autofocus[section]=header' ) . '">Customize</a>'
								), 'sala-a' ),
							'default' => '',
							'options' => Sala_Global::get_list_headers( true ),
						),
						array(
							'id'      => 'header_overlay',
							'type'    => 'select',
							'title'   => esc_attr__( 'Header Overlay', 'sala' ),
							'default' => '',
							'options' => array(
								''  => esc_html__( 'Default', 'sala' ),
								'0' => esc_html__( 'No', 'sala' ),
								'1' => esc_html__( 'Yes', 'sala' ),
							),
						),
						array(
							'id'      => 'header_float',
							'type'    => 'select',
							'title'   => esc_attr__( 'Header Float', 'sala' ),
							'default' => '',
							'options' => array(
								''  => esc_html__( 'Default', 'sala' ),
								'0' => esc_html__( 'No', 'sala' ),
								'1' => esc_html__( 'Yes', 'sala' ),
							),
						),
						array(
							'id'      => 'header_skin',
							'type'    => 'select',
							'title'   => esc_attr__( 'Header Skin', 'sala' ),
							'default' => '',
							'options' => array(
								''      => esc_html__( 'Default', 'sala' ),
								'dark'  => esc_html__( 'Dark', 'sala' ),
								'light' => esc_html__( 'Light', 'sala' ),
							),
						),
						array(
							'id'      => 'custom_dark_logo',
							'type'    => 'media',
							'title'   => esc_html__( 'Custom Dark Logo', 'sala' ),
							'desc'    => esc_html__( 'Select custom dark logo for this page.', 'sala' ),
							'default' => '',
						),
						array(
							'id'      => 'custom_light_logo',
							'type'    => 'media',
							'title'   => esc_html__( 'Custom Light Logo', 'sala' ),
							'desc'    => esc_html__( 'Select custom light logo for this page.', 'sala' ),
							'default' => '',
						),
						array(
							'id'      => 'custom_logo_width',
							'type'    => 'text',
							'title'   => esc_html__( 'Custom Logo Width', 'sala' ),
							'desc'    => esc_html__( 'Controls the width of logo. For e.g: 150px', 'sala' ),
							'default' => '',
						),
						array(
							'id'      => 'custom_sticky_logo_width',
							'type'    => 'text',
							'title'   => esc_html__( 'Custom Sticky Logo Width', 'sala' ),
							'desc'    => esc_html__( 'Controls the width of sticky logo. For e.g: 150px', 'sala' ),
							'default' => '',
						),
					),
				),
				array(
					'title'  => esc_html__( 'Page Title', 'sala' ),
					'fields' => array(
						array(
							'id'      => 'page_page_title_layout',
							'type'    => 'select',
							'title'   => esc_html__( 'Layout', 'sala' ),
							'default' => '',
							'options' => Sala_Page_Title::instance()->get_list( true ),
						),
						array(
							'id'    => 'page_page_title_bottom_spacing',
							'type'  => 'text',
							'title' => esc_html__( 'Spacing', 'sala' ),
							'desc'  => esc_html__( 'Controls the bottom spacing of page title of this page. Enter value including any valid CSS unit. For e.g: 50px. Leave blank to use global setting.', 'sala' ),
						),
						array(
							'id'      => 'page_page_title_background_color',
							'type'    => 'color',
							'title'   => esc_html__( 'Background Color', 'sala' ),
							'default' => '',
						),
						array(
							'id'      => 'page_page_title_color',
							'type'    => 'color',
							'title'   => esc_html__( 'Color', 'sala' ),
							'default' => '',
						),
						array(
							'id'      => 'page_page_title_breadcrumb_color',
							'type'    => 'color',
							'title'   => esc_html__( 'Breadcrumb Color', 'sala' ),
							'default' => '',
						),
						array(
							'id'      => 'page_page_title_breadcrumb_link_color',
							'type'    => 'color',
							'title'   => esc_html__( 'Breadcrumb Link Color', 'sala' ),
							'default' => '',
						),
						array(
							'id'      => 'page_page_title_background',
							'type'    => 'media',
							'title'   => esc_html__( 'Background Image', 'sala' ),
							'default' => '',
						),
						array(
							'id'      => 'page_page_title_background_overlay',
							'type'    => 'color',
							'title'   => esc_html__( 'Background Overlay', 'sala' ),
							'default' => '',
						),
						array(
							'id'    => 'page_page_title_custom_heading',
							'type'  => 'text',
							'title' => esc_html__( 'Custom Heading Text', 'sala' ),
							'desc'  => esc_html__( 'Insert custom heading for the page title. Leave blank to use default.', 'sala' ),
						),
					),
				),
				array(
					'title'  => esc_html__( 'Sidebars', 'sala' ),
					'fields' => array(
						array(
							'id'      => 'active_sidebar',
							'type'    => 'select',
							'title'   => esc_html__( 'Sidebar', 'sala' ),
							'desc'    => esc_html__( 'Select sidebar that will display on this page.', 'sala' ),
							'default' => 'default',
							'options' => $page_registered_sidebars,
						),
						array(
							'id'    => 'sidebar_position',
							'type'  => 'switch',
							'title' => esc_html__( 'Sidebar Position', 'sala' ),
							'desc'  => esc_html__( 'Select position of Sidebar for this page.', 'sala' ),
							'default' => 'default',
							'options' => array(
								'left'    => esc_html__( 'Left', 'sala' ),
								'right'   => esc_html__( 'Right', 'sala' ),
								'default' => esc_html__( 'Default', 'sala' ),
							),
						),
					),
				),
				array(
					'title'  => esc_html__( 'Footer', 'sala' ),
					'fields' => array(
						array(
							'id'      => 'footer_enable',
							'type'    => 'select',
							'title'   => esc_html__( 'Footer Enable', 'sala' ),
							'default' => '',
							'options' => array(
								''     => esc_html__( 'Yes', 'sala' ),
								'none' => esc_html__( 'No', 'sala' ),
							),
						),
						array(
							'id'    => 'footer_type',
							'type'  => 'select',
							'title' => esc_attr__( 'Footer Type', 'sala' ),
							'desc'  => '',
							'default' => '',
							'options' => Sala_Global::get_list_footers( true ),
						),
					),
				),
			);

			$portfolio_options = array(
				array(
					'title'  => esc_html__( 'Gallery', 'sala' ),
					'fields' => array(
						array(
							'id'      => 'portfolio_content_gallery',
							'type'    => 'gallery',
							'title'   => esc_html__( 'Portfolio Content Gallery', 'sala' ),
							'default' => '',
						),
					),
				),
				array(
					'title'  => esc_html__( 'Video', 'sala' ),
					'fields' => array(
						array(
							'id'      	=> 'portfolio_video_thumbnail',
							'type'    	=> 'media',
							'title'   	=> esc_html__( 'Portfolio Video Thumbnail', 'sala' ),
							'default' 	=> SALA_THEME_DIR . '/assets/images/no-image.jpg',
						),
						array(
							'id'      	=> 'portfolio_video_url',
							'type'    	=> 'text',
							'title'   	=> esc_html__( 'Portfolio Video Url', 'sala' ),
							'default' 	=> '',
							'desc'		=> 'Enter Url Video',
						),
					),
				),
				array(
					'title'  => esc_html__( 'More Info', 'sala' ),
					'fields' => array(
						array(
							'id'      => 'portfolio_content_client',
							'type'    => 'text',
							'title'   => esc_html__( 'Portfolio Content Client', 'sala' ),
							'default' => '',
						),
						array(
							'id'      	=> 'portfolio_content_website',
							'type'    	=> 'text',
							'title'   	=> esc_html__( 'Portfolio Content Website', 'sala' ),
							'default' 	=> '',
							'desc'		=> 'Enter Url Your Website'
						),
					),
				),
			);

			// Page
			$meta_boxes[] = array(
				'id'         => 'sala_page_options',
				'title'      => esc_html__( 'Page Options', 'sala' ),
				'post_types' => array( 'page', 'post', 'product', 'portfolio' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => $general_options,
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'sala_portfolio_options',
				'title'      => esc_html__( 'Portfolio Options', 'sala' ),
				'post_types' => array( 'portfolio' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => $portfolio_options,
					),
				),
			);

			return $meta_boxes;
		}

	}

	Sala_Metabox:: instance()->initialize();
}
