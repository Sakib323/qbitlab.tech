<?php

while ( $sala_query->have_posts() ) :
	$sala_query->the_post();
	$classes    = array( 'grid-item', 'post-item', 'sala-box' );
	$image_size = '';
	if( !empty($settings['thumbnail_size']) ) {
		if( $settings['thumbnail_size'] == 'custom' ) {
			if( !empty($settings['thumbnail_custom_dimension']['width']) && !empty($settings['thumbnail_custom_dimension']['height']) )
			$image_size = $settings['thumbnail_custom_dimension']['width'] . 'x' . $settings['thumbnail_custom_dimension']['height'];
		}else{
			$image_size = $settings['thumbnail_size'];
		}
	}

	?>
	<article id="portfolio-<?php the_ID(); ?>" <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="inner-portfolio-wrap">
			<?php if ( ! empty( $settings['show_thumbnail'] ) ) { ?>
				<?php get_template_part( 'templates/portfolio/portfolio', 'thumbnail', array( 'image_size' => $image_size ) ); ?>
			<?php } ?>
			<div class="portfolio-detail">
				<?php if ( $settings['show_meta_category'] === 'yes' ) : ?>
					<div class="portfolio-meta">

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

					</div>
				<?php endif; ?>
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
<?php
endwhile;
