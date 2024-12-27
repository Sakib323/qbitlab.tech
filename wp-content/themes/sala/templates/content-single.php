<?php
/**
 * The template for displaying all single posts.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */
?>
<div class="site-content">

	<div class="container">

		<div class="row">

			<?php Sala_Global::render_sidebar( 'left' ); ?>

			<div id="primary" class="content-area">

				<?php
				/* Start the loop */
				while ( have_posts() ) : the_post();

					get_template_part( 'templates/content', 'rich-snippet' );
						
					the_content();

				endwhile; 
				/* End of the loop */
				?>

			</div>
			
			<?php Sala_Global::render_sidebar( 'right' ); ?>

		</div>

	</div>

</div>
