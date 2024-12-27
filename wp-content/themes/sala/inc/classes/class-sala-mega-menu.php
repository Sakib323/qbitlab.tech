<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Sala_Mega_Menu' ) ) {
	class Sala_Mega_Menu {

		protected static $instance = null;

		static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self:: $instance;
		}

		public function initialize() {
			add_action( 'init', array( $this, 'register_mega_menu') );
			add_post_type_support( 'sala_mega_menu', 'elementor' );
		}

		/**
		 * Register Mega_Menu Post Type
		 */
		function register_mega_menu() {

			$labels = array(
				'name'               => _x( 'Mega Menus', 'Post Type General Name', 'sala' ),
				'singular_name'      => _x( 'Mega Menus', 'Post Type Singular Name', 'sala' ),
				'menu_name'          => esc_html__( 'Mega Menu', 'sala' ),
				'name_admin_bar'     => esc_html__( 'Mega Menu', 'sala' ),
				'parent_item_colon'  => esc_html__( 'Parent Menu:', 'sala' ),
				'all_items'          => esc_html__( 'All Menus', 'sala' ),
				'add_new_item'       => esc_html__( 'Add New Menu', 'sala' ),
				'add_new'            => esc_html__( 'Add New', 'sala' ),
				'new_item'           => esc_html__( 'New Menu', 'sala' ),
				'edit_item'          => esc_html__( 'Edit Menu', 'sala' ),
				'update_item'        => esc_html__( 'Update Menu', 'sala' ),
				'view_item'          => esc_html__( 'View Menu', 'sala' ),
				'search_items'       => esc_html__( 'Search Menu', 'sala' ),
				'not_found'          => esc_html__( 'Not found', 'sala' ),
				'not_found_in_trash' => esc_html__( 'Not found in Trash', 'sala' ),
			);

			$args = array(
				'label'       => esc_html__( 'Mega Menus', 'sala' ),
				'description' => esc_html__( 'Mega Menus', 'sala' ),
				'labels'      => $labels,
				'supports'    => array(
					'title',
					'editor',
					'revisions',
				),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 3,
				'menu_icon'           => 'dashicons-menu-alt',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => false,
				'exclude_from_search' => true,
				'publicly_queryable'  => false,
				'rewrite'             => false,
				'capability_type'     => 'page',
				'publicly_queryable'  => true, // Enable TRUE for Elementor Editing
			);

			register_post_type( 'sala_mega_menu', $args );

		}
	}

	Sala_Mega_Menu:: instance()->initialize();
}
