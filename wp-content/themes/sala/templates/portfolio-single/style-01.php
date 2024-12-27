<?php
/**
 * The template for displaying all single posts.
 *
 */
?>

<div class="site-content single-portfolio-01">

	<div id="primary" class="content-area">

		<?php
		/* Start the loop */
		while ( have_posts() ) : the_post();
		?>
			<div class="container">
				<div class="heading-portfolio">
					<?php get_template_part( 'templates/portfolio-single/single', 'title' ); ?>

					<?php get_template_part( 'templates/portfolio-single/single', 'excerpt' ); ?>

					<?php get_template_part( 'templates/portfolio-single/single', 'meta' ); ?>
				</div>

				<article <?php post_class('area-post'); ?>>

					<div class="inner-portfolio-wrap">

						<div class="portfolio-content">
							<?php
							the_content();
							?>
						</div>

					</div>

				</article>

			</div>

			<?php get_template_part( 'templates/portfolio-single/single', 'slider' ); ?>

			<div class="container">
				<?php get_template_part( 'templates/portfolio-single/single', 'video' ); ?>
			</div>

			<p class="thankyou"><?php esc_html_e( 'Thank you for watching!', 'sala' ); ?></p>

			<?php get_template_part( 'templates/portfolio-single/single', 'paginate' ); ?>

			<?php get_template_part( 'templates/portfolio-single/single', 'related' ); ?>

		<?php
		endwhile;
		/* End of the loop */
		?>

	</div>

</div>
