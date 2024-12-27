<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */
get_header();
?>

<div class="site-content">

	<div class="container">

		<div class="row">

			<?php Sala_Global::render_sidebar( 'left' ); ?>

			<div id="primary" class="content-area">

				<?php
				if ( ! function_exists( 'elementor_location_exits' ) || ! elementor_location_exits( 'archive', true ) ) {

					if ( 'portfolio' === get_post_type() ) {

						get_template_part( 'templates/content', 'portfolio' );

					} else {

						get_template_part( 'templates/content', 'blog' );
						
					}

				} else {

					if ( function_exists( 'elementor_theme_do_location' ) ) :

						elementor_theme_do_location( 'archive' );

					endif;

				}
				?>

			</div>

			<?php Sala_Global::render_sidebar( 'right' ); ?>

		</div>

	</div>

</div>

<?php
get_footer();
