<?php
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$single_portfolio_paginate = Sala_Helper::setting('single_portfolio_paginate');
if( $single_portfolio_paginate == 'hide' ){
	return;
}
?>
<div class="portfolio-paginate">
	<?php
		$prev_post = get_previous_post();
		if($prev_post) {
			$prev_title = strip_tags(str_replace('"', '', $prev_post->post_title));
			$thumbnail = get_the_post_thumbnail_url( $prev_post->ID, 'full' );
	?>
	<div class="paginate-item paginate-prev" style="background-image: url(<?php echo esc_url($thumbnail); ?>)">
		<span><?php esc_html_e( 'Back Project', 'sala' ); ?></span>
		<a rel="prev" href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" title="<?php echo esc_html($prev_title); ?>"><?php echo esc_html($prev_title); ?></a>
	</div>
	<?php } ?>

	<?php
		$next_post = get_next_post();
		if($next_post) {
			$next_title = strip_tags(str_replace('"', '', $next_post->post_title));
			$thumbnail = get_the_post_thumbnail_url( $next_post->ID, 'full' );
	?>
	<div class="paginate-item paginate-next" style="background-image: url(<?php echo esc_url($thumbnail); ?>)">
		<span><?php esc_html_e( 'Next Project', 'sala' ); ?></span>
		<a rel="prev" href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" title="<?php echo esc_html($next_title); ?>"><?php echo esc_html($next_title); ?></a>
	</div>
	<?php } ?>
</div>
