<?php
$excerpt                          = get_the_excerpt();
$blog_content_post_excerpt        = Sala_Helper::setting('blog_content_post_excerpt');
$blog_content_post_excerpt_number = Sala_Helper::setting('blog_content_post_excerpt_number');
if( empty($excerpt) || $blog_content_post_excerpt == 'hide' ) {
	return;
}
?>
<div class="post-excerpt">
	<p><?php echo wp_trim_words( get_the_excerpt($post->ID), $blog_content_post_excerpt_number, '...' ); ?></p>
</div>
