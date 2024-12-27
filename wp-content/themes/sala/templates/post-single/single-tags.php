<?php
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$post_id = get_the_ID();
$tags    = get_the_tags($post_id);
$single_post_display_tags = Sala_Helper::setting('single_post_display_tags');
if( empty($tags) || $single_post_display_tags == 'hide' ){
	return;
}
?>
<div class="post-tags">
	<span><?php echo esc_html( 'Tag', 'sala' ); ?></span>
	<?php
	foreach ($tags as $tag) {
		$tag_link = get_tag_link($tag->term_id);
	?>
		<a href="<?php echo esc_url($tag_link); ?>"><?php echo esc_html($tag->name); ?></a>
	<?php } ?>
</div>
