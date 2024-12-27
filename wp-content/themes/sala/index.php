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

				<?php get_template_part( 'templates/content', 'blog' ); ?>

			</div>

			<?php Sala_Global::render_sidebar( 'right' ); ?>

		</div>

	</div>
	
</div>

<?php
get_footer();
