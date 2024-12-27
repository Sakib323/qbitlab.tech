<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
?>

<div class="site-content">

	<div class="container">

		<div class="row">

			<?php Sala_Global::render_sidebar( 'left' ); ?>

			<div id="primary" class="content-area">

				<?php
					if ( woocommerce_product_loop() ) {

						/**
						 * Hook: woocommerce_before_shop_loop.
						 *
						 * @hooked woocommerce_output_all_notices - 10
						 * @hooked woocommerce_result_count - 20
						 * @hooked woocommerce_catalog_ordering - 30
						 */
						do_action( 'woocommerce_before_shop_loop' );

						if ( wc_get_loop_prop( 'total' ) ) {

							$product_archive_layout          = Sala_Helper::setting('product_archive_layout');
							$product_archive_pagination_type = Sala_Helper::setting('product_archive_pagination_type');
							$product_archive_desktop_column  = Sala_Helper::setting('product_archive_desktop_column');
							$product_archive_tablet_column   = Sala_Helper::setting('product_archive_tablet_column');
							$product_archive_mobile_column   = Sala_Helper::setting('product_archive_mobile_column');

							$archive_class = [
								'sala-grid',
								'sala-shop',
								'sala-animate-zoom-in',
								'sala-shop-' . $product_archive_layout,
								'grid-lg-' . $product_archive_desktop_column,
								'grid-md-' . $product_archive_tablet_column,
								'grid-sm-' . $product_archive_mobile_column
							];

							$grid_options = [
								'type'          => $product_archive_layout,
								'columns'       => $product_archive_desktop_column,
								'columnsTablet' => $product_archive_tablet_column,
								'columnsMobile' => $product_archive_mobile_column,
								'gutter'        => 30,
								'gutterTablet'  => 30,
								'RowGap'        => 50,
								'RowGapTablet'  => 30,
							];

						?>

						<div class="main-content">

							<div class="sala-grid-wrapper" data-pagination="<?php echo esc_attr($product_archive_pagination_type); ?>">

								<div class="<?php echo join(' ', $archive_class); ?>"  data-grid="<?php echo esc_attr( wp_json_encode( $grid_options ) ); ?>">

									<div class="grid-sizer"></div>

									<?php
										while ( have_posts() ) {
											the_post();

											/**
											 * Hook: woocommerce_shop_loop.
											 */
											do_action( 'woocommerce_shop_loop' );

											wc_get_template_part( 'content', 'product' );
										}
									}
									?>

								</div>

								<?php echo Sala_Templates::pagination(); ?>

							</div>

						</div>

						<?php

					} else {
						/**
						 * Hook: woocommerce_no_products_found.
						 *
						 * @hooked wc_no_products_found - 10
						 */
						do_action( 'woocommerce_no_products_found' );
					}

				?>

			</div>

			<?php Sala_Global::render_sidebar( 'right' ); ?>

		</div>

	</div>

</div>

<?php
get_footer( 'shop' );
