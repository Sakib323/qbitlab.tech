<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="custom-header" rel="home">
		<img src="<?php esc_url(header_image()); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr(get_bloginfo( 'title' )); ?>">
	</a>	
<?php endif; ?>
<div class="browse-head-section">
<header id="main-header" class="main-header">
	<?php do_action('storely_section_header'); ?>
	<div class="navigation-wrapper">
		<div class="navigation-middle">
			<div class="main-navigation-area d-none d-lg-block">
				<div class="main-navigation <?php echo esc_attr(storely_sticky_menu()); ?>">
					<div class="container">
						<div class="row navigation-middle-row align-items-center justify-content-between">
							<div class="col-lg-3 col-12">
								<div class="logo">
									<?php do_action('storely_logo'); ?>
								</div>
							</div>
							<div class="col-lg-6 col-12">
								<?php do_action('storely_hdr_product_search')?>
							</div>
							<div class="col-lg-3 col-12 mb-lg-0 mb-4 order-2">
								<div class="widget-left text-lg-left text-center w-100">
									<div class="main-navbar menu-bar flex-row-reverse">
										<?php 
											$shopiva_widget = 'storely-header-nav';
											if ( is_active_sidebar( $shopiva_widget ) ){ 
												dynamic_sidebar( 'storely-header-nav' );
											}elseif ( current_user_can( 'edit_theme_options' ) ) {
												?>
												<aside class="widget widget_nav_menu widget_none">
													<p>
														<?php if ( is_customize_preview() ) { ?>
															<a href="JavaScript:Void(0);" class="" data-sidebar-id="<?php echo esc_attr( $shopiva_widget ); ?>">
														<?php } else { ?>
															<a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>">
														<?php } ?>
															<?php esc_html_e( 'Please assign widget.', 'shopiva' ); ?>
														</a>
													</p>
												</aside>
												<?php
											} 
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="main-mobile-nav <?php echo esc_attr(storely_sticky_menu()); ?>">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="main-mobile-menu">
							<div class="main-menu-right main-mobile-left">
								<div class="logo">
									<?php do_action('storely_logo'); ?>
								</div>
							</div>
							<div class="menu-collapse-wrap">
								<div class="hamburger-menu">
									<button type="button" class="menu-collapsed" aria-label="<?php esc_attr_e('Menu Collaped','shopiva'); ?>">
										<div class="top-bun"></div>
										<div class="meat"></div>
										<div class="bottom-bun"></div>
									</button>
								</div>
							</div>
							<div class="main-mobile-wrapper">
								<div id="mobile-menu-build" class="main-mobile-build">
									<button type="button" class="header-close-menu close-style" aria-label="<?php esc_attr_e('Header Close Menu','shopiva'); ?>"></button>

									<?php do_action('storely_hdr_mobile_browse_cat')?>
								</div>
							</div>
							<?php if ( function_exists( 'ecommerce_companion_activate' ) ) : ?>
								<div class="header-above-wrapper">
									<div class="header-above-index">
										<div class="header-above-btn">
											<button type="button" class="header-above-collapse" aria-label="<?php esc_attr_e('Header Above Collapse','shopiva');?>"><span></span></button>
										</div>
										<div id="header-above-bar" class="header-above-bar"></div>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<!-- End: Main Header
=================================-->
<!--===// Start: Browse
=================================-->
<div id="browse-section" class="browse-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-12">
				<?php 
				$shopiva_hs_browse_cat		= get_theme_mod( 'hs_browse_cat','1');
				if($shopiva_hs_browse_cat=='1' && class_exists( 'woocommerce' )): ?>
					<div class="product-category-browse d-none d-lg-block <?php if(is_page_template( 'templates/template-homepage.php' ) && function_exists( 'ecommerce_companion_activate' )): esc_attr_e('active','shopiva'); endif;?>">
						<?php do_action('storely_hdr_browse_cat'); ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="col-lg-9 col-12 my-auto">
				<nav class="navbar-area d-none d-lg-flex">
					<div class="main-navbar col-9">
						<?php do_action('storely_main_nav'); ?>
					</div>
					<div class="main-menu-right col-3 ">
						<ul class="menu-right-list justify-content-between">
							<?php 
								do_action('storely_hdr_cart');
								do_action('storely_hdr_account');
							?>
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- End: Browse
=================================-->
</div>