<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Sala_Post' ) ) {

	class Sala_Post {

		protected static $instance  = null;
		protected static $post_type = 'post';

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function initialize() {
			add_filter( 'post_class', array( $this, 'post_class' ) );
			add_action( 'wp_ajax_post_infinite_load', array( $this, 'infinite_load' ) );
			add_action( 'wp_ajax_nopriv_post_infinite_load', array( $this, 'infinite_load' ) );

			function is_blog () {
				return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type();
			}
		}

		function post_class( $classes ) {
			$blog_content_post_card     			= Sala_Helper::setting('blog_content_post_card');
			$blog_content_post_box     				= Sala_Helper::setting('blog_content_post_box');
			$blog_content_post_box_background     	= Sala_Helper::setting('blog_content_post_box_background');
			$portfolio_content_post_card     		= Sala_Helper::setting('portfolio_content_post_card');
			$portfolio_content_post_box     		= Sala_Helper::setting('portfolio_content_post_box');
			$portfolio_content_post_box_background  = Sala_Helper::setting('portfolio_content_post_box_background');

			if ( ! has_post_thumbnail() ) {
				$classes[] = 'post-no-thumbnail';
			}

			if ( is_sticky() ) {
				$classes[] = 'sticky';
			}

			$post_type = get_post_type();

			switch ( $post_type ) {
				case 'post':
					if ( $blog_content_post_card == 'show' ) {
						$classes[] = 'sala-blog-card';
					}

					if ( $blog_content_post_box == 'show' ) {
						$classes[] = 'sala-blog-boxed';
					}

					if ( $blog_content_post_box_background == 'show' ) {
						$classes[] = 'sala-blog-background';
					}

					break;

				case 'portfolio':

					if ( $portfolio_content_post_card === 'show' ) {
						$classes[] = 'sala-portfolio-card';
					}

					if ( $portfolio_content_post_box === 'show' ) {
						$classes[] = 'sala-portfolio-box';
					}

					if ( $portfolio_content_post_box_background === 'show' ) {
						$classes[] = 'sala-portfolio-box-background';
					}

					break;

				default:

					break;
			}

			return $classes;
		}

		public function is_archive() {
			return ( is_archive() || is_author() || is_category() || is_home() || is_tag() ) && 'post' == get_post_type();
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

					get_template_part( 'templates/loop/widgets/blog/content', $settings['layout'] );

					wp_reset_postdata();

				endif;

			} else {
				if ( $sala_query->have_posts() ) :

					while ( $sala_query->have_posts() ) : $sala_query->the_post();

						get_template_part( 'templates/loop/blog/content-' . $layout );

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

		function get_related_posts( $args ) {
			$defaults = array(
				'post_id'      => '',
				'number_posts' => 3,
			);
			$args = wp_parse_args( $args, $defaults );
			if ( $args['number_posts'] <= 0 || $args['post_id'] === '' ) {
				return false;
			}

			$categories = get_the_category( $args['post_id'] );

			if ( ! $categories ) {
				return false;
			}

			foreach ( $categories as $category ) {
				if ( $category->parent === 0 ) {
					$term_ids[] = $category->term_id;
				} else {
					$term_ids[] = $category->parent;
					$term_ids[] = $category->term_id;
				}
			}

			// Remove duplicate values from the array.
			$unique_array = array_unique( $term_ids );

			$query_args = array(
				'post_type'      => self::$post_type,
				'orderby'        => 'date',
				'order'          => 'DESC',
				'posts_per_page' => $args['number_posts'],
				'post__not_in'   => array( $args['post_id'] ),
				'no_found_rows'  => true,
				'tax_query'      => array(
					array(
						'taxonomy'         => 'category',
						'terms'            => $unique_array,
						'include_children' => false,
					),
				),
			);

			$query = new WP_Query( $query_args );

			wp_reset_postdata();

			return $query;
		}

		function get_the_post_meta( $name = '', $default = '' ) {
			$post_meta = get_post_meta( get_the_ID(), 'sala_post_options', true );

			if ( ! empty( $post_meta ) ) {
				$post_options = maybe_unserialize( $post_meta );

				if ( $post_options !== false && isset( $post_options[ $name ] ) ) {
					return $post_options[ $name ];
				}
			}

			return $default;
		}

		function get_the_post_format() {
			$format = '';
			if ( get_post_format() !== false ) {
				$format = get_post_format();
			}

			return $format;
		}

		function the_categories( $args = array() ) {
			if ( ! has_category() ) {
				return;
			}

			$defaults = array(
				'classes'    => 'post-categories',
				'separator'  => ', ',
				'show_links' => true,
				'single'     => true,
			);
			$args     = wp_parse_args( $args, $defaults );
			?>
			<div class="<?php echo esc_attr( $args['classes'] ); ?>">
				<?php
				$categories = get_the_category();
				$loop_count = 0;
				foreach ( $categories as $category ) {
					if ( $loop_count > 0 ) {
						echo "{$args['separator']}";
					}

					if ( true === $args['show_links'] ) {
						printf(
							'<a href="%1$s"><span>%2$s</span></a>',
							esc_url( get_category_link( $category->term_id ) ),
							$category->name
						);
					} else {
						echo "<span>{$category->name}</span>";
					}

					$loop_count++;

					if ( true === $args['single'] ) {
						break;
					}
				}
				?>
			</div>
			<?php
		}

		public static function blog_categories() {
			ob_start();
			$count_posts  = wp_count_posts();
			$category_id  = '';

			$blog_archive_display_categories       = Sala_Helper::setting( 'blog_archive_display_categories' );
			$blog_archive_display_count_categories = Sala_Helper::setting( 'blog_archive_display_count_categories' );

			if( is_category() )
			{
				$cate  		 = get_category( get_query_var( 'cat' ) );
				$category_id = $cate->cat_ID;
			}
			$categories  = get_categories( array(
				'orderby'      => 'count',
				'order'        => 'DESC',
				'number' 	   => 4,
				'parent'       => 0,
				'hide_empty'   => true,
				'hierarchical' => true,
			) );

			if( $categories && $blog_archive_display_categories == 'show' ) : ?>
				<div class="sala-blog-categories">
					<ul class="list-categories">
						<li <?php if( is_front_page() && is_home() ) : echo esc_attr('class=active');endif; ?>>
							<a href="<?php echo get_post_type_archive_link('post'); ?>">
								<span class="entry-name"><?php esc_html_e('All ', 'sala'); ?></span>
								<?php if( $blog_archive_display_count_categories == 'show' ) : ?>
									<span class="entry-count"><?php echo sprintf( esc_html__( '(%s)', 'sala' ), $count_posts->publish ); ?></span>
								<?php endif; ?>
							</a>
						</li>
						<?php
						foreach( $categories as $category ) {
							$category_link = get_category_link( $category->term_id );
						?>
							<li <?php if( $category_id == $category->term_id ) : echo esc_attr('class=active');endif; ?>>
								<a href="<?php echo esc_url($category_link); ?>">
									<span class="entry-name"><?php echo esc_html($category->name); ?></span>
									<?php if( $blog_archive_display_count_categories == 'show' ) : ?>
										<span class="entry-count"><?php echo sprintf( esc_html__( '(%s)', 'sala' ), $category->count ); ?></span>
									<?php endif; ?>
								</a>
							</li>
						<?php } ?>
					</ul>
				</div>
			<?php endif;

			return ob_get_clean();
		}

		public static function blog_action() {
			ob_start();

			global $wp_query;

			$current    = max( 1, $wp_query->get( 'paged' ) );
			$per_page 	= $wp_query->get( 'posts_per_page' );
			$total    	= $wp_query->found_posts;

			$blog_archive_display_action       	= Sala_Helper::setting( 'blog_archive_display_action' );
			$blog_archive_display_count_post 	= Sala_Helper::setting( 'blog_archive_display_count_post' );
			$blog_archive_display_post_filter 	= Sala_Helper::setting( 'blog_archive_display_post_filter' );

			if( $blog_archive_display_action == 'show' ) : ?>
				<div class="sala-blog-action">
					<?php
						if( $blog_archive_display_count_post == 'show' ) :
					?>
					<div class="result-count">
					<?php
						if ( 1 === $total ) {
							_e( 'Showing the single result', 'sala' );
						} elseif ( $total <= $per_page || -1 === $per_page ) {
							/* translators: %d: total results */
							printf( _n( 'Showing all %d result', 'Showing all %d results', $total, 'sala' ), $total );
						} else {
							$first = ( $per_page * $current ) - $per_page + 1;
							$last  = min( $total, $per_page * $current );
							/* translators: 1: first result 2: last result 3: total results */
							printf( _nx( 'Showing %1$d&ndash;%2$d of %3$d result', 'Showing %1$d&ndash;%2$d of %3$d results', $total, 'with first and last result', 'sala' ), $first, $last, $total );
						}
					?>
					</div>
					<?php
						endif;
						if( $blog_archive_display_post_filter == 'show' ) :
							$queried_object = get_queried_object();
							if($queried_object){
								$selected = $queried_object->slug;
							} else {
								$selected = '';
							}

							if(get_permalink( get_option( 'page_for_posts' ) )){
								$blog_url = get_permalink( get_option( 'page_for_posts' ) );
							} else {
								$blog_url = home_url();
							}
					?>
					<div class="blog-filter">
						<form action="#" method="GET" class="blog-filter-form sala-filter-form" data-homeurl="<?php echo esc_url(home_url()); ?>" data-url="<?php echo esc_url($blog_url); ?>">
							<div class="form-group">
								<?php wp_dropdown_categories( array(
									'taxonomy'		   => 'category',
									'hide_empty'       => 1,
									'name'             => 'category',
									'orderby'          => 'name',
									'selected'         => $selected,
									'hierarchical'     => true,
									'class'            => 'nice-select',
									'value_field'      => 'slug',
									'show_option_none' => esc_html__( 'All Categories', 'sala' )
								) ); ?>
							</div>
							<div class="form-group">
								<?php wp_dropdown_categories( array(
									'taxonomy'		   => 'post_tag',
									'hide_empty'       => 1,
									'name'             => 'tag',
									'orderby'          => 'name',
									'selected'         => $selected,
									'hierarchical'     => true,
									'class'            => 'nice-select',
									'value_field'      => 'slug',
									'show_option_none' => esc_html__( 'Tags', 'sala' )
								) ); ?>
							</div>
						</form>
					</div>
					<?php
						endif;
					?>
				</div>
			<?php
				endif;

			return ob_get_clean();
		}

		function entry_feature() {

			$post_format    = $this->get_the_post_format();
			$thumbnail_size = '770x400';

			switch ( $post_format ) {
				case 'gallery':
					$this->entry_feature_gallery( $thumbnail_size );
					break;
				case 'audio':
					$this->entry_feature_audio();
					break;
				case 'video':
					$this->entry_feature_video( $thumbnail_size );
					break;
				case 'quote':
					$this->entry_feature_quote();
					break;
				case 'link':
					$this->entry_feature_link();
					break;
				default:
					$this->entry_feature_standard( $thumbnail_size );
					break;
			}
		}

		private function entry_feature_standard( $size ) {
			if ( ! has_post_thumbnail() ) {
				return;
			}
			?>
			<div class="entry-post-feature post-thumbnail">
				<?php Sala_Image::the_post_thumbnail( [ 'size' => $size, ] ); ?>
			</div>
			<?php
		}

		private function entry_feature_gallery( $size ) {
			$gallery = $this->get_the_post_meta( 'post_gallery' );
			if ( empty( $gallery ) ) {
				return;
			}
			?>
			<div class="entry-post-feature post-gallery sala-swiper-slider sala-slider" data-nav="1" data-loop="1" data-lg-gutter="30">
				<div class="swiper-inner">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<?php foreach ( $gallery as $image ) { ?>
								<div class="swiper-slide">
									<?php Sala_Image::the_attachment_by_id( array(
										'id'   => $image['id'],
										'size' => $size,
									) ); ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<?php
		}

		private function entry_feature_audio() {
			$audio = Sala_Post::instance()->get_the_post_meta( 'post_audio' );
			if ( empty( $audio ) ) {
				return;
			}

			if ( strrpos( $audio, '.mp3' ) !== false ) {
				echo do_shortcode( '[audio mp3="' . $audio . '"][/audio]' );
			} else {
				?>
				<div class="entry-post-feature post-audio">
					<?php if ( wp_oembed_get( $audio ) ) { ?>
						<?php echo Sala_Helper::w3c_iframe( wp_oembed_get( $audio ) ); ?>
					<?php } ?>
				</div>
				<?php
			}
		}

		private function entry_feature_video( $size ) {
			$video = $this->get_the_post_meta( 'post_video' );
			if ( empty( $video ) ) {
				return;
			}
			?>
			<div class="entry-post-feature post-video tm-popup-video type-poster sala-animation-zoom-in">
				<a href="<?php echo esc_url( $video ); ?>" class="video-link sala-box link-secret">
					<div class="video-poster">
						<div class="sala-image">
							<?php if ( has_post_thumbnail() ) { ?>
								<?php Sala_Image::the_post_thumbnail( [ 'size' => $size, ] ); ?>
							<?php } ?>
						</div>
						<div class="video-overlay"></div>

						<div class="video-button">
							<div class="video-play video-play-icon">
								<span class="icon"></span>
							</div>
						</div>
					</div>
				</a>
			</div>
			<?php
		}

		private function entry_feature_quote() {
			$text = $this->get_the_post_meta( 'post_quote_text' );
			if ( empty( $text ) ) {
				return;
			}
			$name = $this->get_the_post_meta( 'post_quote_name' );
			$url  = $this->get_the_post_meta( 'post_quote_url' );
			?>
			<div class="entry-post-feature post-quote">
				<div class="post-quote-content">
					<span class="quote-icon fas fa-quote-right"></span>
					<h3 class="post-quote-text"><?php echo esc_html( '&ldquo;' . $text . '&rdquo;' ); ?></h3>
					<?php if ( ! empty( $name ) ) { ?>
						<?php $name = "- $name"; ?>
						<h6 class="post-quote-name">
							<?php if ( ! empty( $url ) ) { ?>
								<a href="<?php echo esc_url( $url ); ?>"
								   target="_blank"><?php echo esc_html( $name ); ?></a>
							<?php } else { ?>
								<?php echo esc_html( $name ); ?>
							<?php } ?>
						</h6>
					<?php } ?>
				</div>
			</div>
			<?php
		}

		private function entry_feature_link() {
			$link = $this->get_the_post_meta( 'post_link' );
			if ( empty( $link ) ) {
				return;
			}
			?>
			<div class="entry-post-feature post-link">
				<a href="<?php echo esc_url( $link ); ?>" target="_blank"><?php echo esc_html( $link ); ?></a>
			</div>
			<?php
		}
	}

	Sala_Post::instance()->initialize();
}
