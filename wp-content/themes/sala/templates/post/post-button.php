<?php
$blog_content_post_button        		= Sala_Helper::setting('blog_content_post_button');
if( $blog_content_post_button == 'hide' ) {
	return;
}
?>
<div class="btn-readmore">
	<a href="<?php the_permalink(); ?>">
		<?php esc_html_e('Read More', 'sala'); ?>
	</a>
</div>
