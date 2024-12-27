<?php

// Exit if accessed directly
if ( !defined('ABSPATH') ) {
	exit;
}

if ( !class_exists('Sala_Templates') ) {

	/**
     *  Class Sala_Templates
     */
	class Sala_Templates {

		/**
		 * The constructor.
		 */
		function __construct() {

			// Register shortcode
			add_shortcode('site_logo', array( $this, 'site_logo'));
			add_shortcode('main_menu', array( $this, 'main_menu'));
			add_shortcode('landing_menu', array( $this, 'landing_menu'));
			add_shortcode('canvas_menu', array( $this, 'canvas_menu'));
			add_shortcode('canvas_menu_02', array( $this, 'canvas_menu_02'));
			add_shortcode('canvas_mb_menu', array( $this, 'canvas_mb_menu'));
			add_shortcode('header_device', array( $this, 'header_device'));
			add_shortcode('header_lang', array( $this, 'header_lang'));
			add_shortcode('header_contact', array( $this, 'header_contact'));
			add_shortcode('header_cart', array( $this, 'header_cart'));
			add_shortcode('header_button_01', array( $this, 'header_button_01'));
			add_shortcode('header_button_02', array( $this, 'header_button_02'));
			add_shortcode('header_account', array( $this, 'header_account'));
			add_shortcode('header_search_icon', array( $this, 'header_search_icon'));
			add_shortcode('header_search_input', array( $this, 'header_search_input'));
			add_shortcode('header_custom_html_01', array( $this, 'header_custom_html_01'));
			add_shortcode('header_custom_html_02', array( $this, 'header_custom_html_02'));
			add_shortcode('login_form', array( $this, 'login_form'));
			add_shortcode('register_form', array( $this, 'register_form'));
			add_shortcode('forgot_form', array( $this, 'forgot_form'));
			add_shortcode('reset_form', array( $this, 'reset_form'));
			add_shortcode('scroll_bar', array( $this, 'scroll_bar'));

			// Hook Template
			add_action('sala_before_header', array( $this, 'canvas_search'));
		}

		public static function site_logo( $type = 'dark', $important = false ) {

			$logo        = '';
			$logo_retina = '';

			$logo_dark         = Sala_Helper::setting('logo_dark');
			$logo_dark_retina  = Sala_Helper::setting('logo_dark_retina');
			$logo_light        = Sala_Helper::setting('logo_light');
			$logo_light_retina = Sala_Helper::setting('logo_light_retina');
			$header_skin       = Sala_Global::instance()->get_header_skin();
			$custom_dark_logo  = Sala_Helper::get_post_meta( 'custom_dark_logo', '' );
			$custom_light_logo = Sala_Helper::get_post_meta( 'custom_light_logo', '' );

			if( $custom_dark_logo !== '' ) {
				$logo_dark = $custom_dark_logo;
			}

			if( $custom_light_logo !== '' ) {
				$logo_light = $custom_light_logo;
			}

			if( $header_skin && !$important ) {
				$type = $header_skin;
			}

			if( $type == 'light') {

				if( $logo_dark ) {
					$logo = $logo_dark;
				}

				if( $logo_dark_retina ) {
					$logo_retina = $logo_dark_retina;
				}
			}

			if( $type == 'dark' ) {

				if( $logo_light ) {
					$logo = $logo_light;
				}

				if( $logo_light_retina ) {
					$logo_retina = $logo_light_retina;
				}
			}

			$site_name = get_bloginfo('name', 'display');

			ob_start();

			?>
			<div class="site-logo ux-element" data-id="site-logo">
				<?php if ( !empty($logo) ) : ?>
	                <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr($site_name); ?>">
						<img class="site-main-logo" src="<?php echo esc_url($logo); ?>" data-retina="<?php echo esc_attr($logo_retina); ?>" alt="<?php echo esc_attr($site_name); ?>">
						<img class="site-dark-logo hide" src="<?php echo esc_url($logo_light); ?>" data-retina="<?php echo esc_attr($logo_light_retina); ?>" alt="<?php echo esc_attr($site_name); ?>">
					</a>
	            <?php else : ?>
					<?php $blog_info = get_bloginfo( 'name' ); ?>
					<?php if ( !empty($blog_info) ) : ?>
						<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
						<p><?php bloginfo( 'description' ); ?></p>
					<?php endif; ?>
	            <?php endif; ?>
			</div>
			<?php

			return ob_get_clean();
		}

		public static function main_menu() {
			$main_menu_desktop_hidden = Sala_Helper::setting('main_menu_desktop_hidden');
			$main_menu_tablet_hidden  = Sala_Helper::setting('main_menu_tablet_hidden');
			$main_menu_mobile_hidden  = Sala_Helper::setting('main_menu_mobile_hidden');

			$classes = array('main-menu', 'ux-element', 'site-menu', 'desktop-menu');
			if( $main_menu_desktop_hidden ) {
				$classes[] = 'hidden-on-desktop';
			}
			if( $main_menu_tablet_hidden ) {
				$classes[] = 'hidden-on-tablet';
			}
			if( $main_menu_mobile_hidden ) {
				$classes[] = 'hidden-on-mobile';
			}

			ob_start();
			?>
				<div class="<?php echo join(' ', $classes); ?>" data-id="main-menu">
					<?php
						$args = array();

						$defaults = array(
							'theme_location' => 'main_menu',
							'container'      => 'ul',
							'menu_class'     => 'menu sm sm-simple',
							'extra_class'    => '',
			            );

			            $args = wp_parse_args( $args, $defaults );

						if ( has_nav_menu( 'main_menu' ) && class_exists( 'Sala_Walker_Nav_Menu' ) ) {
				            $args['walker'] = new Sala_Walker_Nav_Menu;
				        }

				        if ( has_nav_menu( 'main_menu' ) ) {
				        	wp_nav_menu( $args );
				        }
					?>
				</div>
			<?php
			return ob_get_clean();
		}

		public static function landing_menu() {
			$landing_menu_desktop_hidden = Sala_Helper::setting('landing_menu_desktop_hidden');
			$landing_menu_tablet_hidden  = Sala_Helper::setting('landing_menu_tablet_hidden');
			$landing_menu_mobile_hidden  = Sala_Helper::setting('landing_menu_mobile_hidden');

			$classes = array('landing-menu', 'ux-element', 'site-menu', 'desktop-menu');
			if( $landing_menu_desktop_hidden ) {
				$classes[] = 'hidden-on-desktop';
			}
			if( $landing_menu_tablet_hidden ) {
				$classes[] = 'hidden-on-tablet';
			}
			if( $landing_menu_mobile_hidden ) {
				$classes[] = 'hidden-on-mobile';
			}

			ob_start();
			?>
				<div class="<?php echo join(' ', $classes); ?>" data-id="landing-menu">
					<?php
						$args = array();

						$defaults = array(
							'theme_location' => 'landing_menu',
							'container'      => 'ul',
							'menu_class'     => 'menu sm sm-simple',
							'extra_class'    => '',
			            );

			            $args = wp_parse_args( $args, $defaults );

						if ( has_nav_menu( 'landing_menu' ) && class_exists( 'Sala_Walker_Nav_Menu' ) ) {
				            $args['walker'] = new Sala_Walker_Nav_Menu;
				        }

				        if ( has_nav_menu( 'landing_menu' ) ) {
				        	wp_nav_menu( $args );
				        }
					?>
				</div>
			<?php
			return ob_get_clean();
		}

		public static function mobile_menu() {
            $canvas_menu_sidebar_skin = Sala_Helper::setting('canvas_menu_sidebar_skin');
			$user_account             = Sala_Helper::setting( 'user_account' );
            $url_phone                = Sala_Helper::setting( 'url_phone' );
            $url_email                = Sala_Helper::setting( 'url_email' );

			ob_start();
			?>
				<div class="bg-overlay"></div>

				<div class="site-menu area-menu mobile-menu">

					<div class="inner-menu custom-scrollbar">

						<div class="entry-top">
							<a href="#" class="btn-canvas-menu btn-close"><i class="fal fa-times"></i></a>

							<?php
								if ( has_nav_menu( 'mobile_menu' ) ) {
									$theme_location = 'mobile_menu';
								}else{
									$theme_location = 'main_menu';
								}

								$args = array(
									'menu_class'     => 'menu',
									'container'      => '',
									'theme_location' => $theme_location,
								);

								if ( has_nav_menu( 'main_menu' ) && class_exists( 'Sala_Walker_Nav_Menu' ) ) {
									$args['walker'] = new Sala_Walker_Nav_Menu;
								}

								wp_nav_menu( $args );
							?>
						</div>

						<div class="entry-bottom">
							<?php if( ! empty($user_account) ) : ?>
								<?php
									$signin = get_the_permalink(get_theme_mod( 'sign_in' ));
									if ( is_user_logged_in() ) :
										$current_user = wp_get_current_user();
								?>
									<a href="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') )); ?>" class="user-account logged">
										<?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
										<?php echo esc_html($current_user->display_name); ?>
									</a>
								<?php
									else :
								?>
									<a href="<?php echo esc_url($signin); ?>" class="user-account unlog">
										<i class="fas fa-user-circle"></i>
										<?php echo esc_html( 'Log In', 'sala' ); ?>
									</a>
								<?php
									endif;
								?>
							<?php endif; ?>
							<?php if( ! empty($url_phone) ) : ?>
								<a href="tel:<?php echo esc_attr($url_phone); ?>"><?php echo sprintf( esc_html__( 'Call. %s', 'sala' ), $url_phone ); ?></a>
							<?php endif; ?>
							<?php if( ! empty($url_email) ) : ?>
								<a href="mailto:<?php echo esc_attr($url_email); ?>"><?php echo sprintf( esc_html__( 'Email. %s', 'sala' ), $url_email ); ?></a>
							<?php endif; ?>
							<div class="social-links">
								<?php
								$tooltip = array(
									'style'            => 'icons',
									'target'           => '_blank',
									'tooltip_enable'   => true,
									'tooltip_skin'     => 'primary',
									'tooltip_position' => 'top',
								);
								$canvas_menu_social_enable = Sala_Helper::setting( 'canvas_menu_social_enable', '1' );
								if ( ! empty( $canvas_menu_social_enable ) ) {
									$canvas_menu_social_order = Sala_Helper::setting( 'canvas_menu_social_order' );
									$link_classes = '';

									if ( $tooltip['tooltip_enable'] === true ) {
										$link_classes .= "hint--bounce hint--{$tooltip['tooltip_position']} hint--{$tooltip['tooltip_skin']}";
									}

									foreach ( $canvas_menu_social_order as $social ) {
										if ( is_array($canvas_menu_social_enable) &&  in_array( $social, $canvas_menu_social_enable, true ) ) {
											$url_facebook    = Sala_Helper::setting( 'url_facebook' );
											$url_twitter     = Sala_Helper::setting( 'url_twitter' );
											$url_instagram   = Sala_Helper::setting( 'url_instagram' );
											$url_linkedin    = Sala_Helper::setting( 'url_linkedin' );
											$url_tripadvisor = Sala_Helper::setting( 'url_tripadvisor' );

											if ( $social === 'facebook' && ! empty($url_facebook) ) {
												?>
												<a class="<?php echo esc_attr( $link_classes . ' facebook' ); ?>"
												target="<?php echo esc_attr( $tooltip['target'] ); ?>"
												aria-label="<?php esc_attr_e( 'Facebook', 'sala' ); ?>"
												href="<?php echo esc_url( $url_facebook ); ?>">
													<?php if ( $tooltip['style'] === 'text' ) : ?>
														<span><?php esc_html_e( 'Facebook', 'sala' ); ?></span>
													<?php else: ?>
														<i class="fab fa-facebook-f"></i>
													<?php endif; ?>
												</a>
												<?php
											} elseif ( $social === 'twitter' && ! empty($url_twitter) ) {
												?>
												<a class="<?php echo esc_attr( $link_classes . ' twitter' ); ?>"
												target="<?php echo esc_attr( $tooltip['target'] ); ?>"
												aria-label="<?php esc_attr_e( 'Twitter', 'sala' ); ?>"
												href="<?php echo esc_url($url_twitter); ?>">
													<?php if ( $tooltip['style'] === 'text' ) : ?>
														<span><?php esc_html_e( 'Twitter', 'sala' ); ?></span>
													<?php else: ?>
														<i class="fab fa-twitter"></i>
													<?php endif; ?>
												</a>
												<?php
											} elseif ( $social === 'instagram' && ! empty($url_instagram) ) {
												?>
												<a class="<?php echo esc_attr( $link_classes . ' instagram' ); ?>"
												target="<?php echo esc_attr( $tooltip['target'] ); ?>"
												aria-label="<?php esc_attr_e( 'Instagram', 'sala' ); ?>"
												href="<?php echo esc_url($url_instagram); ?>">
													<?php if ( $tooltip['style'] === 'text' ) : ?>
														<span><?php esc_html_e( 'Instagram', 'sala' ); ?></span>
													<?php else: ?>
														<i class="fab fa-instagram"></i>
													<?php endif; ?>
												</a>
												<?php
											} elseif ( $social === 'linkedin' && ! empty($url_linkedin) ) {
												?>
												<a class="<?php echo esc_attr( $link_classes . ' linkedin' ); ?>"
												target="<?php echo esc_attr( $tooltip['target'] ); ?>"
												aria-label="<?php esc_attr_e( 'Linkedin', 'sala' ); ?>"
												href="<?php echo esc_url($url_linkedin); ?>">
													<?php if ( $tooltip['style'] === 'text' ) : ?>
														<span><?php esc_html_e( 'Linkedin', 'sala' ); ?></span>
													<?php else: ?>
														<i class="fab fa-linkedin"></i>
													<?php endif; ?>
												</a>
												<?php
											} elseif ( $social === 'tripadvisor' && ! empty($url_tripadvisor) ) {
												?>
												<a class="<?php echo esc_attr( $link_classes . ' tripadvisor' ); ?>"
												target="<?php echo esc_attr( $tooltip['target'] ); ?>"
												aria-label="<?php esc_attr_e( 'Tripadvisor', 'sala' ); ?>"
												href="<?php echo esc_url($url_tripadvisor); ?>">
													<?php if ( $tooltip['style'] === 'text' ) : ?>
														<span><?php esc_html_e( 'Tripadvisor', 'sala' ); ?></span>
													<?php else: ?>
														<i class="fab fa-tripadvisor"></i>
													<?php endif; ?>
												</a>
												<?php
											}
										}
									}
								}
								?>
							</div>
						</div>
					</div>
				</div>
			<?php
			return ob_get_clean();
		}

		public static function mobile_menu_02() {
			$url_email              = Sala_Helper::setting( 'url_email' );
			$site_name 				= get_bloginfo('name', 'display');
			$logo_light        		= Sala_Helper::setting('logo_light');
			$logo_light_retina 		= Sala_Helper::setting('logo_light_retina');
			$custom_light_logo 		= Sala_Helper::get_post_meta( 'custom_light_logo', '' );

			if( $custom_light_logo !== '' ) {
				$logo_light = $custom_light_logo;
			}
			ob_start();
			?>
				<div class="bg-overlay"></div>

				<div class="site-menu area-menu mobile-menu mobile-menu-02">

					<div class="inner-menu custom-scrollbar">
						<div class="container">
							<div class="entry-top">
								<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr($site_name); ?>">
									<img class="site-dark-logo" src="<?php echo esc_url($logo_light); ?>" data-retina="<?php echo esc_attr($logo_light_retina); ?>" alt="<?php echo esc_attr($site_name); ?>">
								</a>
								<a href="#" class="btn-canvas-menu btn-close"><i class="fal fa-times-circle"></i></a>
							</div>
						</div>
						<div class="entry-mid">
							<?php
								if ( has_nav_menu( 'mobile_menu' ) ) {
									$theme_location = 'mobile_menu';
								}else{
									$theme_location = 'main_menu_02';
								}

								$args = array(
									'menu_class'     => 'menu',
									'container'      => '',
									'theme_location' => $theme_location,
								);

								if ( has_nav_menu( 'main_menu' ) && class_exists( 'Sala_Walker_Nav_Menu' ) ) {
									$args['walker'] = new Sala_Walker_Nav_Menu;
								}

								wp_nav_menu( $args );
							?>
						</div>

						<div class="entry-bottom align-center">
							<?php if( ! empty($url_email) ) : ?>
								<a href="mailto:<?php echo esc_attr($url_email); ?>"><?php echo sprintf( esc_html__( '%s', 'sala' ), $url_email ); ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php
			return ob_get_clean();
		}

		public static function canvas_menu() {
            $canvas_menu_sidebar_skin     = Sala_Helper::setting('canvas_menu_sidebar_skin');
            $canvas_menu_sidebar_position = Sala_Helper::setting('canvas_menu_sidebar_position');
            $canvas_menu_desktop_hidden   = Sala_Helper::setting('canvas_menu_desktop_hidden');
            $canvas_menu_tablet_hidden    = Sala_Helper::setting('canvas_menu_tablet_hidden');
            $canvas_menu_mobile_hidden    = Sala_Helper::setting('canvas_menu_mobile_hidden');

            $classes = array('canvas-menu', 'ux-element', 'mb-menu', $canvas_menu_sidebar_skin, $canvas_menu_sidebar_position);
            if( $canvas_menu_desktop_hidden ) {
                $classes[] = 'hidden-on-desktop';
            }
            if( $canvas_menu_tablet_hidden ) {
                $classes[] = 'hidden-on-tablet';
            }
            if( $canvas_menu_mobile_hidden ) {
                $classes[] = 'hidden-on-mobile';
            }

			ob_start();
			?>
				<div class="<?php echo join(' ', $classes); ?>" data-id="canvas-menu">
					<a href="#" class="icon-menu">
					<svg width="30px" height="14px" viewBox="0 0 30 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
						<g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							<g transform="translate(-50.000000, -33.000000)" fill="#111111">
								<g id="off-menu" transform="translate(50.000000, 28.000000)">
									<g id="icon-menu" transform="translate(0.000000, 5.000000)">
										<rect id="Rectangle-1" x="0" y="0" width="30" height="3" rx="1.5"></rect>
										<rect id="Rectangle-2" x="0" y="11" width="20" height="3" rx="1.5"></rect>
									</g>
								</g>
							</g>
						</g>
					</svg>
					</a>

					<?php echo self::mobile_menu(); ?>
				</div>
			<?php
			return ob_get_clean();
		}

		public static function canvas_menu_02() {
            $canvas_menu_02_sidebar_skin     = Sala_Helper::setting('canvas_menu_02_sidebar_skin');
            $canvas_menu_02_sidebar_position = Sala_Helper::setting('canvas_menu_02_sidebar_position');
            $canvas_menu_02_desktop_hidden   = Sala_Helper::setting('canvas_menu_02_desktop_hidden');
            $canvas_menu_02_tablet_hidden    = Sala_Helper::setting('canvas_menu_02_tablet_hidden');
            $canvas_menu_02_mobile_hidden    = Sala_Helper::setting('canvas_menu_02_mobile_hidden');

            $classes = array('canvas-menu', 'ux-element', 'mb-menu', $canvas_menu_02_sidebar_skin, $canvas_menu_02_sidebar_position);
            if( $canvas_menu_02_desktop_hidden ) {
                $classes[] = 'hidden-on-desktop';
            }
            if( $canvas_menu_02_tablet_hidden ) {
                $classes[] = 'hidden-on-tablet';
            }
            if( $canvas_menu_02_mobile_hidden ) {
                $classes[] = 'hidden-on-mobile';
            }

			ob_start();
			?>
				<div class="<?php echo join(' ', $classes); ?>" data-id="canvas-menu-02">
					<a href="#" class="icon-menu">
						<svg fill="none" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
							<circle cx="3" cy="3" r="3" fill="#333333"></circle>
							<circle cx="3" r="3" fill="#333333" cy="13"></circle>
							<circle cy="3" r="3" fill="#333333" cx="13"></circle>
							<circle r="3" fill="#333333" cx="13" cy="13"></circle>
						</svg>
					</a>

					<?php echo self::mobile_menu_02(); ?>
				</div>
			<?php
			return ob_get_clean();
		}

		public static function canvas_mb_menu() {
            $canvas_mb_menu_sidebar_skin     = Sala_Helper::setting('canvas_mb_menu_sidebar_skin');
            $canvas_mb_menu_sidebar_position = Sala_Helper::setting('canvas_mb_menu_sidebar_position');
            $canvas_mb_menu_desktop_hidden   = Sala_Helper::setting('canvas_mb_menu_desktop_hidden');
            $canvas_mb_menu_tablet_hidden    = Sala_Helper::setting('canvas_mb_menu_tablet_hidden');
            $canvas_mb_menu_mobile_hidden    = Sala_Helper::setting('canvas_mb_menu_mobile_hidden');

            $classes = array('canvas-mb-menu', 'canvas-menu', 'ux-element', 'mb-menu', $canvas_mb_menu_sidebar_skin, $canvas_mb_menu_sidebar_position);
            if( $canvas_mb_menu_desktop_hidden ) {
                $classes[] = 'hidden-on-desktop';
            }
            if( $canvas_mb_menu_tablet_hidden ) {
                $classes[] = 'hidden-on-tablet';
            }
            if( $canvas_mb_menu_mobile_hidden ) {
                $classes[] = 'hidden-on-mobile';
            }

			ob_start();
			?>
				<div class="<?php echo join(' ', $classes); ?>" data-id="canvas-mb-menu">
					<a href="#" class="icon-menu">
					<svg width="30px" height="14px" viewBox="0 0 30 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
						<g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							<g transform="translate(-50.000000, -33.000000)" fill="#111111">
								<g id="off-menu" transform="translate(50.000000, 28.000000)">
									<g id="icon-menu" transform="translate(0.000000, 5.000000)">
										<rect id="Rectangle-1" x="0" y="0" width="30" height="3" rx="1.5"></rect>
										<rect id="Rectangle-2" x="0" y="11" width="20" height="3" rx="1.5"></rect>
									</g>
								</g>
							</g>
						</g>
					</svg>
					</a>

					<?php echo self::mobile_menu(); ?>
				</div>
			<?php
			return ob_get_clean();
		}

		public static function header_device() {

			ob_start();
            ?>
			<div class="header-device ux-element line" data-id="header-device">
				<span class="primary-background"></span>
			</div>
			<?php
			return ob_get_clean();
		}

		public static function header_lang() {

            $header_lang_type           = Sala_Helper::setting('header_lang_type');
            $header_lang_option         = Sala_Helper::setting('header_lang_option');
            $header_lang_shortcode      = Sala_Helper::setting('header_lang_shortcode');
            $header_lang_desktop_hidden = Sala_Helper::setting('header_lang_desktop_hidden');
            $header_lang_tablet_hidden  = Sala_Helper::setting('header_lang_tablet_hidden');
            $header_lang_mobile_hidden  = Sala_Helper::setting('header_lang_mobile_hidden');

            $classes = array('header-lang', 'ux-element');
            if( $header_lang_desktop_hidden ) {
                $classes[] = 'hidden-on-desktop';
            }
            if( $header_lang_tablet_hidden ) {
                $classes[] = 'hidden-on-tablet';
            }
            if( $header_lang_mobile_hidden ) {
                $classes[] = 'hidden-on-mobile';
            }

			ob_start();
			?>
			<div class="<?php echo join(' ', $classes); ?>" data-id="header-lang">
				<div class="inner-lang hover-accent-color">
					<div class="chosen-lang <?php if( $header_lang_type == 'menu' ) : echo 'main-menu site-menu desktop-menu';endif; ?>">
                        <?php if( $header_lang_option ) { ?>
							<?php if ( $header_lang_type == 'shortcode' && $header_lang_shortcode ) { ?>
								<?php echo do_shortcode($header_lang_shortcode); ?>
							<?php }elseif( class_exists('SitePress') ){ ?>
								<?php do_action( 'wpml_add_language_selector' ); ?>
							<?php }elseif( $header_lang_type == 'menu' ){ ?>
								<?php
									$args = array();

									$defaults = array(
										'theme_location' => 'lang_menu',
										'container'      => 'ul',
										'menu_class'     => 'menu sm sm-simple',
										'extra_class'    => '',
									);

									$args = wp_parse_args( $args, $defaults );

									if ( has_nav_menu( 'lang_menu' ) && class_exists( 'Sala_Walker_Nav_Menu' ) ) {
										$args['walker'] = new Sala_Walker_Nav_Menu;
									}

									if ( has_nav_menu( 'lang_menu' ) ) {
										wp_nav_menu( $args );
									}
								?>
							<?php }else{ ?>
								<select name="site_lang">
									<?php foreach ($header_lang_option as $lang) { ?>
									<option value="<?php echo esc_attr($lang['name']); ?>"><?php echo esc_html($lang['label']); ?></option>
									<?php } ?>
								</select>
							<?php } ?>
                        <?php } ?>
					</div>
				</div>
			</div>
			<?php
			return ob_get_clean();
		}

		public static function header_contact() {

            $header_contact_info           = Sala_Helper::setting('header_contact_info');
            $header_contact_info_blank     = Sala_Helper::setting('header_contact_info_blank');
            $header_contact_info_show_text = Sala_Helper::setting('header_contact_info_show_text');
            $header_contact_info_show_icon = Sala_Helper::setting('header_contact_info_show_icon');

			$header_contact_desktop_hidden = Sala_Helper::setting('header_contact_desktop_hidden');
			$header_contact_tablet_hidden  = Sala_Helper::setting('header_contact_tablet_hidden');
			$header_contact_mobile_hidden  = Sala_Helper::setting('header_contact_mobile_hidden');

            $target_blank = '';
            if( $header_contact_info_blank ) {
                $target_blank = 'target=_blank';
            }

            $classes = array('header-contact', 'ux-element');

			if( $header_contact_desktop_hidden ) {
				$classes[] = 'hidden-on-desktop';
			}
			if( $header_contact_tablet_hidden ) {
				$classes[] = 'hidden-on-tablet';
			}
			if( $header_contact_mobile_hidden ) {
				$classes[] = 'hidden-on-mobile';
			}

			ob_start();
			?>
				<div class="<?php echo join(' ', $classes); ?>" data-id="header-contact">
					<ul>
                        <?php foreach( $header_contact_info as $info ) { ?>
                        <li>
                            <a href="<?php echo esc_attr($info['link_url']); ?>" <?php echo esc_attr($target_blank); ?>>
                                <?php if ( $header_contact_info_show_icon == 'show' ) : ?>
                                    <i class="<?php echo esc_attr($info['icon_class']); ?>"></i>
                                <?php endif; ?>
                                <?php if ( $header_contact_info_show_text == 'show' ) : ?>
                                    <span><?php echo esc_html($info['text']); ?></span>
                                <?php endif; ?>
                            </a>
                        </li>
                        <?php } ?>
					</ul>
				</div>
			<?php
			return ob_get_clean();
		}

		public static function header_account() {
			$header_account_text             = Sala_Helper::setting('header_account_text');
			$header_account_blank            = Sala_Helper::setting('header_account_blank');
			$header_account_link             = Sala_Helper::setting('header_account_link');
			$header_account_popup         	 = Sala_Helper::setting('header_account_popup');
			$header_account_icon          	 = Sala_Helper::setting('header_account_icon');
			$header_account_icon_position 	 = Sala_Helper::setting('header_account_icon_position');
			$header_account_size             = Sala_Helper::setting('header_account_size');
			$header_account_align            = Sala_Helper::setting('header_account_align');
			$header_account_width            = Sala_Helper::setting('header_account_width');
			$header_account_desktop_hidden   = Sala_Helper::setting('header_account_desktop_hidden');
			$header_account_tablet_hidden    = Sala_Helper::setting('header_account_tablet_hidden');
			$header_account_mobile_hidden    = Sala_Helper::setting('header_account_mobile_hidden');

			$target_blank 	= '';
			$signin 		= get_the_permalink(get_theme_mod( 'sign_in' ));

			if( $header_account_blank ) {
				$target_blank = 'target=_blank';
			}

			if( $header_account_text == '' ) {
				$header_account_text = 'Log In';
			}


			if( $header_account_link ){
				$signin = $header_account_link;
			}

			$classes = array('header-account', 'ux-element', $header_account_align);
            if( $header_account_desktop_hidden ) {
                $classes[] = 'hidden-on-desktop';
            }
            if( $header_account_tablet_hidden ) {
                $classes[] = 'hidden-on-tablet';
            }
            if( $header_account_mobile_hidden ) {
                $classes[] = 'hidden-on-mobile';
            }
			$classes[] = 'icon-' . $header_account_icon_position;

			ob_start();
			?>
				<div class="<?php echo join(' ', $classes); ?>" data-id="header-account">
					<?php
						if ( is_user_logged_in() ) :
							$current_user = wp_get_current_user();
					?>
						<a href="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') )); ?>" <?php echo esc_attr($target_blank); ?> class="sala-button size-<?php echo esc_attr($header_account_size); ?>">
							<?php if( $header_account_icon !== 'none' && $header_account_icon_position == 'before' ) { ?>
								<i class="<?php echo esc_html($header_account_icon); ?>"></i>
							<?php } ?>
							<?php echo esc_html($current_user->display_name); ?>
							<?php if( $header_account_icon !== 'none' && $header_account_icon_position == 'after' ) { ?>
								<i class="<?php echo esc_html($header_account_icon); ?>"></i>
							<?php } ?>
						</a>
					<?php
						else :
					?>
						<a href="<?php echo esc_url($signin); ?>" <?php echo esc_attr($target_blank); ?> class="sala-button size-<?php echo esc_attr($header_account_size); ?>">
							<?php if( $header_account_icon !== 'none' && $header_account_icon_position == 'before' ) { ?>
								<i class="<?php echo esc_html($header_account_icon); ?>"></i>
							<?php } ?>
							<?php echo esc_html( $header_account_text, 'sala' ); ?>
							<?php if( $header_account_icon !== 'none' && $header_account_icon_position == 'after' ) { ?>
								<i class="<?php echo esc_html($header_account_icon); ?>"></i>
							<?php } ?>
						</a>
					<?php
						endif;
					?>
				</div>
			<?php
			return ob_get_clean();
		}

		public static function header_cart() {

			$header_cart_popup   			= Sala_Helper::setting('header_cart_popup');
			$header_cart_desktop_hidden   	= Sala_Helper::setting('header_cart_desktop_hidden');
			$header_cart_tablet_hidden    	= Sala_Helper::setting('header_cart_tablet_hidden');
			$header_cart_mobile_hidden    	= Sala_Helper::setting('header_cart_mobile_hidden');

			if( $header_cart_desktop_hidden ) {
                $classes[] = 'hidden-on-desktop';
            }
            if( $header_cart_tablet_hidden ) {
                $classes[] = 'hidden-on-tablet';
            }
            if( $header_cart_mobile_hidden ) {
                $classes[] = 'hidden-on-mobile';
            }

			$classes = array('header-cart', 'ux-element');

			ob_start();
			?>
			<div class="<?php echo join(' ', $classes); ?>" data-id="header-cart">
				<div class="minicart canvas-menu canvas-right">
					<a href="<?php echo esc_url( get_permalink( wc_get_page_id('cart') ) ); ?>" class="icon-menu toggle" aria-label="<?php esc_attr_e('Shopping Cart', 'sala') ?>">
						<i class="fal fa-shopping-cart"></i>
						<span class="cart-count">(<span><?php echo WC()->cart->cart_contents_count; ?></span>)</span>
					</a>

					<div class="bg-overlay"></div>
					<div class="area-menu">
						<div class="inner-menu custom-scrollbar">
							<a href="#" class="btn-close"><i class="fal fa-times"></i></a>
							<div class="widget_shopping_cart_content"><?php wc_get_template('cart/mini-cart.php'); ?></div>
						</div>
					</div>
				</div>
			</div>
			<?php
			return ob_get_clean();
		}

		public static function header_button_01() {
			$header_button_text             = Sala_Helper::setting('header_button_01_text');
			$header_button_link             = Sala_Helper::setting('header_button_01_link', '#');
			$header_button_blank            = Sala_Helper::setting('header_button_01_blank');
			$header_button_01_icon          = Sala_Helper::setting('header_button_01_icon');
			$header_button_01_icon_mb_show 	= Sala_Helper::setting('header_button_01_icon_mb_show');
			$header_button_01_icon_position = Sala_Helper::setting('header_button_01_icon_position');
			$header_button_size             = Sala_Helper::setting('header_button_01_size');
			$header_button_align            = Sala_Helper::setting('header_button_01_align');
			$header_button_width            = Sala_Helper::setting('header_button_01_width');
			$header_button_desktop_hidden   = Sala_Helper::setting('header_button_01_desktop_hidden');
			$header_button_tablet_hidden    = Sala_Helper::setting('header_button_01_tablet_hidden');
			$header_button_mobile_hidden    = Sala_Helper::setting('header_button_01_mobile_hidden');
			$target_blank = '';
			if( $header_button_blank ) {
				$target_blank = 'target=_blank';
			}
			$classes = array('header-button-01', 'ux-element', $header_button_align);
            if( $header_button_desktop_hidden ) {
                $classes[] = 'hidden-on-desktop';
            }
            if( $header_button_tablet_hidden ) {
                $classes[] = 'hidden-on-tablet';
            }
            if( $header_button_mobile_hidden ) {
                $classes[] = 'hidden-on-mobile';
            }
			if( $header_button_01_icon_mb_show == 'false' ){
				$classes[] = 'icon-on-mobile';
			}
			$classes[] = 'icon-' . $header_button_01_icon_position;

			ob_start();
			?>
				<div class="<?php echo join(' ', $classes); ?>" data-id="header-button-01">
					<a href="<?php echo esc_attr($header_button_link); ?>" <?php echo esc_attr($target_blank); ?> class="sala-button full-filled size-<?php echo esc_attr($header_button_size); ?>">
						<?php if( $header_button_01_icon !== 'none' && $header_button_01_icon_position == 'before' ) { ?>
							<i class="<?php echo esc_html($header_button_01_icon); ?>"></i>
						<?php } ?>
						<?php echo esc_html($header_button_text); ?>
						<?php if( $header_button_01_icon !== 'none' && $header_button_01_icon_position == 'after' ) { ?>
							<i class="<?php echo esc_html($header_button_01_icon); ?>"></i>
						<?php } ?>
					</a>
				</div>
			<?php
			return ob_get_clean();
		}

		public static function header_search_icon() {
			$header_search_icon_desktop_hidden = Sala_Helper::setting('header_search_icon_desktop_hidden');
			$header_search_icon_tablet_hidden  = Sala_Helper::setting('header_search_icon_tablet_hidden');
			$header_search_icon_mobile_hidden  = Sala_Helper::setting('header_search_icon_mobile_hidden');

			$classes = array('header-search-icon', 'ux-element');
            if( $header_search_icon_desktop_hidden ) {
                $classes[] = 'hidden-on-desktop';
            }
            if( $header_search_icon_tablet_hidden ) {
                $classes[] = 'hidden-on-tablet';
            }
            if( $header_search_icon_mobile_hidden ) {
                $classes[] = 'hidden-on-mobile';
			}

			ob_start();
			?>
				<div class="<?php echo join(' ', $classes); ?>" data-id="header-search-icon">
					<div class="icon-search">
						<a href="#canvas-search" class="btn-sala-popup"><i class="far fa-search large"></i></a>
					</div>
				</div>
			<?php
			return ob_get_clean();
		}

		public static function header_search_input() {
			$header_search_input_desktop_hidden = Sala_Helper::setting('header_search_input_desktop_hidden');
			$header_search_input_tablet_hidden  = Sala_Helper::setting('header_search_input_tablet_hidden');
			$header_search_input_mobile_hidden  = Sala_Helper::setting('header_search_input_mobile_hidden');

			$classes = array('header-search-input', 'ux-element');
            if( $header_search_input_desktop_hidden ) {
                $classes[] = 'hidden-on-desktop';
            }
            if( $header_search_input_tablet_hidden ) {
                $classes[] = 'hidden-on-tablet';
            }
            if( $header_search_input_mobile_hidden ) {
                $classes[] = 'hidden-on-mobile';
			}

			ob_start();
			?>
				<div class="<?php echo join(' ', $classes); ?>" data-id="header-search-input">
					<?php echo self::search_form(); ?>
				</div>
			<?php
			return ob_get_clean();
		}

		public static function header_custom_html_01() {
			$header_custom_html_01_content = Sala_Helper::setting('header_custom_html_01_content');

			$classes = array('header-custom-html-01', 'ux-element');
			ob_start();
			?>
				<div class="<?php echo join(' ', $classes); ?>" data-id="header-custom-html-01">
					<?php echo wp_kses($header_custom_html_01_content, Sala_Helper::sala_kses_allowed_html()); ?>
				</div>
			<?php
			return ob_get_clean();
        }

		public static function header_custom_html_02() {
			$header_custom_html_02_content = Sala_Helper::setting('header_custom_html_02_content');

			$classes = array('header-custom-html-02', 'ux-element');
			ob_start();
			?>
				<div class="<?php echo join(' ', $classes); ?>" data-id="header-custom-html-02">
					<?php echo wp_kses($header_custom_html_02_content, Sala_Helper::sala_kses_allowed_html()); ?>
				</div>
			<?php
			return ob_get_clean();
        }

		public static function canvas_search() {

			?>
				<div id="canvas-search" class="sala-popup popup-search">
					<div class="bg-overlay"></div>
					<a href="#" class="btn-canvas-menu btn-close"><i class="fal fa-times"></i></a>
					<div class="inner-popup">
						<?php echo self::search_form(); ?>
					</div>
				</div>
			<?php
		}

		public static function search_form() {

			$ajax_search = true;

			$classes = array( 'search-form' );

			if ( $ajax_search ) {
				$classes[] = 'ajax-search-form';
			}

			$post_type    = 'post';
			$place_holder = esc_html__( 'Search...', 'sala' );

			ob_start();
			?>
				<div class="<?php echo join( ' ', $classes ); ?>">
					<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="search-form">
						<div class="area-search form-field">
							<button type="submit" class="icon-search"><i class="far fa-search large"></i></button>
							<div class="form-field input-field">
								<input name="s" class="input-search" type="text" value="<?php echo get_search_query(); ?>" placeholder="<?php echo esc_attr( $place_holder ); ?>" autocomplete="off" />
								<input type="hidden" name="post_type" class="post-type" value="<?php echo esc_attr( $post_type ); ?>"/>
								<div class="search-result area-result"></div>
								<div class="sala-loading-effect"><span class="sala-dual-ring"></span></div>

								<?php
									$place_categories = get_categories(array(
										'taxonomy'   => 'categories',
										'hide_empty' => 1,
										'orderby'    => 'term_id',
										'order'      => 'ASC'
									));
								?>
								<?php if($place_categories) : ?>
								<div class="list-categories">
									<ul>
										<?php
										$image_src = SALA_THEME_DIR . 'assets/images/no-image.jpg';
										foreach ($place_categories as $cate) {
											$cate_id   = $cate->term_id;
											$cate_name = $cate->name;
											$cate_slug = $cate->slug;
										?>
											<li>
												<a class="entry-category" href="<?php echo get_term_link($cate); ?>">
													<span><?php echo esc_html($cate_name); ?></span>
												</a>
											</li>
										<?php } ?>
									</ul>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</form>
				</div>
			<?php
			return ob_get_clean();
		}

		/**
		 * Render Comments
		 */
		public static function render_comments($comment, $args, $depth) {
			Sala_Helper::sala_get_template('comment', array('comment' => $comment, 'args' => $args, 'depth' => $depth));
		}

		public static function render_button( $args ) {
			$defaults = [
				'text'          => '',
				'link'          => [
					'url'         => '',
					'is_external' => false,
					'nofollow'    => false,
				],
				'style'         => 'flat',
				'size'          => 'sm',
				'icon'          => '',
				'icon_align'    => 'left',
				'extra_class'   => '',
				'class'         => 'sala-button',
				'id'            => '',
				'wrapper_class' => '',
			];

			$args = wp_parse_args( $args, $defaults );
			extract( $args );

			$button_attrs = [];

			$button_classes   = [ $class ];
			$button_classes[] = $style;
			$button_classes[] = 'size-' . $size;

			if ( ! empty( $extra_class ) ) {
				$button_classes[] = $extra_class;
			}

			if ( ! empty( $icon ) ) {
				$button_classes[] = 'icon-' . $icon_align;
			}

			$button_attrs['class'] = implode( ' ', $button_classes );

			if ( ! empty( $id ) ) {
				$button_attrs['id'] = $id;
			}

			$button_tag = 'div';

			if ( ! empty( $link['url'] ) ) {
				$button_tag = 'a';

				$button_attrs['href'] = $link['url'];

				if ( ! empty( $link['is_external'] ) ) {
					$button_attrs['target'] = '_blank';
				}

				if ( ! empty( $link['nofollow'] ) ) {
					$button_attrs['rel'] = 'nofollow';
				}
			}

			$attributes_str = '';

			if ( ! empty( $button_attrs ) ) {
				foreach ( $button_attrs as $attribute => $value ) {
					$attributes_str .= ' ' . $attribute . '="' . esc_attr( $value ) . '"';
				}
			}

			$wrapper_classes = 'sala-button-wrapper';
			if ( ! empty( $wrapper_class ) ) {
				$wrapper_classes .= " $wrapper_class";
			}
			?>
			<div class="<?php echo esc_attr( $wrapper_classes ); ?>">
				<?php printf( '<%1$s %2$s>', $button_tag, $attributes_str ); ?>
				<div class="button-content-wrapper">

					<?php if ( ! empty( $icon ) && 'left' === $icon_align ): ?>
						<span class="button-icon"><i class="<?php echo esc_attr( $icon ); ?>"></i></span>
					<?php endif; ?>

					<?php if ( ! empty( $text ) ): ?>
						<span class="button-text"><?php echo esc_html( $text ); ?></span>
					<?php endif; ?>

					<?php if ( ! empty( $icon ) && 'right' === $icon_align ): ?>
						<span class="button-icon"><i class="<?php echo esc_attr( $icon ); ?>"></i></span>
					<?php endif; ?>
				</div>
				<?php printf( '</%1$s>', $button_tag ); ?>
			</div>
			<?php
		}

		public static function get_sharing_list( $args = array() ) {
			$defaults = array(
				'style'            => 'icons',
				'target'           => '_blank',
				'tooltip_enable'   => true,
				'tooltip_skin'     => 'primary',
				'tooltip_position' => 'top',
			);
			$args = wp_parse_args( $args, $defaults );
			$social_sharing_item_enable = Sala_Helper::setting( 'social_sharing_item_enable', '1' );
			if ( ! empty( $social_sharing_item_enable ) ) {
				$social_sharing_order = Sala_Helper::setting( 'social_sharing_order' );
				$link_classes = '';

				if ( $args['tooltip_enable'] === true ) {
					$link_classes .= "hint--bounce hint--{$args['tooltip_position']} hint--{$args['tooltip_skin']}";
				}

				foreach ( $social_sharing_order as $social ) {
					if ( in_array( $social, $social_sharing_item_enable, true ) ) {
						if ( $social === 'facebook' ) {
							$facebook_url = 'https://m.facebook.com/sharer.php?u=' . rawurlencode( get_permalink() );
							?>
							<a class="<?php echo esc_attr( $link_classes . ' facebook' ); ?>"
							   target="<?php echo esc_attr( $args['target'] ); ?>"
							   aria-label="<?php esc_attr_e( 'Facebook', 'sala' ); ?>"
							   href="<?php echo esc_url( $facebook_url ); ?>">
								<?php if ( $args['style'] === 'text' ) : ?>
									<span><?php esc_html_e( 'Facebook', 'sala' ); ?></span>
								<?php else: ?>
									<i class="fab fa-facebook-f"></i>
								<?php endif; ?>
							</a>
							<?php
						} elseif ( $social === 'twitter' ) {
							?>
							<a class="<?php echo esc_attr( $link_classes . ' twitter' ); ?>"
							   target="<?php echo esc_attr( $args['target'] ); ?>"
							   aria-label="<?php esc_attr_e( 'Twitter', 'sala' ); ?>"
							   href="https://twitter.com/share?text=<?php echo rawurlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) ); ?>&url=<?php echo rawurlencode( get_permalink() ); ?>">
								<?php if ( $args['style'] === 'text' ) : ?>
									<span><?php esc_html_e( 'Twitter', 'sala' ); ?></span>
								<?php else: ?>
									<i class="fab fa-twitter"></i>
								<?php endif; ?>
							</a>
							<?php
						} elseif ( $social === 'tumblr' ) {
							?>
							<a class="<?php echo esc_attr( $link_classes . ' tumblr' ); ?>"
							   target="<?php echo esc_attr( $args['target'] ); ?>"
							   aria-label="<?php esc_attr_e( 'Tumblr', 'sala' ); ?>"
							   href="https://www.tumblr.com/share/link?url=<?php echo rawurlencode( get_permalink() ); ?>&amp;name=<?php echo rawurlencode( get_the_title() ); ?>">
								<?php if ( $args['style'] === 'text' ) : ?>
									<span><?php esc_html_e( 'Tumblr', 'sala' ); ?></span>
								<?php else: ?>
									<i class="fab fa-tumblr-square"></i>
								<?php endif; ?>
							</a>
							<?php
						} elseif ( $social === 'linkedin' ) {
							?>
							<a class="<?php echo esc_attr( $link_classes . ' linkedin' ); ?>"
							   target="<?php echo esc_attr( $args['target'] ); ?>"
							   aria-label="<?php esc_attr_e( 'Linkedin', 'sala' ); ?>"
							   href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo rawurlencode( get_permalink() ); ?>&amp;title=<?php echo rawurlencode( get_the_title() ); ?>">
								<?php if ( $args['style'] === 'text' ) : ?>
									<span><?php esc_html_e( 'Linkedin', 'sala' ); ?></span>
								<?php else: ?>
									<i class="fab fa-linkedin"></i>
								<?php endif; ?>
							</a>
							<?php
						} elseif ( $social === 'email' ) {
							?>
							<a class="<?php echo esc_attr( $link_classes . ' email' ); ?>"
							   target="<?php echo esc_attr( $args['target'] ); ?>"
							   aria-label="<?php esc_attr_e( 'Email', 'sala' ); ?>"
							   href="mailto:?subject=<?php echo rawurlencode( get_the_title() ); ?>&amp;body=<?php echo rawurlencode( get_permalink() ); ?>">
								<?php if ( $args['style'] === 'text' ) : ?>
									<span><?php esc_html_e( 'Email', 'sala' ); ?></span>
								<?php else: ?>
									<i class="fas fa-envelope"></i>
								<?php endif; ?>
							</a>
							<?php
						}
					}
				}
			}
		}

		/**
		 * Display navigation to next/previous set of posts when applicable.
		 */
		public static function pagination( $pagination_position = 'center', $pagination_type = 'infinite' ) {

			global $wp_query, $wp_rewrite;

			// Don't print empty markup if there's only one page.
			if ( $wp_query->max_num_pages < 2 ) {
				return;
			}

			$layout = '';
			if ( Sala_Post::instance()->is_archive() ) {
				$layout              = Sala_Helper::setting( 'blog_archive_post_layout' );
				$pagination_position = Sala_Helper::setting( 'blog_archive_pagination_position' );
				$pagination_type     = Sala_Helper::setting( 'blog_archive_pagination_type' );
			} elseif ( class_exists( 'Sala_Portfolio' ) && Sala_Portfolio::instance()->is_archive() ) {
				$layout              = Sala_Helper::setting( 'portfolio_archive_post_layout' );
				$pagination_position = Sala_Helper::setting( 'portfolio_archive_pagination_position' );
				$pagination_type     = Sala_Helper::setting( 'portfolio_archive_pagination_type' );

			} elseif ( Sala_Woo::instance()->is_product_archive() ) {
				$layout              = Sala_Helper::setting( 'product_archive_layout' );
				$pagination_position = Sala_Helper::setting( 'product_archive_pagination_position' );
				$pagination_type     = Sala_Helper::setting( 'product_archive_pagination_type' );
			}

			$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
			$pagenum_link = wp_kses( get_pagenum_link(), Sala_Helper::sala_kses_allowed_html() );
			$query_args   = array();
			$url_parts    = explode( '?', $pagenum_link );

			if ( isset( $url_parts[1] ) ) {
				wp_parse_str( $url_parts[1], $query_args );
			}

			$pagenum_link = esc_url( remove_query_arg( array_keys( $query_args ), $pagenum_link ) );
			$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

			$format = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link,
				'index.php' ) ? 'index.php/' : '';
			$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%',
				'paged' ) : '?paged=%#%';

			// Set up paginated links.
			$links = paginate_links( array(
				'format'    => $format,
				'total'     => $wp_query->max_num_pages,
				'current'   => $paged,
				'add_args'  => array_map( 'urlencode', $query_args ),
				'prev_text' => '<i class="far fa-long-arrow-left"></i>' . esc_html__('Prev', 'sala'),
				'next_text' => esc_html__('Next', 'sala') . '<i class="far fa-long-arrow-right"></i>',
				'type'      => 'list',
				'end_size'  => 1,
				'mid_size'  => 1,
			) );
			$pagination_classes = array('sala-pagination', $pagination_position, $pagination_type);

            if ($links) {
				$post_type  = get_post_type();
				$query_vars = $wp_query->query_vars;

				$query_vars['post_status'] = array('publish', 'private');
				$query_vars['paged']       = $paged;

				$sala_grid_query['action']        = "{$post_type}_infinite_load";
				$sala_grid_query['max_num_pages'] = $wp_query->max_num_pages;
				$sala_grid_query['found_posts']   = $wp_query->found_posts;
				$sala_grid_query['pagination_type'] = $pagination_type;
				$sala_grid_query['layout']  	  = $layout;
				$sala_grid_query['query_vars']    = $query_vars;
				$sala_grid_query				  = htmlspecialchars( wp_json_encode( $sala_grid_query ) );
				?>

				<input type="hidden" class="sala-query-input" <?php echo 'value="' . $sala_grid_query . '"'; ?>/>

				<?php
                switch ($pagination_type) {
                    case 'navigation':
                        ?>
							<div class="<?php echo join(' ', $pagination_classes); ?>">
								<?php echo wp_kses($links, Sala_Helper::sala_kses_allowed_html()); ?>
							</div><!-- .pagination -->
						<?php
                        break;

                    case 'loadmore':
                        ?>
							<div class="<?php echo join(' ', $pagination_classes); ?>">
								<a class="sala-loadmore-button sala-button border-line uppercase" href="#">
									<i class="fal fa-redo"></i>
									<?php esc_html_e('Load More', 'sala'); ?>
								</a>
								<div class="sala-loader"><div class="dot-spin"></div></div>
							</div><!-- .pagination -->
							<div class="sala-pagination-messages">
								<?php esc_html_e( 'End of Content', 'sala' ); ?>
							</div>
						<?php
                        break;

                    case 'infinite':
                            ?>
								<div class="<?php echo join(' ', $pagination_classes); ?>">
									<div class="sala-loader"><div class="dot-falling"></div></div>
								</div><!-- .pagination -->
								<div class="sala-pagination-messages">
									<?php esc_html_e( 'End of Content', 'sala' ); ?>
								</div>
							<?php
                            break;

                    default:

                        break;
                }
            }
		}

		public static function login_form() {
			ob_start();
			?>
				<form action="#" id="sala-login" class="form-account active" method="post">
					<div class="form-group">
						<label for="ip_email" class="label-field"><?php esc_html_e('Email*', 'sala'); ?></label>
						<input type="text" id="ip_email" class="form-control input-field" name="email">
					</div>
					<?php
						$forgot_password = get_theme_mod( 'forgot_password' );
					?>
					<div class="form-group">
						<label for="ip_password" class="label-field"><?php esc_html_e('Password*', 'sala'); ?><a class="btn-reset-password" href="<?php echo get_permalink($forgot_password); ?>"><?php esc_html_e('Forgot password?', 'sala'); ?></a></label>
						<div class="password-input"><input type="password" id="ip_password" class="form-control input-field" name="password"></div>
					</div>
					<div class="form-group">
						<label class="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="yes"><span><?php esc_html_e('Remember Me', 'sala'); ?></span></label>
					</div>

					<p class="msg"><?php esc_html_e('Sending login info,please wait...', 'sala'); ?></p>

					<div class="form-group">
						<button type="submit" class="gl-button btn button" value="<?php esc_attr_e( 'Sign in', 'sala' ); ?>"><?php esc_html_e( 'Sign in', 'sala' ); ?></button>
						<div class="loading-effect"><span class="sala-dual-ring"></span></div>
					</div>
				</form>
			<?php
			return ob_get_clean();
		}

		public static function register_form() {
			ob_start();
			?>
				<form action="#" id="sala-register" class="form-account" method="post">
				<div class="form-group">
					<label for="ip_reg_firstname" class="label-field"><?php esc_html_e('First Name*', 'sala'); ?></label>
					<input type="text" id="ip_reg_firstname" placeholder="<?php esc_attr_e('ex: Kevin', 'sala'); ?>" class="form-control input-field" name="reg_firstname">
				</div>
				<div class="form-group">
					<label for="ip_reg_lastname" class="label-field"><?php esc_html_e('Last Name*', 'sala'); ?></label>
					<input type="text" id="ip_reg_lastname" placeholder="<?php esc_attr_e('ex: Kay', 'sala'); ?>" class="form-control input-field" name="reg_lastname">
				</div>
				<div class="form-group">
					<label for="ip_reg_email" class="label-field"><?php esc_html_e('Email*', 'sala'); ?></label>
					<input type="email" id="ip_reg_email" placeholder="<?php esc_attr_e('ex: kevin@uxper.co', 'sala'); ?>" class="form-control input-field" name="reg_email">
				</div>
				<div class="form-group">
					<label for="ip_reg_password" class="label-field"><?php esc_html_e('Password*', 'sala'); ?></label>
					<div class="password-input"><input type="password" id="ip_reg_password" placeholder="<?php esc_attr_e('********', 'sala'); ?>" class="form-control input-field" name="reg_password"></div>
				</div>
				<div class="form-group accept-account">
					<?php
						$terms 				= get_theme_mod( 'terms' );
						$privacy_policy 	= get_theme_mod( 'privacy_policy' );
					?>
					<label for="ip_accept_account"><input type="checkbox" id="ip_accept_account" class="form-control custom-checkbox" name="accept_account"><span><?php printf( esc_html__( 'I agree to the %1$s and %2$s', 'sala' ), '<a href="' . get_permalink($terms) . '" target="_Blank">' . esc_html__('Terms', 'sala') . '</a>', '<a href="' . get_permalink($privacy_policy) . '" target="_Blank">' . esc_html__('Privacy Policy', 'sala') . '</a></span>' ); ?></label>
				</div>

				<p class="msg"><?php esc_html_e('Sending register info,please wait...', 'sala'); ?></p>

				<div class="form-group">
					<button type="submit" class="gl-button btn button" value="<?php esc_attr_e( 'Sign in', 'sala' ); ?>"><?php esc_html_e( 'Sign up', 'sala' ); ?></button>
				</div>
				</form>
			<?php
			return ob_get_clean();
		}

		public static function forgot_form() {
			ob_start();
			?>
			<form method="post" id="forgot-form" class="forgot-form" enctype="multipart/form-data">
				<div class="form-group control-username">
					<input type="text" name="user_login" id="user_login" class="form-control control-icon" placeholder="<?php esc_attr_e('Enter your username or email', 'sala'); ?>">
					<?php wp_nonce_field('sala_reset_password_ajax_nonce', 'sala_security_reset_password'); ?>
					<input type="hidden" name="action" id="reset_password_action" value="sala_reset_password_ajax">
				</div>
				<p class="msg"><?php esc_html_e('Sending info,please wait...', 'sala'); ?></p>
				<div class="form-group">
					<button type="submit" id="sala_forgetpass" class="btn gl-button"><?php esc_html_e('Get new password', 'sala'); ?></button>
					<div class="loading-effect"><span class="sala-dual-ring"></span></div>
				</div>
			</form>
			<?php
			return ob_get_clean();
		}

		public static function reset_form() {
			ob_start();
			?>
			<form action="#" method="post" id="reset-form" class="reset-form">
				<div class="form-group control-password">
				<div class="password-input"><input name="new_password" type="password" id="new-password" class="form-control control-icon" placeholder="<?php esc_attr_e('Enter new password', 'sala'); ?>"></div>
				</div>
				<p class="msg"><?php esc_html_e('Sending info,please wait...', 'sala'); ?></p>
				<div class="button-wrap">
					<a href="#" class="generate-password"><?php esc_html_e('Generate Password', 'sala'); ?></a>
					<button type="submit" id="sala_newpass" class="btn gl-button"><?php esc_html_e('Save password', 'sala'); ?></button>
					<input type="hidden" name="login" id="login" value="<?php echo $_GET['login']; ?>">
				</div>
			</form>
			<?php
			return ob_get_clean();
		}

		public static function scroll_bar() {
			ob_start();
			?>
			<div class="scroll-bar-wrap">
				<div class="scroll-bar-current"></div>
			</div>
			<?php
			return ob_get_clean();
		}
	}

	new Sala_Templates();
}
