<?php
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$single_portfolio_display_title 		= Sala_Helper::setting('single_portfolio_display_title');
$single_portfolio_display_taxonomy 		= Sala_Helper::setting('single_portfolio_display_taxonomy');
?>
<div class="portfolio-title">
	<?php if( $single_portfolio_display_taxonomy === 'show' ) { ?>
	<div class="portfolio-cate">
		<?php
			$terms = get_the_terms( get_the_ID(), 'portfolio_category' );
			if( $terms ){
		?>
		<ul class="portfolio-taxonomy">
			<?php foreach( $terms as $term ){ ?>
			<li><a href="<?php echo esc_url(get_term_link( $term->term_id )); ?>"><?php echo esc_html( $term->name ); ?></a></li>
			<?php } ?>
		</ul>
		<?php } ?>
	</div>
	<?php } ?>
	<?php if( $single_portfolio_display_title === 'show' ) { ?>
    <h1 class="entry-title heading-font"><?php the_title(); ?></h1>
	<?php } ?>
</div>
