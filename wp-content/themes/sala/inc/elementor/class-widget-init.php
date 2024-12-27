<?php

namespace Sala_Elementor;

use Elementor\Plugin;

defined( 'ABSPATH' ) || exit;

class Widget_Init {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	function __construct() {
		add_shortcode('sala-template', [ $this, 'sala_template_elementor' ] );
	}

	public function initialize() {
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );

		add_action( 'elementor/element/after_add_attributes', [ $this, 'add_elementor_attribute' ] );

		// Registered Widgets.
		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ], 5 );
		add_action( 'elementor/widgets/register', [ $this, 'remove_unwanted_widgets' ], 15 );

		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'after_register_scripts' ] );

		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'enqueue_editor_scripts' ] );

		// Modify original widgets settings.
		require_once SALA_ELEMENTOR_DIR . '/widgets/original/modify-base.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/original/section.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/original/column.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/original/accordion.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/original/animated-headline.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/original/counter.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/original/form.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/original/heading.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/original/icon-box.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/original/progress.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/original/countdown.php';
	}

	/**
	 * Register scripts for widgets.
	 */
	public function after_register_scripts() {
		// Fix Wordpress old version not registered this script.
		if ( ! wp_script_is( 'imagesloaded', 'registered' ) ) {
			wp_register_script( 'imagesloaded', SALA_THEME_URI . '/assets/libs/imagesloaded/imagesloaded.min.js', array( 'jquery' ), null, true );
		}

		wp_register_script( 'circle-progress', SALA_ELEMENTOR_URI . '/assets/libs/circle-progress/circle-progress.min.js', array( 'jquery' ), null, true );

		wp_register_script( 'sala-widget-circle-progress', SALA_ELEMENTOR_URI . '/assets/js/widgets/widget-circle-progress.js', array(
			'jquery',
			'circle-progress',
		), null, true );

		wp_register_script( 'sala-group-widget-carousel', SALA_ELEMENTOR_URI . '/assets/js/widgets/group-widget-carousel.js', array(
			'jquery',
			'swiper',
		), null, true );

		wp_register_script( 'isotope-masonry', SALA_THEME_URI . '/assets/libs/isotope/js/isotope.pkgd.min.js', array( 'jquery' ), SALA_THEME_VERSION, true );

		wp_register_script( 'packery-mode', SALA_THEME_URI . '/assets/libs/packery/packery-mode.pkgd.min.js', array( 'jquery' ), SALA_THEME_VERSION, true );

		wp_register_script( 'sala-grid-layout', SALA_THEME_URI . '/assets/js/custom/grid-layout.js', array(
			'jquery',
			'imagesloaded',
			'isotope-masonry',
			'packery-mode',
		), SALA_THEME_VERSION, true );

		wp_register_script( 'sala-elementor-grid-query', SALA_ELEMENTOR_URI . '/assets/js/widgets/grid-query.js', array( 'jquery' ), null, true );

		wp_register_script( 'sala-widget-modern-menu', SALA_ELEMENTOR_URI . '/assets/js/widgets/widget-modern-menu.js', array( 'jquery' ), null, true );

		wp_register_script( 'sala-widget-grid-post', SALA_ELEMENTOR_URI . '/assets/js/widgets/widget-grid-post.js', array( 'sala-grid-layout' ), null, true );

		wp_register_script( 'sala-widget-grid-portfolio', SALA_ELEMENTOR_URI . '/assets/js/widgets/widget-grid-portfolio.js', array( 'sala-grid-layout' ), null, true );

		wp_register_script( 'sala-widget-grid-job', SALA_ELEMENTOR_URI . '/assets/js/widgets/widget-grid-job.js', array( 'sala-grid-layout' ), null, true );

		wp_register_script( 'sala-group-widget-grid', SALA_ELEMENTOR_URI . '/assets/js/widgets/group-widget-grid.js', array( 'sala-grid-layout' ), null, true );

		wp_register_script( 'sala-widget-google-map', SALA_ELEMENTOR_URI . '/assets/js/widgets/widget-google-map.js', array( 'jquery' ), null, true );

		wp_register_script( 'vivus', SALA_ELEMENTOR_URI . '/assets/libs/vivus/vivus.js', array( 'jquery' ), null, true );

		wp_register_script( 'typed', SALA_ELEMENTOR_URI . '/assets/libs/typed/typed.umd.js', array( 'jquery' ), null, true );

		wp_register_script( 'sala-widget-icon-box', SALA_ELEMENTOR_URI . '/assets/js/widgets/widget-icon-box.js', array(
			'jquery',
			'vivus',
		), null, true );

		wp_register_script( 'sala-widget-flip-box', SALA_ELEMENTOR_URI . '/assets/js/widgets/widget-flip-box.js', array(
			'jquery',
			'imagesloaded',
		), null, true );

		wp_register_script( 'sala-widget-accordion', SALA_ELEMENTOR_URI . '/assets/js/widgets/widget-accordion.js', array(
			'jquery',
		), null, true );

		wp_register_script( 'sala-widget-list', SALA_ELEMENTOR_URI . '/assets/js/widgets/widget-list.js', array(
			'jquery',
		), null, true );

		wp_register_script( 'sala-widget-pricing-table', SALA_ELEMENTOR_URI . '/assets/js/widgets/widget-pricing-table.js', array(
			'jquery',
		), null, true );

		wp_register_script( 'sala-widget-testimonial-stack', SALA_ELEMENTOR_URI . '/assets/js/widgets/widget-testimonial-stack.js', array(
			'jquery',
		), null, true );

		wp_register_script( 'sala-widget-flickity-marquee', SALA_ELEMENTOR_URI . '/assets/js/widgets/widget-flickity-marquee.js', array(
			'jquery',
		), null, true );

		wp_register_script( 'sala-widget-timeline', SALA_ELEMENTOR_URI . '/assets/js/widgets/widget-timeline.js', array(
			'jquery',
		), null, true );

		wp_register_script( 'sala-widget-popup-video', SALA_ELEMENTOR_URI . '/assets/js/widgets/widget-popup.js', array(
			'jquery',
		), null, true );

		wp_register_script( 'sala-widget-chart', SALA_ELEMENTOR_URI . '/assets/js/widgets/widget-chart.js', array(
			'jquery',
		), null, true );

		wp_register_script( 'sala-widget-heading-typed', SALA_ELEMENTOR_URI . '/assets/js/widgets/widget-heading-typed.js', array(
			'jquery',
			'typed',
		), null, true );

		wp_register_script( 'sala-widget-gallery-justified-content', SALA_ELEMENTOR_URI . '/assets/js/widgets/widget-gallery-justified-content.js', array(
			'justifiedGallery',
		), null, true );

		wp_register_script( 'sala-product-carousel-countdown', SALA_ELEMENTOR_URI . '/assets/js/widgets/widget-product-carousel-countdown.js', array(
			'jquery',
			'swiper',
			'countdown',
		), null, true );
	}

	/**
	 * enqueue scripts in editor mode.
	 */
	public function enqueue_editor_scripts() {
		wp_enqueue_script( 'sala-elementor-editor', SALA_ELEMENTOR_URI . '/assets/js/editor.js', array( 'jquery' ), null, true );
	}

	/**
	 * @param \Elementor\Elements_Manager $elements_manager
	 *
	 * Add category.
	 */
	function add_elementor_widget_categories( $elements_manager ) {
		$elements_manager->add_category( 'sala', [
			'title' => esc_html__( 'Sala', 'sala' ),
			'icon'  => 'fa fa-plug',
		] );
	}

	/**
	 * @param \Elementor\Elements_Manager $element_base
	 *
	 * Add attribute.
	 */
	function add_elementor_attribute( $element_base ) {
		$settings = $element_base->get_settings_for_display();

		$_animation = ! empty( $settings['_animation'] );
		$animation = ! empty( $settings['animation'] );
		$has_animation = $_animation && 'none' !== $settings['_animation'] || $animation && 'none' !== $settings['animation'];

		if ( $has_animation ) {
			$is_static_render_mode = Plugin::$instance->frontend->is_static_render_mode();

			$sala_effect = array(
				'SalaSlideInDown',
				'SalaSlideInLeft',
				'SalaSlideInRight',
				'SalaSlideInUp',
				'SalaJump',
			);

			$sala_current_effect = $sala_animation = '';
            if ( !empty($settings['animation']) ) {
				$sala_animation = $settings['animation'];
            }elseif( !empty($settings['_animation']) ) {
				$sala_animation = $settings['_animation'];
			}

			if( !empty($sala_animation) ) {
				if( $sala_animation == 'SalaSlideInDown' ) {
					$sala_current_effect = 'sala-slide-in-down';
				}elseif( $sala_animation == 'SalaSlideInLeft' ) {
					$sala_current_effect = 'sala-slide-in-left';
				}elseif( $sala_animation == 'SalaSlideInRight' ) {
					$sala_current_effect = 'sala-slide-in-right';
				}elseif( $sala_animation == 'SalaSlideInUp' ) {
					$sala_current_effect = 'sala-slide-in-up';
				}elseif( $sala_animation == 'SalaJump' ) {
					$sala_current_effect = 'sala-jump';
				}

				if ( ! $is_static_render_mode && in_array($sala_animation, $sala_effect) ) {
					// Hide the element until the animation begins
					$element_base->add_render_attribute( '_wrapper', 'class', ['sala-elementor-loading', $sala_current_effect] );
				}
			}
		}
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since  1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {

		// Include Widget files.
		require_once SALA_ELEMENTOR_DIR . '/module-query.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/base.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/form/form-base.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/form/form-location.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/posts/posts-base.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/carousel/carousel-base.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/carousel/posts-carousel-base.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/carousel/static-carousel.php';

		require_once SALA_ELEMENTOR_DIR . '/widgets/accordion.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/atropos.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/button.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/circle-progress-chart.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/countdown.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/chart.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/google-map.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/heading.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/heading-typed.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/icon.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/icon-box.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/image-box.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/image-layers.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/image-gallery.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/image.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/banner.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/nav-menu.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/shapes.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/shape-divider.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/shape-blur.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/flip-box.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/instagram.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/attribute-list.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/gradation.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/timeline.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/list.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/pricing-table.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/toggle.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/twitter.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/team-member.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/site-logo.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/social-networks.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/popup-video.php';
		if( get_theme_mod('sala_portfolio', 0) ){
			require_once SALA_ELEMENTOR_DIR . '/widgets/portfolio-modern.php';
			require_once SALA_ELEMENTOR_DIR . '/widgets/portfolio-single.php';
		}
		if( get_theme_mod('sala_job', 0) ){
			require_once SALA_ELEMENTOR_DIR . '/widgets/job.php';
		}
		require_once SALA_ELEMENTOR_DIR . '/widgets/separator.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/table.php';

		require_once SALA_ELEMENTOR_DIR . '/widgets/grid/grid-base.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/grid/static-grid.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/grid/client-logo.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/grid/view-demo.php';

		require_once SALA_ELEMENTOR_DIR . '/widgets/posts/blog.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/posts/post-single.php';

		require_once SALA_ELEMENTOR_DIR . '/widgets/testimonial-grid.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/testimonial-stack.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/carousel/testimonial-carousel.php';

		require_once SALA_ELEMENTOR_DIR . '/widgets/carousel/team-member-carousel.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/carousel/image-carousel.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/carousel/modern-carousel.php';
		require_once SALA_ELEMENTOR_DIR . '/widgets/carousel/modern-slider.php';

		require_once SALA_ELEMENTOR_DIR . '/widgets/flickity/flickity-marquee.php';

		// Register Widgets.
		Plugin::instance()->widgets_manager->register( new Widget_Accordion() );
		Plugin::instance()->widgets_manager->register( new Widget_Atropos() );
		Plugin::instance()->widgets_manager->register( new Widget_Button() );
		Plugin::instance()->widgets_manager->register( new Widget_Client_Logo() );
		Plugin::instance()->widgets_manager->register( new Widget_Circle_Progress_Chart() );
		Plugin::instance()->widgets_manager->register( new Widget_Countdown() );
		Plugin::instance()->widgets_manager->register( new Widget_Chart() );
		Plugin::instance()->widgets_manager->register( new Widget_Content_Toggle() );
		Plugin::instance()->widgets_manager->register( new Widget_Form_Location() );
		Plugin::instance()->widgets_manager->register( new Widget_Google_Map() );
		Plugin::instance()->widgets_manager->register( new Widget_Heading() );
		Plugin::instance()->widgets_manager->register( new Widget_Heading_Typed() );
		Plugin::instance()->widgets_manager->register( new Widget_Icon() );
		Plugin::instance()->widgets_manager->register( new Widget_Icon_Box() );
		Plugin::instance()->widgets_manager->register( new Widget_Image_Box() );
		Plugin::instance()->widgets_manager->register( new Widget_Image_Layers() );
		Plugin::instance()->widgets_manager->register( new Widget_Image_Gallery() );
		Plugin::instance()->widgets_manager->register( new Widget_Image_Carousel() );
		Plugin::instance()->widgets_manager->register( new Widget_Image() );
		Plugin::instance()->widgets_manager->register( new Widget_Banner() );
		Plugin::instance()->widgets_manager->register( new Widget_Nav_Menu() );
		Plugin::instance()->widgets_manager->register( new Widget_Shapes() );
		Plugin::instance()->widgets_manager->register( new Widget_Shape_Divider() );
		Plugin::instance()->widgets_manager->register( new Widget_Shape_Blur() );
		Plugin::instance()->widgets_manager->register( new Widget_Modern_Carousel() );
		Plugin::instance()->widgets_manager->register( new Widget_Modern_Slider() );
		Plugin::instance()->widgets_manager->register( new Widget_Modern_Site_Logo() );
		Plugin::instance()->widgets_manager->register( new Widget_Instagram() );
		Plugin::instance()->widgets_manager->register( new Widget_Flip_Box() );
		Plugin::instance()->widgets_manager->register( new Widget_Blog() );
		Plugin::instance()->widgets_manager->register( new Widget_Post_Single() );
		Plugin::instance()->widgets_manager->register( new Widget_Attribute_List() );
		Plugin::instance()->widgets_manager->register( new Widget_List() );
		Plugin::instance()->widgets_manager->register( new Widget_Gradation() );
		Plugin::instance()->widgets_manager->register( new Widget_Timeline() );
		Plugin::instance()->widgets_manager->register( new Widget_Pricing_Table() );
		Plugin::instance()->widgets_manager->register( new Widget_Twitter() );
		Plugin::instance()->widgets_manager->register( new Widget_Team_Member() );
		Plugin::instance()->widgets_manager->register( new Widget_Team_Member_Carousel() );
		Plugin::instance()->widgets_manager->register( new Widget_Testimonial_Carousel() );
		Plugin::instance()->widgets_manager->register( new Widget_Testimonial_Grid() );
		Plugin::instance()->widgets_manager->register( new Widget_Testimonial_Stack() );
		Plugin::instance()->widgets_manager->register( new Widget_Social_Networks() );
		Plugin::instance()->widgets_manager->register( new Widget_Popup_Video() );
		if( get_theme_mod('sala_portfolio', 0) ){
			Plugin::instance()->widgets_manager->register( new Widget_Portfolio_Modern() );
			Plugin::instance()->widgets_manager->register( new Widget_Portfolio_Single() );
		}
		if( get_theme_mod('sala_job', 0) ){
			Plugin::instance()->widgets_manager->register( new Widget_Job() );
		}
		Plugin::instance()->widgets_manager->register( new Widget_Separator() );
		Plugin::instance()->widgets_manager->register( new Widget_Table() );
		Plugin::instance()->widgets_manager->register( new Widget_View_Demo() );

		Plugin::instance()->widgets_manager->register( new Widget_Flickity_Marquee() );

		/**
		 * Include & Register Dependency Widgets.
		 */

		if ( class_exists('WooCommerce') ) {
			require_once SALA_ELEMENTOR_DIR . '/widgets/posts/product.php';
			require_once SALA_ELEMENTOR_DIR . '/widgets/posts/product-list.php';
			require_once SALA_ELEMENTOR_DIR . '/widgets/carousel/product-carousel.php';
			require_once SALA_ELEMENTOR_DIR . '/widgets/carousel/product-carousel-countdown.php';
			require_once SALA_ELEMENTOR_DIR . '/widgets/product-categories.php';
			require_once SALA_ELEMENTOR_DIR . '/widgets/product-banner.php';

			Plugin::instance()->widgets_manager->register( new Widget_Product() );
			Plugin::instance()->widgets_manager->register( new Widget_Product_List() );
			Plugin::instance()->widgets_manager->register( new Widget_Product_Carousel() );
			Plugin::instance()->widgets_manager->register( new Widget_Product_Carousel_Countdown() );
			Plugin::instance()->widgets_manager->register( new Widget_Product_Categories() );
			Plugin::instance()->widgets_manager->register( new Widget_Product_Banner() );
		}

		if ( function_exists( 'mc4wp_get_forms' ) ) {
			require_once SALA_ELEMENTOR_DIR . '/widgets/form/mailchimp-form.php';

			Plugin::instance()->widgets_manager->register( new Widget_Mailchimp_Form() );
		}

		if ( defined( 'WPCF7_VERSION' ) ) {
			require_once SALA_ELEMENTOR_DIR . '/widgets/form/contact-form-7.php';

			Plugin::instance()->widgets_manager->register( new Widget_Contact_Form_7() );
		}
	}

	/**
	 * @param \Elementor\Widgets_Manager $widgets_manager
	 *
	 * Remove unwanted widgets
	 */
	function remove_unwanted_widgets( $widgets_manager ) {
		$elementor_widget_blacklist = array(
			'theme-site-logo',
		);

		foreach ( $elementor_widget_blacklist as $widget_name ) {
			$widgets_manager->unregister( $widget_name );
		}
	}

	public function sala_template_elementor($atts){
	    if(!class_exists('Elementor\Plugin')){
	        return '';
	    }
	    if(!isset($atts['id']) || empty($atts['id'])){
	        return '';
	    }

	    $post_id = $atts['id'];
	    $response = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($post_id);
	    return $response;
	}
}

Widget_Init::instance()->initialize();
