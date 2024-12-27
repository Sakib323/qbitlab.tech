<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Sala_Footer' ) ) {

	class Sala_Footer {

		protected static $instance  = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self:: $instance;
		}

		public function initialize() {
			$this->register_post_type();
			add_post_type_support( 'sala_footer', 'elementor' );
		}

		protected function register_post_type() {
			$labels = array(
				'name'               => __( 'Footer', 'sala' ),
				'singular_name'      => __( 'Footer', 'sala' ),
				'add_new'            => __( 'Add New', 'sala' ),
				'add_new_item'       => __( 'Add New', 'sala' ),
				'edit_item'          => __( 'Edit Footer', 'sala' ),
				'new_item'           => __( 'Add New Footer', 'sala' ),
				'view_item'          => __( 'View Footer', 'sala' ),
				'search_items'       => __( 'Search Footer', 'sala' ),
				'not_found'          => __( 'No items found', 'sala' ),
				'not_found_in_trash' => __( 'No items found in trash', 'sala' ),
			);

			$args = array(
				'menu_icon' => 'dashicons-arrow-down-alt',
				'labels'    => $labels,
				'public'    => true,
				'supports'  => array(
					'title',
					'editor',
					'author',
				),
				'capability_type'    => 'page',
				'menu_position'      => 4,
				'show_ui'            => true,
				'hierarchical'       => false,
				'has_archive'        => false,
				'can_export'         => true,
				'has_archive'        => false,
				'rewrite'            => false,
				'publicly_queryable' => true,     // Enable TRUE for Elementor Editing
			);

			$args = apply_filters( 'footer_args', $args );
			register_post_type( 'sala_footer', $args );
		}
	}

	Sala_Footer::instance()->initialize();
}
