<?php
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$single_post_display_categories    = Sala_Helper::setting('single_post_display_categories');
$single_post_display_comment_count = Sala_Helper::setting('single_post_display_comment_count');

if( $single_post_display_categories == 'hide' && $single_post_display_comment_count == 'hide' ) {
	return;
}
?>
<div class="post-meta">
	<?php if( $single_post_display_categories == 'show' ) : ?>
	<div class="post-cate">
		<?php echo get_the_category_list(); ?>
	</div>
	<?php endif; ?>

	<?php if( $single_post_display_comment_count == 'show' ) : ?>
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
