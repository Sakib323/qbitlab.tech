<?php 
$blog_content_post_categories = Sala_Helper::setting('blog_content_post_categories');
$blog_content_post_time       = Sala_Helper::setting('blog_content_post_time');
$blog_content_post_comment    = Sala_Helper::setting('blog_content_post_comment');

if( $blog_content_post_categories == 'hide' && $blog_content_post_time == 'hide' && $blog_content_post_comment == 'hide' ) {
	return;
}
?>
<div class="post-meta">
	<?php if( $blog_content_post_categories == 'show' ) : ?>
	<div class="post-cate">
		<?php echo get_the_category_list(); ?>
	</div>
	<?php endif; ?>	
	
	<?php if( $blog_content_post_time == 'show' ) : ?>
	<div class="post-time">
		<?php printf('<span>%1$s</span>', esc_html(get_the_time(get_option('date_format')))); ?>
	</div>
	<?php endif; ?>
	
	<?php if( $blog_content_post_comment == 'show' ) : ?>
	<div class="post-comment">
		<span>
		<i class="fal fa-comment-alt"></i>
		<?php
			$comments_number = get_comments_number();
			printf('(%1$s)', esc_html($comments_number));
		?>
		</span>
	</div>
	<?php endif; ?>
</div>
