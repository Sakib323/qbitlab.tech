<?php 
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$post_id                            = get_the_ID();
$attach_id                          = get_post_thumbnail_id($post_id);
$single_post_display_featured_image = Sala_Helper::setting('single_post_display_featured_image');
$single_post_image_size             = Sala_Helper::setting('single_post_image_size');
$thumb_url                          = Sala_Helper::sala_image_resize($attach_id, $single_post_image_size);

if( empty($attach_id) || $single_post_display_featured_image == 'hide' ) {
	return;
}
?>
<div class="post-thumbnail sala-image">
	<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>">
</div>