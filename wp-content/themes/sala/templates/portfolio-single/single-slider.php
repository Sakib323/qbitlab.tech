<?php
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$show_slider = Sala_Helper::setting( 'single_portfolio_gallery' );
if ( $show_slider === 'hide' ) {
	return;
}
$show_gallery_title 			= Sala_Helper::setting( 'single_portfolio_gallery_title' );
$sliders 						= Sala_Helper::get_post_meta( 'portfolio_content_gallery', '' );
$single_portfolio_layout 		= Sala_Helper::setting('single_portfolio_layout', '01');

$class_swiper = '';
if( $single_portfolio_layout === '03' ){
	$class_swiper = 'no-swiper';
} else {
	$class_swiper = 'sala-swiper-slider sala-slider';
}

if( empty($sliders) ){
	return;
}
?>
<div class="portfolio-slider">

	<?php if( $show_gallery_title === 'show' ){ ?>
	<div class="block-heading">
		<h3 class="entry-title"><?php esc_html_e( 'An explosive brand', 'sala' ); ?></h3>
		<p><?php esc_html_e( 'Duis sodales dolor nisl purus mollis. Cras dictum vitae est a lacinia. Nunc posuere sodales consequat.', 'sala' ); ?></p>
	</div>
	<?php } ?>

	<div class="<?php echo $class_swiper; ?>"
		data-lg-items="2"
		data-lg-gutter="30"
		data-sm-items="1"
		data-nav="0"
		data-centered="1"
		data-loop="1"
		data-pagination="1"
		data-auto-height="0"
		data-slides-per-group="inherit"
		>
		<div class="swiper-inner">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php foreach( $sliders as $slider ) { ?>
						<?php
							$thumb_url = $slider['url'];
						?>
						<div class="swiper-slide">
							<div class="item">
								<?php if ( $thumb_url ) : ?>
									<img src="<?php echo esc_url( $thumb_url ); ?>" alt="">
								<?php endif; ?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
