<?php
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$single_portfolio_display_meta = Sala_Helper::setting('single_portfolio_display_meta');
if( $single_portfolio_display_meta == 'hide' ){
	return;
}
$portfolio_content_client 		= Sala_Helper::get_post_meta( 'portfolio_content_client', '' );
$portfolio_content_website 		= Sala_Helper::get_post_meta( 'portfolio_content_website', '' );
$terms = get_the_terms( get_the_ID(), 'portfolio_category' );
?>
<div class="portfolio-meta">
	<?php if( $portfolio_content_client ) { ?>
	<div class="portfolio-meta-item">
		<span class="title"><?php esc_html_e( 'Client', 'sala' ); ?></span>
		<span class="content"><?php echo esc_html( $portfolio_content_client ); ?></span>
	</div>
	<?php } ?>
	<?php if( get_the_date('F j, Y') ) { ?>
	<div class="portfolio-meta-item">
		<span class="title"><?php esc_html_e( 'Date', 'sala' ); ?></span>
		<span class="content"><?php echo get_the_date('F j, Y'); ?></span>
	</div>
	<?php } ?>
	<?php if( $terms ) { ?>
	<div class="portfolio-meta-item">
		<span class="title"><?php esc_html_e( 'Category', 'sala' ); ?></span>
		<span class="content"><a href="<?php echo esc_url(get_term_link( $terms[0]->term_id )); ?>"><?php echo esc_html( $terms[0]->name ); ?></a></span>
	</div>
	<?php } ?>
	<?php if( $portfolio_content_website ) { ?>
	<div class="portfolio-meta-item">
		<span class="title"><?php esc_html_e( 'Link', 'sala' ); ?></span>
		<span class="content"><a href="<?php echo esc_url( $portfolio_content_website ); ?>" target="_Blank"><?php esc_html_e( 'Website', 'sala' ); ?><i class="fal fa-external-link"></i></a></span>
	</div>
	<?php } ?>
</div>
