<?php
$portfolio_content_post_taxonomy 	= Sala_Helper::setting('portfolio_content_post_taxonomy');

if( $portfolio_content_post_taxonomy == 'hide' ) {
	return;
}
?>
<div class="portfolio-meta">
	<?php if( $portfolio_content_post_taxonomy == 'show' ) : ?>
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
	<?php endif; ?>
</div>
