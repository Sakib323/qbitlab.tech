<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Sala_Job' ) ) {

	class Sala_Job {

		protected static $instance  = null;
		protected static $post_type = 'job';
		protected static $tag       = 'job_tags';
		protected static $category  = 'job_category';

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self:: $instance;
		}

		public function initialize() {
			if( get_theme_mod('sala_job', 0) ) {
				$this->register_post_type();
				$this->register_taxonomy_category();
				$this->register_taxonomy_tag();
			}

			add_action( 'wp_ajax_job_infinite_load', array( $this, 'infinite_load' ) );
			add_action( 'wp_ajax_nopriv_job_infinite_load', array( $this, 'infinite_load' ) );
		}

		protected function register_post_type() {
			$labels = array(
				'name'               => __( 'Jobs', 'sala' ),
				'singular_name'      => __( 'Job', 'sala' ),
				'add_new'            => __( 'Add New', 'sala' ),
				'add_new_item'       => __( 'Add New', 'sala' ),
				'edit_item'          => __( 'Edit job', 'sala' ),
				'new_item'           => __( 'Add New job', 'sala' ),
				'view_item'          => __( 'View job', 'sala' ),
				'search_items'       => __( 'Search job', 'sala' ),
				'not_found'          => __( 'No items found', 'sala' ),
				'not_found_in_trash' => __( 'No items found in trash', 'sala' ),
			);

			$args = array(
				'menu_icon' => 'dashicons-id-alt',
				'labels'    => $labels,
				'public'    => true,
				'supports'  => array(
					'title',
					'editor',
					'post-formats',
					'excerpt',
					'thumbnail',
					'comments',
					'author',
					'custom-fields',
					'revisions',
				),
				'rewrite'           => array( 'slug' => 'job', 'with_front' => false ),
				'capability_type' => 'page',
				'menu_position'   => 5,
				'hierarchical'    => true,
				'has_archive'     => true,
				'show_in_rest' 		=> true,
			);

			$args = apply_filters( 'job_args', $args );
			register_post_type( 'job', $args );
		}

		public function infinite_load() {
			$layout          = isset( $_POST['layout'] ) ? $_POST['layout'] : '';
			$query_vars      = isset( $_POST['query_vars'] ) ? $_POST['query_vars'] : '';
			$pagination_type = isset( $_POST['pagination_type'] ) ? $_POST['pagination_type'] : '';
			$widget_query    = isset( $_POST['widget_query'] ) ? $_POST['widget_query'] : '';
			$settings        = isset( $_POST['settings'] ) ? $_POST['settings'] : '';

			$query_vars['no_found_rows'] = false;
			$query_vars['nopaging'] = false;

			$sala_query = new WP_Query( $query_vars );

			$response = array(
				'max_num_pages' => $sala_query->max_num_pages,
				'found_posts'   => $sala_query->found_posts,
				'count'         => $sala_query->post_count,
			);

			if( !empty($settings['pagination_type']) ) {
				$pagination_type = $settings['pagination_type'];
			}

			if( $pagination_type == 'navigation' ) {
				$links = paginate_links( array(
					'total'     => $sala_query->max_num_pages,
					'current'   => $query_vars['paged'],
					'prev_text' => '<i class="far fa-long-arrow-left"></i>' . esc_html__('Prev', 'sala'),
					'next_text' => esc_html__('Next', 'sala') . '<i class="far fa-long-arrow-right"></i>',
					'type'      => 'list',
					'end_size'  => 1,
					'mid_size'  => 1,
				) );
				$pagination = wp_kses($links, Sala_Helper::sala_kses_allowed_html());
				$response['pagination'] = $pagination;
            }

			ob_start();

			if( $widget_query && !empty($settings) ) {

				if ( $sala_query->have_posts() ) :

					set_query_var( 'sala_query', $sala_query );
					set_query_var( 'settings', $settings );

					get_template_part( 'templates/loop/widgets/job/content', $settings['layout'] );

					wp_reset_postdata();

				endif;

			} else {
				if ( $sala_query->have_posts() ) :

					while ( $sala_query->have_posts() ) : $sala_query->the_post();

						get_template_part( 'templates/loop/job/content', $settings['layout'] );

					endwhile;

					wp_reset_postdata();
				endif;
            }

			$template = ob_get_contents();
			ob_clean();

			$response['template'] = $template;

			echo json_encode( $response );

			wp_die();
		}

		/**
		 * Register a taxonomy for Featured Item Tags.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
		 */
		protected function register_taxonomy_tag() {
			$labels = array(
				'name'                       => __( 'Tags', 'sala' ),
				'singular_name'              => __( 'Tag', 'sala' ),
				'menu_name'                  => __( 'Tags', 'sala' ),
				'edit_item'                  => __( 'Edit Tag', 'sala' ),
				'update_item'                => __( 'Update Tag', 'sala' ),
				'add_new_item'               => __( 'Add New Tag', 'sala' ),
				'new_item_name'              => __( 'New  Tag Name', 'sala' ),
				'parent_item'                => __( 'Parent Tag', 'sala' ),
				'parent_item_colon'          => __( 'Parent Tag:', 'sala' ),
				'all_items'                  => __( 'All Tags', 'sala' ),
				'search_items'               => __( 'Search  Tags', 'sala' ),
				'popular_items'              => __( 'Popular Tags', 'sala' ),
				'separate_items_with_commas' => __( 'Separate tags with commas', 'sala' ),
				'add_or_remove_items'        => __( 'Add or remove tags', 'sala' ),
				'choose_from_most_used'      => __( 'Choose from the most used tags', 'sala' ),
				'not_found'                  => __( 'No  tags found.', 'sala' ),
			);

			$args = array(
				'labels'            => $labels,
				'public'            => true,
				'show_in_nav_menus' => true,
				'show_ui'           => true,
				'show_tagcloud'     => true,
				'hierarchical'      => false,
				'rewrite'           => array( 'slug' => 'job_tag', 'with_front' => false ),
				'show_admin_column' => true,
				'query_var'         => true,
				'show_in_rest' 		=> true,
			);

			$args = apply_filters( 'job_tag_args', $args );
			register_taxonomy( 'job_tag', array( 'job' ), $args );

		}

		/**
		 * Register a taxonomy for Featured Item Categories.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
		 */
		protected function register_taxonomy_category() {
			$labels = array(
				'name'                       => __( 'Categories', 'sala' ),
				'singular_name'              => __( 'Category', 'sala' ),
				'menu_name'                  => __( 'Categories', 'sala' ),
				'edit_item'                  => __( 'Edit Category', 'sala' ),
				'update_item'                => __( 'Update Category', 'sala' ),
				'add_new_item'               => __( 'Add New Category', 'sala' ),
				'new_item_name'              => __( 'New Category Name', 'sala' ),
				'parent_item'                => __( 'Parent Category', 'sala' ),
				'parent_item_colon'          => __( 'Parent Category:', 'sala' ),
				'all_items'                  => __( 'All Categories', 'sala' ),
				'search_items'               => __( 'Search Categories', 'sala' ),
				'popular_items'              => __( 'Popular Categories', 'sala' ),
				'separate_items_with_commas' => __( 'Separate categories with commas', 'sala' ),
				'add_or_remove_items'        => __( 'Add or remove categories', 'sala' ),
				'choose_from_most_used'      => __( 'Choose from the most used categories', 'sala' ),
				'not_found'                  => __( 'No categories found.', 'sala' ),
			);

			$args = array(
				'labels'            => $labels,
				'public'            => true,
				'show_in_nav_menus' => true,
				'show_ui'           => true,
				'show_tagcloud'     => true,
				'hierarchical'      => true,
				'rewrite'           => array( 'slug' => 'job_category', 'with_front' => false ),
				'show_admin_column' => true,
				'query_var'         => true,
				'show_in_rest' 		=> true,
			);

			$args = apply_filters( 'job_category_args', $args );

			register_taxonomy( 'job_category', array( 'job' ), $args );

			if( Sala_Helper::setting('job_page') ){
				add_action( 'wp_loaded', 'add_job_permastructure' );
				function add_job_permastructure() {
					$items_link = Sala_Helper::setting('job_page');
					add_permastruct( 'job_category',  $items_link.'/%job_category%', false );
					add_permastruct( 'job', $items_link.'/%job_category%/%job%', false );
				}

				add_filter( 'post_type_link', 'job_permalinks', 10, 2 );
				function job_permalinks( $permalink, $post ) {
					if ( $post->post_type !== 'job' )
						return $permalink;

					$terms = get_the_terms( $post->ID, 'job_category' );

					if ( ! $terms )
						return str_replace( '/%job_category%', '', $permalink );

					$post_terms = array();
					foreach ( $terms as $term )
						$post_terms[] = $term->slug;

					return str_replace( '%job_category%', implode( ',', $post_terms ) , $permalink );
				}

				// Helper function to get all parents of a term
				function get_term_parents( $term, &$parents = array() ) {
					$parent = get_term( $term->parent, $term->taxonomy );

					if ( is_wp_error( $parent ) )
						return $parents;

					$parents[] = $parent;

					if ( $parent->parent )
						get_term_parents( $parent, $parents );

					return $parents;
				}

			} // Set custom permalinks
		}
	}

	Sala_job::instance()->initialize();
}
