<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	)
);
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<div class="control-thumbnail">
		<figure class="woocommerce-product-gallery__wrapper sala-swiper-slider"
			data-lg-items="4"
			data-md-items="4"
			data-sm-items="4"
			data-lg-gutter="15"
			data-nav="1"
			data-pagination="0"
			data-vertical="vertical"
			data-loop="1"
			data-name="sala-product-detail-review"
			data-slidetoclickedslide = "1"
			data-centered="1"
			data-loopedslides="4"
		>
			<div class="swiper-inner">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<?php
						if ( $post_thumbnail_id ) {
							$html = Sala_Woo::sala_get_gallery_image_html( $post_thumbnail_id, true );
						} else {
							$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
							$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
							$html .= '</div>';
						}

						echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped

						do_action( 'woocommerce_product_thumbnails' );
						?>
					</div>
				</div>
			</div>
		</figure>
	</div>
	<div class="thumbnail-inner">
		<figure class="woocommerce-product-gallery__wrapper sala-product-detail-thumb sala-swiper-slider sala-slider"
			data-lg-items="1"
			data-md-items="1"
			data-sm-items="1"
			data-lg-gutter="0"
			data-nav="0"
			data-vertical="vertical"
			data-pagination="0"
			data-loop="1"
			data-simulatetouch="0"
			data-name="sala-product-detail-thumb"
			data-loopedslides="4"
		>
			<div class="swiper-inner">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<?php
						if ( $post_thumbnail_id ) {
							$html = Sala_Woo::sala_get_gallery_image_html( $post_thumbnail_id, true );
						} else {
							$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
							$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
							$html .= '</div>';
						}

						echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped

						do_action( 'woocommerce_product_thumbnails' );
						?>
					</div>
				</div>
			</div>
		</figure>
	</div>
</div>
