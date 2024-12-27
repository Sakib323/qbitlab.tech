<?php
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$results = Sala_Portfolio::instance()->get_related_items( array(
	'post_id'      => get_the_ID(),
	'number_posts' => 3,
) );
$single_portfolio_display_related = Sala_Helper::setting('single_portfolio_display_related');
if( $single_portfolio_display_related == 'hide' ){
	return;
}
?>
<div class="portfolio-related">
    <div class="container">
		<div class="block-heading">
			<h3 class="entry-title"><?php esc_html_e('Related Project', 'sala'); ?></h3>
		</div>

		<div class="sala-swiper-slider sala-slider"
			data-lg-items="2"
			data-lg-gutter="60"
			data-md-gutter="30"
			data-sm-gutter="10"
			data-sm-items="1"
			data-nav="1"
			data-auto-height="0"
			data-slides-per-group="inherit"
			>
			<div class="swiper-inner">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<?php while ( $results->have_posts() ) : $results->the_post(); ?>
							<?php
								$post_id   = get_the_ID();
								$attach_id = get_post_thumbnail_id($post_id);
								$portfolio_content_post_image_size = Sala_Helper::setting('portfolio_content_post_image_size');
								$thumb_url = Sala_Helper::sala_image_resize($attach_id, $portfolio_content_post_image_size);
							?>
							<div class="swiper-slide">
								<article id="post-<?php the_ID(); ?>" <?php post_class( array('grid-item', 'sala-box') ); ?>>
									<?php if ( has_post_thumbnail() ) : ?>
									<div class="related-portfolio-thumbnail sala-image">
										<a href="<?php the_permalink(); ?>">
											<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>">
										</a>
									</div>
									<?php endif; ?>

									<div class="related-portfolio-detail">
										<div class="related-portfolio-meta">
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

										<?php if( !empty(get_the_title()) ) : ?>
										<div class="related-portfolio-title">
											<?php
											the_title( '<h3 class="entry-title heading-font"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
											?>
										</div>
										<?php endif; ?>
									</div>
								</article>
							</div>
						<?php wp_reset_postdata();endwhile; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
