<article id="portfolio-<?php the_ID(); ?>" <?php post_class( array('grid-item', 'sala-box') ); ?>>
	<div class="inner-portfolio-wrap">

		<?php get_template_part( 'templates/portfolio/portfolio', 'thumbnail' ); ?>

		<div class="portfolio-detail">

			<?php
				if ( 'portfolio' === get_post_type() ) :
					get_template_part( 'templates/portfolio/portfolio', 'meta' );
				endif;
			?>

			<?php if( !empty(get_the_title()) ) : ?>
			<div class="portfolio-title">
				<h3 class="entry-title heading-font">
					<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php echo get_the_title(); ?><?php if( is_sticky() ) { echo '<span>' . esc_html( 'Featured', 'sala' ) . '</span>'; } ?></a>
				</h3>
			</div>
			<?php endif; ?>

		</div>

	</div>
</article>
