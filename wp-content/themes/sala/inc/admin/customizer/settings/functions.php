<?php
defined( 'ABSPATH' ) || exit;

if (! class_exists('Sala_Customize')) {
    class Sala_Customize {

		protected static $instance = null;
		private $wp_customize;

		static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self:: $instance;
		}

		public function initialize() {
			add_action( 'customize_preview_init', array( $this, 'sala_customizer_live_preview') );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'sala_customize_enqueue'), 10);
			add_action( 'customize_register', array( $this, 'customize_register') );
			add_filter( 'kirki_fonts_standard_fonts', array( $this, 'sala_add_custom_font' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'sala_add_custom_font_css' ) );
			add_action( 'wp_ajax_customizer_import', array( $this, 'ajax_customizer_import' ) );
			add_action( 'wp_ajax_customizer_reset', array( $this, 'ajax_customizer_reset') );
			add_action( 'wp_ajax_sala_header_builder', array( $this, 'sala_header_builder') );
			add_action( 'wp_ajax_sala_topbar_builder', array( $this, 'sala_topbar_builder') );
			add_action( 'wp_ajax_sala_header_delete_builder', array( $this, 'sala_header_delete_builder') );
			add_action( 'wp_ajax_sala_topbar_delete_builder', array( $this, 'sala_topbar_delete_builder') );
		}

		function sala_customizer_live_preview()
		{
			wp_enqueue_script('jquery-ui', get_template_directory_uri() . '/inc/admin/customizer/assets/libs/jquery-ui/jquery-ui.min.js', NULL, SALA_THEME_VERSION, true);
			wp_enqueue_script('sala-customize-preview', get_template_directory_uri() . '/inc/admin/customizer/assets/js/preview.js', array('jquery', 'customize-preview'), '', true);
			wp_localize_script('sala-customize-preview', 'customize_preview',
				array(
					'ajax_url' => admin_url( 'admin-ajax.php' ),
					'delete' => __( 'Do you want to delete current layout?', 'sala' ),
				)
			);

			wp_enqueue_style('jquery-ui', get_template_directory_uri() . '/inc/admin/customizer/assets/libs/jquery-ui/jquery-ui.min.css', array(), '', 'all');
			wp_enqueue_style('sala-header-builder', get_template_directory_uri() . '/inc/admin/customizer/assets/css/header-builder.css', array());
			wp_enqueue_style('sala-preview', get_template_directory_uri() . '/inc/admin/customizer/assets/css/preview.css', array());
		}

		function sala_customize_enqueue()
		{
			wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/libs/font-awesome/css/fontawesome.min.css', array(), '5.1.0', 'all');
			wp_enqueue_style('sala-customize', get_template_directory_uri() . '/inc/admin/customizer/assets/css/customize.css', array());
			wp_enqueue_script('sala-customize-script', get_template_directory_uri() . '/inc/admin/customizer/assets/js/customize.js', array('jquery'), false, true);
			wp_localize_script( 'sala-customize-script', 'customizeScript', array(
				'ajaxurl' => admin_url( 'admin-ajax.php', 'relative' ),
				'reset'   => __( 'Reset', 'sala' ),
				'import'  => __( 'Do you want to import customizer options?', 'sala' ),
				'export'  => __( 'Do you want to export customizer options?', 'sala' ),
				'confirm' => __( "Attention! This will remove all customizations ever made via customizer to this theme!\n\nThis action is irreversible!", 'sala' ),
				'nonce'   => array(
					'reset' => wp_create_nonce( 'customizer-reset' ),
				)
			));
		}

		public static function header_elements() {
			$header_elements = array(
				'site-logo'             => __( 'Site Logo', 'sala' ),
				'main-menu'             => __( 'Main Menu', 'sala' ),
				'landing-menu'             => __( 'Landing Menu', 'sala' ),
				'canvas-menu'           => __( 'Canvas Menu', 'sala' ),
				'canvas-menu-02'        => __( 'Canvas Menu 02', 'sala' ),
				'canvas-mb-menu'        => __( 'Canvas Mobile Menu', 'sala' ),
				'header-device'         => __( 'Device', 'sala' ),
				'header-lang'           => __( 'Languages', 'sala' ),
				'header-contact'        => __( 'Contact', 'sala' ),
				'header-search-icon'    => __( 'Search Icon', 'sala' ),
				'header-search-input'   => __( 'Search Input', 'sala' ),
				'header-account'      	=> __( 'Account', 'sala' ),
				'header-cart'      		=> __( 'Cart', 'sala' ),
				'header-button-01'      => __( 'Button 01', 'sala' ),
				'header-custom-html-01' => __( 'Custom HTML 01', 'sala' ),
				'header-custom-html-02' => __( 'Custom HTML 02', 'sala' ),
			);
			// Add Hooked Header Elements
			$header_elements = apply_filters( 'sala_header_elements', $header_elements);

			return $header_elements;
		}

		function sala_add_custom_font( $fonts ) {
			$fonts['Cormorant Garamond'] = [
				'label'    => 'Cormorant Garamond',
				'variants' => [
					100,
					200,
					300,
					'regular',
					500,
					600,
					700,
					800,
					900,
				],
				'stack' => 'Cormorant Garamond',
			];

			return $fonts;
		}

		function sala_add_custom_font_css() {
			$typo_fields = Sala_Kirki::get_typography_fields_id();

			if ( ! is_array( $typo_fields ) || empty( $typo_fields ) ) {
				return;
			}

			$fonts = [];

			foreach ( $typo_fields as $field ) {
				$value = Sala_Helper::setting( $field );

				if ( is_array( $value ) && ! empty( $value['font-family'] ) && 'inherit' !== $value['font-family'] ) {
					$fonts[] = $value['font-family'];
				}
			}

			if ( ! empty( $fonts ) ) {
				$fonts = array_unique( $fonts );

				foreach ( $fonts as $font ) {
					if( strpos( $font, 'Cormorant Garamond' ) !== false ) {
						wp_enqueue_style( 'sala-font-cormorant', SALA_THEME_URI . '/assets/fonts/CormorantGaramond/stylesheet.css', null, null );
					}else{
						do_action( 'sala_enqueue_custom_font', $font ); // hook to custom do enqueue fonts
					}
				}
			}
		}

		public static function get_md_media_query() {
			return '@media (max-width: 1199px)';
		}

		public static function get_sm_media_query() {
			return '@media (max-width: 991px)';
		}

		public static function get_xs_media_query() {
			return '@media (max-width: 767px)';
		}

		/**
		 * Get list header
		 */
		public static function sala_get_headers($default_option = true) {
			$headers = Sala_Global::get_list_headers(false);
			if ( $default_option === true ) {
				$headers = Sala_Global::get_list_headers( true );
			}

			return $headers;
		}

		/**
		 * Get list header
		 */
		public static function sala_get_footers($default_option = true) {
			$footers = Sala_Global::get_list_footers(false);
			if ( $default_option === true ) {
				$footers = Sala_Global::get_list_footers( true );
			}

			return $footers;
		}

		/**
		 * Get list footer
		 */
		public static function sala_get_footers_elementor() {
			$footers = get_posts(array(
				'posts_per_page' => -1,
				'post_type'      => 'elementor_library',
				'tax_query'      => array(
					array(
						'taxonomy' => 'elementor_library_type',
						'field'    => 'slug',
						'terms'    => 'footer',
					)
				),
			));

			$arr_footer = array();
			foreach ($footers as $footer) {
				$arr_footer[$footer->ID] = ucwords($footer->post_name);
			}

			return $arr_footer;
		}

		function customize_register( $wp_customize ) {
			$this->wp_customize = $wp_customize;
			$this->sala_customizer_create_path();
		}

		function ajax_customizer_import() {
			$options = unserialize( $this->sala_get_contents( $_FILES['file']['tmp_name'] ) );
			if ( is_array( $options ) ) {
				foreach ( $options as $key => $val ) {
					set_theme_mod( $key, $val );
				}
			}
			echo json_encode( array( 'options' => $options,'status' => 1, 'message' => __( 'Import is successful!', 'sala' ) ) );
			wp_die();
		}

		function ajax_customizer_reset() {
			if ( ! $this->wp_customize->is_preview() ) {
				wp_send_json_error( 'not_preview' );
			}

			if ( ! check_ajax_referer( 'customizer-reset', 'nonce', false ) ) {
				wp_send_json_error( 'invalid_nonce' );
			}

			$settings = $this->wp_customize->settings();

			// remove theme_mod settings registered in customizer
			foreach ( $settings as $setting ) {
				if ( 'theme_mod' == $setting->type ) {
					remove_theme_mod( $setting->id );
				}
			}

			wp_send_json_success();
		}

		function sala_get_contents( $path ) {
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
			WP_Filesystem();
			global $wp_filesystem;

			$get_content = '';
			if ( function_exists( 'realpath' ) ) {
				$filepath = realpath( $path );
			}
			if ( ! $filepath || ! @is_file( $filepath ) ) {
				return '';
			}

			return $wp_filesystem->get_contents( $filepath );
		}

		function sala_header_builder() {
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
			WP_Filesystem();
			global $wp_filesystem;

			$css        = stripslashes($_POST['css']);
			$header     = Sala_Helper::sala_clean(wp_unslash($_POST['header']));
			$header_obj = $_POST['header_obj'];

			update_option( $header, $header_obj['header'] );

			$this->sala_customizer_create_file($header, 'css', $css);

			return true;

			wp_die();
		}

		function sala_header_delete_builder() {

			$header = Sala_Helper::sala_clean(wp_unslash($_POST['header']));

			delete_option( $header );

			return true;

			wp_die();
		}

		function sala_topbar_builder() {
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
			WP_Filesystem();
			global $wp_filesystem;

			$css        = stripslashes($_POST['css']);
			$topbar     = Sala_Helper::sala_clean(wp_unslash($_POST['topbar']));
			$topbar_obj = $_POST['topbar_obj'];

			update_option( $topbar, $topbar_obj['topbar'] );

			$this->sala_customizer_create_file($topbar, 'css', $css);

			return true;

			wp_die();
		}

		function sala_topbar_delete_builder() {

			$topbar = Sala_Helper::sala_clean(wp_unslash($_POST['topbar']));

			delete_option( $topbar );

			return true;

			wp_die();
		}

		/**
		 * Create Path
		 */
		function sala_customizer_create_path() {
			$upload_dir = wp_upload_dir();
			$logger_dir = $upload_dir['basedir'] . '/sala/header';

			if ( ! file_exists( $logger_dir ) ) {
				wp_mkdir_p( $logger_dir );
			}
		}

		function sala_customizer_create_file($name, $path, $css) {
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
			WP_Filesystem();
			global $wp_filesystem;

			$upload_dir = wp_upload_dir();
			$logger_dir = $upload_dir['basedir'] . '/sala/header';

			$name = $name . '.' . $path;
			$wp_filesystem->put_contents( trailingslashit( $logger_dir ) . $name, $css );
		}

    }

	Sala_Customize::instance()->initialize();
}
