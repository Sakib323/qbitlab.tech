<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Sala_Page_Title' ) ) {

	class Sala_Page_Title {

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function initialize() {
			// Adds custom classes to the array of body classes.
			add_filter( 'body_class', [ $this, 'body_classes' ] );
			add_action( 'sala_after_header', [ $this, 'render' ] );
		}

		public function body_classes( $classes ) {
			$page_title = self::page_title_type();
			$classes[] = "page-title-{$page_title}";

			/**
			 * Add class to hide entry title if this title bar has post title also.
			 */
			// Page Title support heading.
			if ( in_array( $page_title, [ '01', '02', '03' ], true ) && is_singular() ) {
				$post_type = get_post_type();
				$title     = '';

				switch ( $post_type ) {
					case 'post' :
						$title = Sala_Helper::setting( 'page_title_single_blog_title' );
						break;
					case 'portfolio' :
						$title = Sala_Helper::setting( 'page_title_single_portfolio_title' );
						break;
					case 'product' :
						$title = Sala_Helper::setting( 'page_title_single_product_title' );
						break;
				}

				if ( '' === $title ) {
					$classes[] = 'page-title-has-post-title';
				}
			}

			return $classes;
		}

		public function page_title_type() {
			$type = Sala_Helper::get_post_meta( 'page_page_title_layout', '' );

			if ( $type === '' ) {
				if ( Sala_Woo::instance()->is_woocommerce_page_without_product() ) {
					$type = Sala_Helper::setting( 'archive_product_page_title_layout' );
				} elseif ( get_theme_mod('sala_portfolio', 0) && Sala_Portfolio::instance()->is_archive() ) {
					$type = Sala_Helper::setting( 'portfolio_archive_page_title_layout' );
				} elseif ( Sala_Post::instance()->is_archive() ) {
					$type = Sala_Helper::setting( 'blog_archive_page_title_layout' );
				} elseif ( is_singular( 'post' ) ) {
					$type = Sala_Helper::setting( 'single_post_page_title_layout' );
				} elseif ( is_singular( 'page' ) ) {
					$type = Sala_Helper::setting( 'page_page_title_layout' );
				} elseif ( is_singular( 'product' ) ) {
					$type = Sala_Helper::setting( 'single_product_page_title_layout' );
				} elseif ( is_singular( 'portfolio' ) ) {
					$type = Sala_Helper::setting( 'single_portfolio_page_title_layout' );
				} else {
					$type = Sala_Helper::setting( 'page_title_layout' );
				}

				if ( $type === '' ) {
					$type = Sala_Helper::setting( 'page_title_layout' );
				}
			}

			$type = apply_filters( 'sala_page_title_type', $type );

			return $type;
		}

		public static function get_list( $default_option = false, $default_text = '' ) {
			$options = array(
				'none' => esc_html__( 'None', 'sala' ),
				'01'   => esc_html__( 'Style 01', 'sala' ),
				'02'   => esc_html__( 'Style 02', 'sala' ),
				'03'   => esc_html__( 'Style 03', 'sala' ),
				'04'   => esc_html__( 'Style 04', 'sala' ),
			);

			if ( $default_option === true ) {
				if ( $default_text === '' ) {
					$default_text = esc_html__( 'Default', 'sala' );
				}

				$options = array( '' => $default_text ) + $options;
			}

			return $options;
		}

		public function the_wrapper_class() {
			$classes = array( 'page-title' );

			$type = self::page_title_type();

			$classes[] = "page-title-{$type}";

			echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
		}

		public function render() {
			$type = self::page_title_type();

			if ( 'none' === $type || is_404() ) {
				return;
			}

			get_template_part( 'templates/page-title/page-title', $type );
		}

		public function render_title() {
			$title     = '';
			$title_tag = 'h1';

			if ( get_theme_mod('sala_portfolio', 0) && Sala_Portfolio::instance()->is_archive() ) {
				$title = Sala_Helper::setting( 'page_title_archive_portfolio_title' );
			} elseif ( is_post_type_archive() ) {
				if ( function_exists( 'is_shop' ) && is_shop() ) {
					$title = esc_html__( 'Shop', 'sala' );
				} else {
					$title = sprintf( esc_html__( 'Archives: %s', 'sala' ), post_type_archive_title( '', false ) );
				}
			} elseif ( is_home() ) {
				$title = Sala_Helper::setting( 'page_title_home_title' ) . single_tag_title( '', false );
			} elseif ( is_tag() ) {
				$title = Sala_Helper::setting( 'page_title_archive_tag_title' ) . single_tag_title( '', false );
			} elseif ( is_author() ) {
				$title = Sala_Helper::setting( 'page_title_archive_author_title' ) . '<span class="vcard">' . get_the_author() . '</span>';
			} elseif ( is_year() ) {
				$title = Sala_Helper::setting( 'page_title_archive_year_title' ) . get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'sala' ) );
			} elseif ( is_month() ) {
				$title = Sala_Helper::setting( 'page_title_archive_month_title' ) . get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'sala' ) );
			} elseif ( is_day() ) {
				$title = Sala_Helper::setting( 'page_title_archive_day_title' ) . get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'sala' ) );
			} elseif ( is_search() ) {
				$title = Sala_Helper::setting( 'page_title_search_title' ) . '"' . get_search_query() . '"';
			} elseif ( is_category() || is_tax() ) {
				$title = Sala_Helper::setting( 'page_title_archive_category_title' ) . single_cat_title( '', false );
			} elseif ( is_singular() ) {
				$title = Sala_Helper::get_post_meta( 'page_page_title_custom_heading', '' );

				if ( '' === $title ) {
					$post_type = get_post_type();
					switch ( $post_type ) {
						case 'post' :
							$title = Sala_Helper::setting( 'page_title_single_blog_title' );
							break;
						case 'portfolio' :
							$title = Sala_Helper::setting( 'page_title_single_portfolio_title' );
							break;
						case 'product' :
							$title = Sala_Helper::setting( 'page_title_single_product_title' );
							break;
					}
				}

				if ( '' === $title ) {
					$title = get_the_title();
				} else {
					$title_tag = 'h2';
				}
				if ( class_exists( 'WooCommerce' ) ) {
					if( is_cart() || is_checkout() ){
						$title_tag = 'h2';
					}
				}
			} else {
				$title = get_the_title();
			}

			if( get_the_title() === 'Shop Left Sidebar' || get_the_title() === 'Shop Right Sidebar' ){
			    $title_tag = 'h2';
			}
			?>
			<div class="page-title-heading">
				<?php printf( '<%s class="heading heading-font">', $title_tag ); ?>
				<?php echo wp_kses( $title, array(
					'span' => [
						'class' => [],
					],
				) ); ?>
				<?php printf( '</%s>', $title_tag ); ?>
			</div>
			<?php
		}
	}

	Sala_Page_Title::instance()->initialize();
}
