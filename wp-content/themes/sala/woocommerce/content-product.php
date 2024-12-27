<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$product_id   = $product->get_id();
$product_name = get_the_title($product_id);

//Thumnail cropped
$image_size     = Sala_Helper::setting('product_archive_image_size', '370x420' );
$attach_id      = get_post_thumbnail_id($product_id);
$thumb_url      = Sala_Helper::sala_image_resize($attach_id, $image_size);
$attachment_ids = $product->get_gallery_image_ids();
if( !empty($attachment_ids) ) {
	$thumb_hover_url = Sala_Helper::sala_image_resize($attachment_ids[0], $image_size);
}

//Thumnail default woocommerce
$thumbnail = wp_get_attachment_image_src($attach_id,'woocommerce_thumbnail');
if( isset($attachment_ids, $attachment_ids[0]) ) {
	$thumbnail_hover = wp_get_attachment_image_src($attachment_ids[0],'woocommerce_thumbnail');
}else{
	$thumbnail_hover = '';
}
$thumbnail_cropped = get_query_var('thumbnail_cropped');
if( empty($image_size) ){
	if( isset($thumbnail[0]) ){
		if( $thumbnail_cropped == '' || $thumbnail_cropped == 'cropped' ){
			$thumb_url = $thumbnail[0];
			if( isset($thumbnail_hover[0]) ) {
				$thumb_hover_url = $thumbnail_hover[0];
			}
		}
	}
}

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$product_cat_list = get_the_terms( $product_id, 'product_cat' );

?>
<div <?php wc_product_class( 'grid-item', $product ); ?>>
	<div class="inner-item">
		<div class="entry-thumbnail">
			<?php
				/**
				 * Hook: woocommerce_before_shop_loop_item_title.
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
			<?php if(!empty($attach_id)){ ?>
				<a href="<?php echo get_permalink($product_id); ?>" title="<?php echo esc_attr($product_name); ?>">
					<img class="featured-thumbnail" src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($product_name); ?>">
					<?php if( !empty($attachment_ids[0]) ){ ?>
						<img class="hover-thumbnail" src="<?php echo esc_url($thumb_hover_url); ?>" alt="<?php echo esc_attr($product_name); ?>">
					<?php } ?>
				</a>
			<?php }else{ ?>
				<a href="<?php echo get_permalink($product_id); ?>" title="<?php echo esc_attr($product_name); ?>"><img class="placeholder" src="<?php echo esc_url( SALA_IMAGES . 'no-image.jpg'); ?>" alt="<?php echo esc_attr($product_name); ?>"></a>
			<?php } ?>
			<a href="<?php echo get_permalink($product_id); ?>" class="quickview"><?php echo esc_html__( 'Quick View', 'sala' ); ?></a>
		</div>

		<div class="entry-detail">
			<?php if($product_cat_list) { ?>
			<div class="product-categories">
				<?php foreach( $product_cat_list as $term ) { ?>
				<a href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a>
				<?php } ?>
			</div>
			<?php } ?>
			<div class="product-title">
				<h3 class="entry-title heading-font"><a href="<?php the_permalink($product_id); ?>"><?php echo esc_html(get_the_title($product_id)); ?></a></h3>
			</div>

			<?php
			/**
			 * Hook: woocommerce_after_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
		</div>

	</div>
</div>
