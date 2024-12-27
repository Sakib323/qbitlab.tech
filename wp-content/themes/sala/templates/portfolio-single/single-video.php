<?php
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$show_video = Sala_Helper::setting( 'single_portfolio_video_enable' );
$show_title_video = Sala_Helper::setting( 'single_portfolio_video_title_enable' );
if ( $show_video != 'show' ) {
	return;
}

?>
<div class="portfolio-video">
	<?php
		if( $show_title_video === 'show' ) {
	?>
	<div class="block-heading">
		<h3 class="entry-title"><?php esc_html_e( 'Intro Video', 'sala' ); ?></h3>
	</div>
	<?php } ?>
	<?php Sala_Portfolio::instance()->entry_video(); ?>
</div>

