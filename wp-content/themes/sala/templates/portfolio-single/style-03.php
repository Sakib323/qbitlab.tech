<?php
/**
 * The template for displaying all single posts.
 *
 */
?>

<div class="site-content single-portfolio-03">

	<div id="primary" class="content-area">

		<?php
		/* Start the loop */
		while ( have_posts() ) : the_post();
		?>

			<div class="container">
				<div class="inner-content-wrap">

					<div class="inner-content-left">

						<div class="inner-content-left-wrap">

							<div class="inner-left-head">
								<?php get_template_part( 'templates/portfolio-single/single', 'title' ); ?>
							</div>

							<div class="inner-left-bottom">
								<?php get_template_part( 'templates/portfolio-single/single', 'meta' ); ?>

								<div class="info">
									<?php get_template_part( 'templates/portfolio-single/single', 'excerpt' ); ?>
									<?php get_template_part( 'templates/portfolio-single/single', 'author' ); ?>
								</div>

							</div>

						</div>

					</div>

					<div class="inner-content-right">

						<?php get_template_part( 'templates/portfolio-single/single', 'slider' ); ?>

						<p class="thankyou"><?php esc_html_e( 'Thank you for watching!', 'sala' ); ?></p>

					</div>
				</div>
			</div>

			<?php get_template_part( 'templates/portfolio-single/single', 'paginate' ); ?>

			<?php get_template_part( 'templates/portfolio-single/single', 'related' ); ?>

		<?php
		endwhile;
		/* End of the loop */
		?>

	</div>

</div>
