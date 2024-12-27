<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Sala_Portfolio' ) ) {

	class Sala_Portfolio {

		protected static $instance  = null;
		protected static $post_type = 'portfolio';
		protected static $tag       = 'portfolio_tags';
		protected static $category  = 'portfolio_category';

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self:: $instance;
		}

		public function initialize() {
			if( get_theme_mod('sala_portfolio', 0) ) {
				$this->register_post_type();
				$this->register_taxonomy_category();
				$this->register_taxonomy_tag();
			}

			add_action( 'wp_ajax_portfolio_infinite_load', array( $this, 'infinite_load' ) );
			add_action( 'wp_ajax_nopriv_portfolio_infinite_load', array( $this, 'infinite_load' ) );
		}

		protected function register_post_type() {
			$labels = array(
				'name'               => __( 'Portfolios', 'sala' ),
				'singular_name'      => __( 'Portfolio', 'sala' ),
				'add_new'            => __( 'Add New', 'sala' ),
				'add_new_item'       => __( 'Add New', 'sala' ),
				'edit_item'          => __( 'Edit Portfolio', 'sala' ),
				'new_item'           => __( 'Add New Portfolio', 'sala' ),
				'view_item'          => __( 'View Portfolio', 'sala' ),
				'search_items'       => __( 'Search Portfolio', 'sala' ),
				'not_found'          => __( 'No items found', 'sala' ),
				'not_found_in_trash' => __( 'No items found in trash', 'sala' ),
			);

			$args = array(
				'menu_icon' => 'dashicons-portfolio',
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
				'rewrite'           => array( 'slug' => 'portfolio', 'with_front' => false ),
				'capability_type' 	=> 'page',
				'menu_position'   	=> 5,
				'hierarchical'    	=> true,
				'has_archive'     	=> true,
				'show_in_rest' 		=> true,
			);

			$args = apply_filters( 'portfolio_args', $args );
			register_post_type( 'portfolio', $args );
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
				'rewrite'           => array( 'slug' => 'portfolio_tag', 'with_front' => false ),
				'show_admin_column' => true,
				'query_var'         => true,
				'show_in_rest' 		=> true,
			);

			$args = apply_filters( 'portfolio_tag_args', $args );
			register_taxonomy( 'portfolio_tag', array( 'portfolio' ), $args );

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
				'rewrite'           => array( 'slug' => 'portfolio_category', 'with_front' => false ),
				'show_admin_column' => true,
				'query_var'         => true,
				'show_in_rest' 		=> true,
			);

			$args = apply_filters( 'portfolio_category_args', $args );

			register_taxonomy( 'portfolio_category', array( 'portfolio' ), $args );

			if( Sala_Helper::setting('portfolio_page') ){
				add_action( 'wp_loaded', 'add_portfolio_permastructure' );
				function add_portfolio_permastructure() {
					$items_link = Sala_Helper::setting('portfolio_page');
					add_permastruct( 'portfolio_category',  $items_link.'/%portfolio_category%', false );
					add_permastruct( 'portfolio', $items_link.'/%portfolio_category%/%portfolio%', false );
				}

				add_filter( 'post_type_link', 'portfolio_permalinks', 10, 2 );
				function portfolio_permalinks( $permalink, $post ) {
					if ( $post->post_type !== 'portfolio' )
						return $permalink;

					$terms = get_the_terms( $post->ID, 'portfolio_category' );

					if ( ! $terms )
						return str_replace( '/%portfolio_category%', '', $permalink );

					$post_terms = array();
					foreach ( $terms as $term )
						$post_terms[] = $term->slug;

					return str_replace( '%portfolio_category%', implode( ',', $post_terms ) , $permalink );
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

			$response['layout'] = $settings['layout'];

			ob_start();

			if( $widget_query && !empty($settings) ) {

				if ( $sala_query->have_posts() ) :

					set_query_var( 'sala_query', $sala_query );
					set_query_var( 'settings', $settings );

					get_template_part( 'templates/loop/widgets/portfolio/content', $settings['layout'] );

					wp_reset_postdata();

				endif;

			} else {
				if ( $sala_query->have_posts() ) :

					while ( $sala_query->have_posts() ) : $sala_query->the_post();

						get_template_part( 'templates/loop/portfolio/content', $settings['layout'] );

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

		function get_categories( $args = array() ) {
			$defaults = array(
				'all' => true,
			);
			$args  = wp_parse_args( $args, $defaults );
			$terms = get_terms( array(
				'taxonomy' => self::$category,
			) );
			$results = array();

			if ( $args['all'] === true ) {
				$results['-1'] = esc_html__( 'All', 'sala' );
			}

			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					$results[ $term->slug ] = $term->name;
				}
			}

			return $results;
		}

		public static function portfolio_taxonomy() {
			ob_start();
			$count_posts  = wp_count_posts( 'portfolio' );
			$tax_id  = '';

			$portfolio_archive_display_taxonomy       = Sala_Helper::setting( 'portfolio_archive_display_taxonomy' );
			$portfolio_archive_display_count_taxonomy = Sala_Helper::setting( 'portfolio_archive_display_count_taxonomy' );

			if( is_tax() )
			{
				$current_tax 	 = get_term_by('slug', get_query_var( 'term' ), 'portfolio_category');
				$tax_id 	 	 = $current_tax->term_id;
			}

			$taxonomy  = get_terms( array(
				'taxonomy' 	   => 'portfolio_category',
				'orderby'      => 'count',
				'order'        => 'DESC',
				'parent'       => 0,
				'hide_empty'   => true,
				'hierarchical' => true,
			) );

			if( $taxonomy && $portfolio_archive_display_taxonomy == 'show' ) : ?>
				<div class="sala-portfolio-taxonomy">
					<ul class="list-taxonomy">
						<li <?php if( is_front_page() && is_home() ) : echo esc_attr('class=active');endif; ?>>
							<a href="<?php echo get_post_type_archive_link('portfolio'); ?>">
								<span class="entry-name"><?php esc_html_e('All ', 'sala'); ?></span>
								<?php if( $portfolio_archive_display_count_taxonomy == 'show' ) : ?>
									<span class="entry-count"><?php echo sprintf( esc_html__( '(%s)', 'sala' ), $count_posts->publish ); ?></span>
								<?php endif; ?>
							</a>
						</li>
						<?php
						foreach( $taxonomy as $tax ) {
							$tax_link = get_term_link( $tax->term_id );
						?>
							<li <?php if( $tax_id == $tax->term_id ) : echo esc_attr('class=active');endif; ?>>
								<a href="<?php echo esc_url($tax_link); ?>">
									<span class="entry-name"><?php echo esc_html($tax->name); ?></span>
									<?php if( $portfolio_archive_display_count_taxonomy == 'show' ) : ?>
										<span class="entry-count"><?php echo sprintf( esc_html__( '(%s)', 'sala' ), $tax->count ); ?></span>
									<?php endif; ?>
								</a>
							</li>
						<?php } ?>
					</ul>
				</div>
			<?php endif;

			return ob_get_clean();
		}

		function get_tags( $args = array() ) {
			$defaults = array(
				'all' => true,
			);
			$args  = wp_parse_args( $args, $defaults );
			$terms = get_terms( array(
				'taxonomy' => self::$tag,
			) );
			$results = array();

			if ( $args['all'] === true ) {
				$results['-1'] = esc_html__( 'All', 'sala' );
			}

			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					$results[ $term->slug ] = $term->name;
				}
			}

			return $results;
		}

		function get_related_items( $args ) {
			$defaults = array(
				'post_id'      => '',
				'number_posts' => 3,
			);
			$args = wp_parse_args( $args, $defaults );
			if ( $args['number_posts'] <= 0 || $args['post_id'] === '' ) {
				return false;
			}
			$query_args              = array(
				'post_type'      => self::$post_type,
				'orderby'        => 'date',
				'order'          => 'DESC',
				'posts_per_page' => $args['number_posts'],
				'post__not_in'   => array( $args['post_id'] ),
				'no_found_rows'  => true,
			);
			            $related_by  = Sala_Helper::setting( 'portfolio_related_by' );
			$query_args['tax_query'] = array();
			if ( ! empty( $related_by ) ) {
				foreach ( $related_by as $tax ) {
					$terms = get_the_terms( $args['post_id'], $tax );
					if ( $terms && ! is_wp_error( $terms ) ) {
						$term_ids = array();
						foreach ( $terms as $term ) {
							$term_ids[] = $term->term_id;
						}
						$query_args['tax_query'][] = array(
							'terms'    => $term_ids,
							'taxonomy' => $tax,
						);
					}
				}
				if ( count( $query_args['tax_query'] ) > 1 ) {
					$query_args['tax_query']['relation'] = 'OR';
				}
			}

			$query = new WP_Query( $query_args );

			wp_reset_postdata();

			return $query;
		}

		/**
		 * Check if current page is category or tag pages
		 */
		function is_taxonomy() {
			return is_tax( get_object_taxonomies( self::$post_type ) );
		}

		/**
		 * Check if current page is tag pages
		 */
		function is_tag() {
			return is_tax( self::$tag );
		}

		/**
		 * Check if current page is category pages
		 */
		function is_category() {
			return is_tax( self::$category );
		}

		/**
		 * Check if current page is archive pages
		 */
		function is_archive() {
			return $this->is_taxonomy() || is_post_type_archive( self::$post_type );
		}

		function has_tag() {
			if ( has_term( '', self::$tag ) ) {
				return true;
			}

			return false;
		}

		function has_category() {
			if ( has_term( '', self::$category ) ) {
				return true;
			}

			return false;
		}

		function get_the_post_meta( $name = '', $default = '' ) {
			$post_meta = get_post_meta( get_the_ID(), 'uxper_portfolio_options', true );

			if ( ! empty( $post_meta ) ) {
				//$post_options = unserialize( $post_meta );
				$post_options = maybe_unserialize( $post_meta );

				if ( $post_options !== false && isset( $post_options[ $name ] ) ) {
					return $post_options[ $name ];
				}
			}

			return $default;
		}

		function get_the_permalink() {
			$url = get_the_permalink();

			if ( Sala_Helper::setting( 'archive_portfolio_external_url' ) === '1' ) {
				$_url = $this->get_the_post_meta( 'portfolio_url', '' );

				if ( $_url !== '' ) {
					$url = $_url;
				}
			}

			return $url;
		}

		function the_permalink() {
			$url = $this->get_the_permalink();

			echo esc_url( $url );
		}

		function the_categories() {
			?>
			<div class = "post-categories">
				<?php echo get_the_term_list( get_the_ID(), self::$category, '', ', ', '' ); ?>
			</div>
			<?php
		}

		function the_categories_no_link( $args = array() ) {
			$defaults = array(
				'classes' => 'post-categories',
			);
			$args = wp_parse_args( $args, $defaults );

			$terms = get_the_terms( get_the_ID(), self::$category );

			if ( is_array( $terms ) ) { ?>
				<div class = "<?php echo esc_attr( $args['classes'] ); ?>">
					<?php
					$separator = ', ';
					$count     = 0;
					$temp      = '';
					foreach ( $terms as $term ) {
						if ( $count > 0 ) {
							$temp .= $separator;
						}

						$temp .= $term->name;

						$count++;
					}

					echo esc_html( $temp );
					?>
				</div>
				<?php
			}
		}

		function entry_video( $args = array() ) {
			$defaults = array(
				'position' => 'above',
			);
			$args = wp_parse_args( $args, $defaults );

			$url 		= Sala_Helper::get_post_meta( 'portfolio_video_url', '' );
			$thumbnail 	= Sala_Helper::get_post_meta( 'portfolio_video_thumbnail', '' );

			if ( $url === '' ) {
				return;
			}

			if( $thumbnail == '' ){
				$thumbnail = SALA_THEME_URI . '/assets/images/no-image.jpg';
			}

			$embed = wp_oembed_get( $url );
            $embed = str_replace( 'frameborder="0"', '', $embed );
			if ( $embed === false ) {
				return;
			}

			$wrap_classes = 'entry-portfolio-video';
			$wrap_classes .= " {$args['position']}";
			?>
			<div class = "<?php echo esc_attr( $wrap_classes ); ?>">
				<?php echo '<div class="thumb-preview"><a href="#embed-popup" class="btn-sala-popup icon"><i class="fas fa-play"></i></a><img class="thumb" src="' . $thumbnail  . '" alt="" /></div><div class="sala-popup" id="embed-popup"><div class="bg-overlay"></div><div class="embed-responsive-16by9 embed-responsive">' . $embed . '</div></div>'; ?>
			</div>
			<?php
		}

		function entry_categories() {
			?>
			<div class = "entry-portfolio-categories">
				<?php echo get_the_term_list( get_the_ID(), self::$category, '<div>', '</div><div>', '</div>' ); ?>
			</div>
			<?php
		}

		function entry_details() {
			$client      = $this->get_the_post_meta( 'portfolio_client', '' );
			$date        = $this->get_the_post_meta( 'portfolio_date', '' );
			$cats_enable = Sala_Helper::setting( 'single_portfolio_categories_enable' );
			$tags_enable = Sala_Helper::setting( 'single_portfolio_tags_enable' );
			?>
			<div class = "entry-portfolio-details">
				<?php if ( $date !== '' ): ?>
					<div class = "entry-portfolio-date">
					<h5  class = "label"><?php esc_html_e( 'Date', 'sala' ); ?></h5>
					<div class = "value"><?php echo esc_html( $date ); ?></div>
					</div>
				<?php endif; ?>

				<?php if ( $client !== '' ): ?>
					<div class = "entry-portfolio-client">
					<h5  class = "label"><?php esc_html_e( 'Client', 'sala' ); ?></h5>
					<div class = "value"><?php echo esc_html( $client ); ?></div>
					</div>
				<?php endif; ?>

				<?php if ( $cats_enable === '1' && $this->has_category() ): ?>
					<div class = "entry-portfolio-categories">
					<h5  class = "label"><?php esc_html_e( 'Category', 'sala' ); ?></h5>
					<div class = "value">
							<?php echo get_the_term_list( get_the_ID(), self::$category, '<div>', '</div><div>', '</div>' ); ?>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( $tags_enable === '1' && $this->has_tag() ): ?>
					<div class = "entry-portfolio-tags">
					<h5  class = "label"><?php esc_html_e( 'Tags', 'sala' ); ?></h5>
					<div class = "value">
							<?php echo get_the_term_list( get_the_ID(), self::$tag, '', ', ', '' ); ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<?php
		}
	}

	Sala_Portfolio::instance()->initialize();
}
