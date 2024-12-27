<?php
defined( 'ABSPATH' ) || exit;

/**
 * Initialize Global Variables
 */
if ( ! class_exists( 'Sala_Global' ) ) {
	class Sala_Global {

		protected static $instance        = null;
		protected static $page_title_type = '01';
		protected static $header_type     = '01';
		protected static $header_overlay  = 'no';
		protected static $header_float    = 'no';
		protected static $header_skin     = 'light';
		protected static $topbar_type     = '01';
		protected static $footer_type     = '0';

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self:: $instance;
		}

		public function initialize() {
			/**
			 * Use hook wp instead of init because we need post meta setup.
			 * then we must wait for post loaded.
			 */
			add_action( 'wp', array( $this, 'init_global_variable' ) );

			/**
			 * Setup global variables.
			 * Used priority 12 to wait override settings setup.
			 *
			 * @see Sala_Customize->setup_override_settings()
			 */
			add_action( 'wp', array( $this, 'setup_global_variables' ), 12 );
		}

		function init_global_variable() {
			global $sala_page_options;
			if ( is_singular( 'portfolio' ) ) {
				$sala_page_options = maybe_unserialize( get_post_meta( get_the_ID(), 'sala_portfolio_options', true ) );
			} elseif ( is_singular( 'post' ) ) {
				$sala_page_options = maybe_unserialize( get_post_meta( get_the_ID(), 'sala_page_options', true ) );
			} elseif ( is_singular( 'page' ) ) {
				$sala_page_options = maybe_unserialize( get_post_meta( get_the_ID(), 'sala_page_options', true ) );
			} elseif ( !is_front_page() && is_home() ) {
				$postID = get_queried_object_id();
				$sala_page_options = maybe_unserialize( get_post_meta( $postID, 'sala_page_options', true ) );
			} elseif ( is_singular( 'product' ) ) {
				$sala_page_options = maybe_unserialize( get_post_meta( get_the_ID(), 'sala_page_options', true ) );
			}
			if ( function_exists( 'is_shop' ) && is_shop() ) {
				// Get page id of shop.
				$page_id           = wc_get_page_id( 'shop' );
				$sala_page_options = maybe_unserialize( get_post_meta( $page_id, 'sala_page_options', true ) );
			}
		}

		public function setup_global_variables() {
			$this->set_topbar_type();
			$this->set_header_options();
			$this->set_page_title_type();
			$this->set_footer_type();
		}

		public static function get_topbar_type() {
			return self::$topbar_type;
		}

		public static function get_header_type() {
			return self:: $header_type;
		}

		public static function get_header_overlay() {
			return self:: $header_overlay;
		}

		public static function get_header_float() {
			return self:: $header_float;
		}

		public static function get_header_skin() {
			return self:: $header_skin;
		}

		public static function get_page_title_type() {
			return self:: $page_title_type;
		}

		public static function get_footer_type() {
			return self::$footer_type;
		}

		public static function get_list_headers($default_option = true) {
			$headers = array(
				'01' => esc_html__( 'Header 01', 'sala' ),
				'02' => esc_html__( 'Header 02', 'sala' ),
				'03' => esc_html__( 'Header 03', 'sala' ),
			);

			if ( $default_option === true ) {
				$default_text = esc_html__( 'Default', 'sala' );
				$headers      = array( '' => $default_text ) + $headers;
			}

			return $headers;
		}

		public static function get_list_footers($default_option = true) {
			$footers = get_posts(array(
				'post_type'      => 'sala_footer',
				'posts_per_page' => -1,
			));

			$arr_footer = array('0' => __( 'None', 'sala' ));

			if ( $default_option === true ) {
				$default_text = esc_html__( 'Default', 'sala' );
				$arr_footer   = array( '' => $default_text ) + $arr_footer;
			}

			foreach ( $footers as $footer ) {
				$arr_footer[$footer->ID] = ucwords($footer->post_title);
			}

			return $arr_footer;
		}

		public static function get_list_topbar($default_option = true) {
			$topbar = array(
				'01'   => esc_html__( 'Topbar 01', 'sala' ),
			);

			if ( $default_option === true ) {
				$default_text = esc_html__( 'Default', 'sala' );
				$topbar   = array( '' => $default_text ) + $topbar;
			}

			return $topbar;
		}

		function set_topbar_type() {
			$type = Sala_Helper::get_post_meta( 'top_bar_type', '' );

			if ( $type === '' ) {
				$type = Sala_Helper::setting( 'top_bar_type' );
			}

			self::$topbar_type = $type;
		}

		function set_footer_type() {
			$type = Sala_Helper::get_post_meta( 'footer_type', '' );

			if ( $type === '' ) {
				$type = Sala_Helper::setting( 'footer_type' );
			}

			self::$footer_type = $type;
		}

		function set_header_options() {
			$header_type    = Sala_Helper::get_post_meta( 'header_type', '' );
			$header_overlay = Sala_Helper::get_post_meta( 'header_overlay', '' );
			$header_float   = Sala_Helper::get_post_meta( 'header_float', '' );
			$header_skin    = Sala_Helper::get_post_meta( 'header_skin', '' );

			if ( Sala_Woo::instance()->is_woocommerce_page_without_product() ) {

				if ( $header_type === '' ) {
					$header_type = Sala_Helper::setting( 'product_archive_header_type' );
				}

				if ( $header_overlay === '' ) {
					$header_overlay = Sala_Helper::setting( 'product_archive_header_overlay' );
				}

				if ( $header_float === '' ) {
					$header_float = Sala_Helper::setting( 'product_archive_header_float' );
				}

				if ( $header_skin === '' ) {
					$header_skin = Sala_Helper::setting( 'product_archive_header_skin' );
				}

			} elseif ( get_theme_mod('sala_portfolio', 0) && Sala_Portfolio::instance()->is_archive() ) {

				if ( $header_type === '' ) {
					$header_type = Sala_Helper::setting( 'portfolio_archive_header_type' );
				}

				if ( $header_overlay === '' ) {
					$header_overlay = Sala_Helper::setting( 'portfolio_archive_header_overlay' );
				}

				if ( $header_float === '' ) {
					$header_float = Sala_Helper::setting( 'portfolio_archive_header_float' );
				}

				if ( $header_skin === '' ) {
					$header_skin = Sala_Helper::setting( 'portfolio_archive_header_skin' );
				}

			} elseif ( Sala_Post::instance()->is_archive() ) {
				if ( $header_type === '' ) {
					$header_type = Sala_Helper::setting( 'blog_archive_header_type' );
				}

				if ( $header_overlay === '' ) {
					$header_overlay = Sala_Helper::setting( 'blog_archive_header_overlay' );
				}

				if ( $header_float === '' ) {
					$header_float = Sala_Helper::setting( 'blog_archive_header_float' );
				}

				if ( $header_skin === '' ) {
					$header_skin = Sala_Helper::setting( 'blog_archive_header_skin' );
				}

			} elseif ( is_singular( 'post' ) ) {

				if ( $header_type === '' ) {
					$header_type = Sala_Helper::setting( 'single_post_header_type' );
				}



				if ( $header_overlay === '' ) {
					$header_overlay = Sala_Helper::setting( 'single_post_header_overlay' );
				}

				if ( $header_float === '' ) {
					$header_float = Sala_Helper::setting( 'single_post_header_float' );
				}

				if ( $header_skin === '' ) {
					$header_skin = Sala_Helper::setting( 'single_post_header_skin' );
				}

			} elseif ( is_singular( 'portfolio' ) ) {

				if ( $header_type === '' ) {
					$header_type = Sala_Helper::setting( 'portfolio_single_header_type' );
				}

				if ( $header_overlay === '' ) {
					$header_overlay = Sala_Helper::setting( 'portfolio_single_header_overlay' );
				}

				if ( $header_float === '' ) {
					$header_float = Sala_Helper::setting( 'portfolio_single_header_float' );
				}

				if ( $header_skin === '' ) {
					$header_skin = Sala_Helper::setting( 'portfolio_single_header_skin' );
				}

			} elseif ( is_singular( 'product' ) ) {

				if ( $header_type === '' ) {
					$header_type = Sala_Helper::setting( 'product_single_header_type' );
				}

				if ( $header_overlay === '' ) {
					$header_overlay = Sala_Helper::setting( 'product_single_header_overlay' );
				}

				if ( $header_float === '' ) {
					$header_float = Sala_Helper::setting( 'product_single_header_float' );
				}

				if ( $header_skin === '' ) {
					$header_skin = Sala_Helper::setting( 'product_single_header_overlay' );
				}

			} elseif ( is_singular( 'page' ) ) {

				if ( $header_type === '' ) {
					$header_type = Sala_Helper::setting( 'page_header_type' );
				}


				if ( $header_overlay === '' ) {
					$header_overlay = Sala_Helper::setting( 'page_header_overlay' );
				}

				if ( $header_float === '' ) {
					$header_float = Sala_Helper::setting( 'page_header_float' );
				}

				if ( $header_skin === '' ) {
					$header_skin = Sala_Helper::setting( 'page_header_skin' );
				}

			} else {

				if ( $header_type === '' ) {
					$header_type = Sala_Helper::setting( 'header_type' );
				}

				if ( $header_overlay === '' ) {
					$header_overlay = Sala_Helper::setting( 'header_overlay' );
				}

				if ( $header_float === '' ) {
					$header_float = Sala_Helper::setting( 'header_float' );
				}

				if ( $header_skin === '' ) {
					$header_skin = Sala_Helper::setting( 'header_skin' );
				}
			}

			if ( $header_type === '' ) {

				$header_type = Sala_Helper::setting( 'header_type' );

			}

			if ( $header_overlay === '' ) {
				$header_overlay = Sala_Helper::setting( 'header_overlay' );
			}

			if ( $header_float === '' ) {
				$header_float = Sala_Helper::setting( 'header_float' );
			}

			if ( $header_skin === '' ) {
				$header_skin = Sala_Helper::setting( 'header_skin' );
			}

			$header_type    = apply_filters( 'sala_header_type', $header_type );
			$header_overlay = apply_filters( 'sala_header_overlay', $header_overlay );
			$header_float   = apply_filters( 'sala_header_float', $header_float );
			$header_skin    = apply_filters( 'sala_header_skin', $header_skin );

			self::$header_type    = $header_type;
			self::$header_overlay = $header_overlay;
			self::$header_float   = $header_float;
			self::$header_skin    = $header_skin;
		}

		function set_page_title_type() {
			$type = Sala_Helper::get_post_meta( 'page_page_title_layout', '' );

			if ( $type === '' ) {
				if ( Sala_Woo::instance()->is_woocommerce_page_without_product() ) {
					$type = Sala_Helper::setting( 'product_archive_page_title_layout' );
				} elseif ( get_theme_mod('sala_portfolio', 0) &&  Sala_Portfolio::instance()->is_archive() ) {
					$type = Sala_Helper::setting( 'portfolio_archive_page_title_layout' );
				} elseif ( Sala_Post::instance()->is_archive() ) {
					$type = Sala_Helper::setting( 'blog_archive_page_title_layout' );
				} elseif ( is_singular( 'post' ) ) {
					$type = Sala_Helper::setting( 'single_post_page_title_layout' );
				} elseif ( is_singular( 'page' ) ) {
					$type = Sala_Helper::setting( 'page_page_title_layout' );
				} elseif ( is_singular( 'product' ) ) {
					$type = Sala_Helper::setting( 'product_single_page_title_layout' );
				} elseif ( is_singular( 'portfolio' ) ) {
					$type = Sala_Helper::setting( 'portfolio_single_page_title_layout' );
				} else {
					$type = Sala_Helper::setting( 'page_title_layout' );
				}

				if ( $type === '' ) {
					$type = Sala_Helper::setting( 'page_title_layout' );
				}
			}

			$type = apply_filters( 'sala_page_title_type', $type );

			self::$page_title_type = $type;
		}

		public static function render_sidebar( $position = 'right' ) {
			$classes 		  = array();
			$classes[]        = 'sidebar-' . $position;
			$active_sidebar   = 'blog_sidebar';
			$sidebar_position = 'right';
			if ( Sala_Post::instance()->is_archive() ) {
				$sidebar_position = Sala_Helper::setting( 'blog_archive_sidebar_position' );
				$active_sidebar   = Sala_Helper::setting( 'blog_archive_active_sidebar' );
				$classes[]        = 'sidebar-blog-archive';
			} elseif ( get_theme_mod('sala_portfolio', 0) && Sala_Portfolio::instance()->is_archive() ) {
				$sidebar_position = Sala_Helper::setting( 'portfolio_archive_sidebar_position' );
				$active_sidebar   = Sala_Helper::setting( 'portfolio_archive_active_sidebar' );
				$classes[]        = 'sidebar-portfolio-archive';
			} elseif ( Sala_Woo::instance()->is_product_archive() ) {
				$sidebar_position = Sala_Helper::setting( 'product_archive_sidebar_position' );
				$active_sidebar   = Sala_Helper::setting( 'product_archive_active_sidebar' );
				$classes[]        = 'sidebar-product-archive';
			} elseif ( is_search() ) {
				$sidebar_position = Sala_Helper::setting( 'blog_archive_sidebar_position' );
				$active_sidebar   = Sala_Helper::setting( 'blog_archive_active_sidebar' );
			} elseif ( is_singular() ) {
				$post_type = get_post_type();
				// Get values from page options.
				$sidebar_position = Sala_Helper::get_post_meta( 'sidebar_position', 'default' );
				$active_sidebar   = Sala_Helper::get_post_meta( 'active_sidebar', 'default' );
				switch ( $post_type ) {
					case 'post':
						if ( $sidebar_position === 'default' ) {
							$sidebar_position = Sala_Helper::setting( 'single_post_sidebar_position' );
						}
						if ( $active_sidebar === 'default' ) {
							$active_sidebar = Sala_Helper::setting( 'single_post_active_sidebar' );
						}
						$classes[] = 'sidebar-single-post';
						break;

					case 'portfolio':
						if ( $sidebar_position === 'default' ) {
							$sidebar_position = Sala_Helper::setting( 'single_portfolio_sidebar_position' );
						}
						if ( $active_sidebar === 'default' ) {
							$active_sidebar = Sala_Helper::setting( 'single_portfolio_active_sidebar' );
						}
						$classes[] = 'sidebar-single-portfolio';
						break;

					case 'product':
						if ( $sidebar_position === 'default' ) {
							$sidebar_position = Sala_Helper::setting( 'single_product_sidebar_position' );
						}
						if ( $active_sidebar === 'default' ) {
							$active_sidebar = Sala_Helper::setting( 'single_product_active_sidebar' );
						}
						$classes[] = 'sidebar-single-product';
						break;

					case 'sala_mega_menu':
							$sidebar_position = 'none';
						break;

					default:
						if ( $sidebar_position === 'default' ) {
							$sidebar_position = Sala_Helper::setting( 'page_sidebar_position' );
						}
						if ( $active_sidebar === 'default' ) {
							$active_sidebar = Sala_Helper::setting( 'page_active_sidebar' );
						}
						break;
				}
			}

			$sidebar_position = apply_filters( 'sala_sidebar_position', $sidebar_position );

			if( $position === $sidebar_position ) {
				self::get_sidebar( $classes, $active_sidebar );
			}
		}

		public static function get_sidebar( $classes, $name ) {
			if( ! is_active_sidebar($name) ) {
				return;
			}
			?>
			<aside id="secondary" class="<?php echo join(' ', $classes); ?>">
				<div class="inner-sidebar" itemscope="itemscope">
					<?php dynamic_sidebar( $name ); ?>
				</div>
			</aside>
			<?php
		}

	}

	Sala_Global::instance()->initialize();
}
