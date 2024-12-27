<?php

// Exit if accessed directly.
if ( !defined('ABSPATH') ) {
	exit;
}

/**
 * Initial setup for this theme
 *
 */
class Sala_Setup {

	/**
	 * The constructor.
	 */
	function __construct() {

		// Load the theme's textdomain.
		add_action( 'after_setup_theme', array( $this, 'load_theme_textdomain' ) );

		// Add theme supports.
		add_action( 'after_setup_theme', array( $this, 'add_theme_supports' ) );

		// Register nav menu.
		add_action( 'after_setup_theme', array( $this, 'register_nav_menus' ) );

		// Register widget areas.
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );

		// Support editor style.
		add_editor_style(array('/assets/css/editor-style.css'));
	}

	/**
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 *
	 * @access public
	 */
	public function load_theme_textdomain() {
		load_theme_textdomain( 'sala', SALA_THEME_DIR . '/languages' );
	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @access public
	 */
	function add_theme_supports() {
		// Adjust the content-width.
		if ( ! isset( $content_width ) ) $content_width = 640;

		/*
		 * Add default posts and comments RSS feed links to head.
		 */
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'gallery', 'audio' ) );

		/*
		 * Set up the WordPress core custom background feature.
		 */
		add_theme_support( 'custom-background', apply_filters( 'custom_background_args', array( 'default-color' => '#fff', 'default-image' => '' ) ) );

		/*
		 * Support woocommerce
		 */
		add_theme_support( 'woocommerce' );

		// Support gallery.
		add_theme_support( 'wc-product-gallery-zoom' );

		// Support gallery lightbox.
		add_theme_support( 'wc-product-gallery-lightbox' );

		/*
		 * Support selective refresh for widget
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Support Uxper Plugins
		 */
		add_theme_support( 'uxper-metabox' );
		add_theme_support( 'uxper-kungfu' );
	}

	/**
	 * Register nav menu.
	 */
	function register_nav_menus() {
		register_nav_menus( array(
			'main_menu' => esc_html__( 'Main Menu', 'sala' ),
		) );

		register_nav_menus( array(
			'main_menu_02' => esc_html__( 'Main Menu 02', 'sala' ),
		) );

		register_nav_menus( array(
			'landing_menu' => esc_html__( 'Landing Menu', 'sala' ),
		) );

	    register_nav_menus(array(
	        'mobile_menu' => esc_html__('Mobile Menu', 'sala'),
		));
	}

	/**
	 * Register widget area.
	 *
	 * @access public
	 * @link   https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function widgets_init() {
		register_sidebar( array(
			'id'            => 'blog_sidebar',
			'name'          => esc_html__( 'Blog Sidebar', 'sala' ),
			'description'   => esc_html__( 'Add widgets here.', 'sala' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'id'            => 'portfolio_sidebar',
			'name'          => esc_html__( 'Portfolio Sidebar', 'sala' ),
			'description'   => esc_html__( 'Add widgets here.', 'sala' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'id'            => 'page_sidebar',
			'name'          => esc_html__( 'Page Sidebar', 'sala' ),
			'description'   => esc_html__( 'Add widgets here.', 'sala' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'id'            => 'shop_sidebar',
			'name'          => esc_html__( 'Shop Sidebar', 'sala' ),
			'description'   => esc_html__( 'Add widgets here.', 'sala' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
}

new Sala_Setup();

