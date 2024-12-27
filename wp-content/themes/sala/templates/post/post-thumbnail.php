<?php
$attach_id                    = get_post_thumbnail_id(get_the_ID());
$blog_archive_post_layout     = Sala_Helper::setting('blog_archive_post_layout');
$blog_content_post_image_size = Sala_Helper::setting('blog_content_post_image_size');
if($args){
	$blog_content_post_image_size = $args['image_size'];
}
$thumb_url                    = Sala_Helper::sala_image_resize($attach_id, $blog_content_post_image_size);
if( $blog_archive_post_layout == 'masonry' ) {
	$thumb_url = Sala_Helper::sala_image_resize($attach_id, 'full');
}
?>
<?php if ( has_post_thumbnail() ) : ?>
<div class="post-thumbnail sala-image">
	<a href="<?php the_permalink(); ?>">
		<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>">
	</a>
</div>
<?php endif; ?>
