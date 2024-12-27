<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
   exit;
}

if ( ! class_exists('Sala_Enqueue') ){

    /**
     *  Class Sala_Enqueue
     */
    class Sala_Enqueue {

    	/**
		 * The constructor.
		 */
		function __construct() {
			add_action('wp_enqueue_scripts',array( $this, 'enqueue_styles' ) );
			add_action('wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		/**
         * Register the stylesheets for the public-facing side of the site.
         */
        public function enqueue_styles()
        {
        	/*
			 * Enqueue Third Party Styles
			 */
			wp_enqueue_style('font-awesome-all', SALA_THEME_URI . '/assets/fonts/font-awesome/css/fontawesome-all.min.css', array(), '5.10.0', 'all');

			wp_enqueue_style('atropos', SALA_THEME_URI . '/assets/libs/atropos/atropos.css', array(), '1.0.0', 'all');

			wp_enqueue_style('swiper', SALA_THEME_URI . '/assets/libs/swiper/css/swiper.css', array(), '5.3.8', 'all');

			wp_enqueue_style('growl', SALA_THEME_URI . '/assets/libs/growl/css/jquery.growl.min.css', array(), '1.3.3', 'all');

            wp_enqueue_style('nice-select', SALA_THEME_URI . '/assets/libs/jquery-nice-select/css/nice-select.css', array(), '1.1.0', 'all');

			wp_enqueue_style('flickity-marquee', SALA_THEME_URI . '/assets/libs/flickity/css/flickity.min.css', array(), '2.2.2', 'all');

			/*
			 * Enqueue Theme Styles
			 */
			wp_enqueue_style( 'sala-font-poppins', SALA_THEME_URI . '/assets/fonts/poppins/stylesheet.css', null, null );

			$type   = Sala_Global::get_header_type();
			$header = 'header-' . $type;
			$header = $header . '.css';
			$upload_dir = wp_upload_dir();
    		$logger_dir = $upload_dir['baseurl'] . '/sala/header/';
			if( Sala_Helper::check_file_base('header-' . $type, 'css') ) {
				wp_enqueue_style( 'sala-header-style', $logger_dir . $header );
			}

			$topbar_type = Sala_Global::get_topbar_type();
			$topbar      = 'topbar-' . $topbar_type;
			$topbar      = $topbar . '.css';
			if( Sala_Helper::check_file_base('topbar-' . $topbar_type, 'css') ) {
				wp_enqueue_style( 'sala-topbar-style', $logger_dir . $topbar );
			}

			if ( is_rtl() ) {
				wp_enqueue_style( 'sala-style', get_template_directory_uri() . '/sala-rtl.min.css' );
				wp_enqueue_style( 'sala-rtl-style-custom', get_template_directory_uri() . '/sala-rtl-custom.css' );
			} else {
				if ( ! get_theme_mod('sala_disable_style_css', 0) ) {
					wp_enqueue_style('sala-style', get_template_directory_uri() . '/style.min.css');
				}
			}

        }

        /**
         * Register the JavaScript for the admin area.
         */
		public function enqueue_scripts() {

			/*
			 * Enqueue Third Party Scripts
			 */
			wp_register_script('gmap3', SALA_THEME_URI . '/assets/libs/gmap3/gmap3.min.js', array( 'jquery' ), '5.3.8', true);

            $api_key = get_theme_mod( 'google_map_api', 'AIzaSyDNI_ZWPqvdS6r6gPVO50I4TlYkfkZdXh8' );
            if ( is_ssl() ) {
				wp_register_script( 'gmap-api', 'https://maps.google.com/maps/api/js?key=' . $api_key . '&amp;language=en' );
			}else{
				wp_register_script( 'gmap-api', 'http://maps.google.com/maps/api/js?key=' . $api_key . '&amp;language=en' );
			}

			wp_enqueue_script('isotope', SALA_THEME_URI . '/assets/libs/isotope/js/isotope.pkgd.min.js', array( 'jquery' ), '3.0.6', true);

			wp_enqueue_script('infinite-scroll', SALA_THEME_URI . '/assets/libs/infinite-scroll/infinite-scroll.pkgd.min.js', array( 'jquery' ), '3.0.6', true);

			wp_enqueue_script('packery', SALA_THEME_URI . '/assets/libs/packery/packery-mode.pkgd.min.js', array( 'jquery' ), '2.0.1', true);

			wp_enqueue_script('atropos', SALA_THEME_URI . '/assets/libs/atropos/atropos.min.js', array( 'jquery' ), '1.0.1', true);

			wp_enqueue_script('swiper', SALA_THEME_URI . '/assets/libs/swiper/js/swiper.min.js', array( 'jquery' ), '5.3.8', true);

			wp_enqueue_script('growl', SALA_THEME_URI . '/assets/libs/growl/js/jquery.growl.min.js', array('jquery'), '1.3.3', true);

			wp_enqueue_script('waypoints', SALA_THEME_URI . '/assets/libs/waypoints/jquery.waypoints.js', array( 'jquery' ), '4.0.1', true);

			wp_enqueue_script('smartmenus', SALA_THEME_URI . '/assets/libs/smartmenus/jquery.smartmenus.js', array( 'jquery' ), '1.1.1', true);

			if ( get_theme_mod( 'smooth_scroll_enable', 0 ) ) {
				wp_enqueue_script('smooth-scroll', SALA_THEME_URI . '/assets/libs/smooth-scroll/SmoothScroll.min.js', array( 'jquery' ), '1.4.9', true );
			}

			wp_enqueue_script('jquery-smooth-scroll', SALA_THEME_URI . '/assets/libs/smooth-scroll/jquery.smooth-scroll.min.js', array( 'jquery' ), '2.2.0', true );

			wp_enqueue_script('validate', SALA_THEME_URI . '/assets/libs/validate/jquery.validate.min.js', array( 'jquery' ), '2.2.0', true );

			wp_enqueue_script( 'modernizr', SALA_THEME_URI . '/assets/libs/elastic-stack/js/modernizr.custom.js', array( 'jquery' ), '2.6.3', true );

			wp_enqueue_script( 'elastic-stack-pkgd', SALA_THEME_URI . '/assets/libs/elastic-stack/js/draggabilly.pkgd.min.js', array( 'jquery' ), '1.0.7', true );

			wp_enqueue_script( 'elastic-stack', SALA_THEME_URI . '/assets/libs/elastic-stack/js/elastiStack.js', array( 'jquery' ), '1.0.0', true );

			wp_enqueue_script( 'nice-select', SALA_THEME_URI . '/assets/libs/jquery-nice-select/js/jquery.nice-select.min.js', array( 'swiper' ), SALA_THEME_VERSION, true );

			wp_enqueue_script( 'windy', SALA_THEME_URI . '/assets/libs/elastic-stack/js/jquery.windy.js', array( 'jquery' ), '1.0.0', true );

			wp_enqueue_script( 'flickity-marquee', SALA_THEME_URI . '/assets/libs/flickity/js/flickity.pkgd.min.js', array( 'jquery' ), '2.2.2', true );

			wp_enqueue_script( 'countdown', SALA_THEME_URI . '/assets/libs/jquery.countdown/js/jquery.countdownTimer.js', array( 'jquery' ), '1.0.8', true );

			/*
			 * Enqueue Theme Scripts
			 */
			wp_enqueue_script( 'sala-custom-js', SALA_THEME_URI . '/assets/js/custom.js', array( 'jquery' ), SALA_THEME_VERSION, true );

		    $ajax_url     = admin_url( 'admin-ajax.php' );
			$current_lang = apply_filters( 'wpml_current_language', null );

			if ( $current_lang ) {
				$ajax_url = add_query_arg( 'lang', $current_lang, $ajax_url );
			}

		    wp_localize_script( 'sala-custom-js', 'theme_vars',
		    	array(
					'ajax_url'                 	=> esc_url( $ajax_url ),
					'header_sticky'            	=> Sala_Global::get_header_overlay(),
					'content_protected_enable' 	=> get_theme_mod( 'content_protected_enable' ),
					'scroll_top_enable'        	=> get_theme_mod( 'scroll_top_enable' ),
					'send_user_info' 			=> esc_html__('Sending user info,please wait...', 'sala'),
					'notice_cookie_enable'      => Sala_Helper::setting( 'notice_cookie_enable' ),
					'notice_cookie_confirm'     => isset( $_COOKIE['notice_cookie_confirm'] ) ? 'yes' : 'no',
					'notice_cookie_messages'    => Sala_Notices::instance()->get_notice_cookie_messages(),
					'prevText' 					=> esc_html__( 'Prev', 'sala' ),
                	'nextText' 					=> esc_html__( 'Next', 'sala' ),
					'validator_required' 		=> esc_html__( 'This field is required', 'sala' ),
                	'validator_remote' 			=> esc_html__( 'Please fix this field', 'sala' ),
                	'validator_email' 			=> esc_html__( 'A valid email address is required', 'sala' ),
                	'validator_url' 			=> esc_html__( 'Please enter a valid URL', 'sala' ),
                	'validator_dateISO' 		=> esc_html__( 'Please enter a valid date (ISO)', 'sala' ),
                	'validator_number' 		=> esc_html__( 'Please enter a valid number', 'sala' ),
                	'validator_digits' 		=> esc_html__( 'Please enter only digits', 'sala' ),
                	'validator_creditcard' 		=> esc_html__( 'Please enter a valid credit card number', 'sala' ),
                	'validator_equalTo' 		=> esc_html__( 'Please enter the same value again', 'sala' ),
                	'validator_accept' 		=> esc_html__( 'Please enter a value with a valid extension', 'sala' ),
                	'validator_maxlength' 		=> esc_html__( 'Please enter no more than {0} characters', 'sala' ),
                	'validator_minlength' 		=> esc_html__( 'Please enter at least {0} characters', 'sala' ),
                	'validator_rangelength' 		=> esc_html__( 'Please enter a value between {0} and {1} characters long', 'sala' ),
                	'validator_range' 		=> esc_html__( 'Please enter a value between {0} and {1}', 'sala' ),
                	'validator_max' 		=> esc_html__( 'Please enter a value less than or equal to {0}', 'sala' ),
                	'validator_min' 		=> esc_html__( 'Please enter a value greater than or equal to {0}', 'sala' ),
				)
			);

			/*
			 * The comment-reply script.
			 */
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}

    }

    new Sala_Enqueue();
}
