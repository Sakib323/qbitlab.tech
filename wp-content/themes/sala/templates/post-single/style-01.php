<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */

$single_post_boxed 				= Sala_Helper::setting('single_post_boxed');
$sidebar_position 				= Sala_Helper::setting( 'single_post_sidebar_position' );

if( $single_post_boxed === 'show' ){
	$ctn_class = 'container-boxed';
} else {
	$ctn_class = '';
}

if( $sidebar_position === 'none' ){
	$sb_class = 'no-sidebar';
} else {
	$sb_class = 'has-sidebar';
}

?>

<div class="site-content single-post-01 <?php echo esc_attr($sb_class); ?>">

	<div class="container <?php echo esc_attr($ctn_class); ?>">

		<div class="row">

			<?php Sala_Global::render_sidebar( 'left' ); ?>

			<div id="primary" class="content-area">

				<?php
				/* Start the loop */
				while ( have_posts() ) : the_post();
				?>
                    <div class="heading-post">
                        <?php get_template_part( 'templates/post-single/single', 'meta' ); ?>

                        <?php get_template_part( 'templates/post-single/single', 'title' ); ?>

						<?php get_template_part( 'templates/post-single/single', 'author' ); ?>
                    </div>

                    <?php get_template_part( 'templates/post-single/single', 'thumbnail' ); ?>

					<article <?php post_class('area-post'); ?>>

						<div class="inner-post-wrap">

							<div class="post-content">
								<?php
								the_content();
								wp_link_pages(array(
									'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'sala') . '</span>',
									'after'       => '</div>',
									'link_before' => '<span class="page-link">',
									'link_after'  => '</span>',
								));
								?>
							</div>

							<div class="post-bottom">
								<?php get_template_part( 'templates/post-single/single', 'tags' ); ?>

								<?php get_template_part( 'templates/post-single/single', 'social-share' ); ?>
							</div>

						</div>

						<?php get_template_part( 'templates/post-single/single', 'author-bio' ); ?>

						<?php get_template_part( 'templates/post-single/single', 'comments' ); ?>

						<?php get_template_part( 'templates/post-single/single', 'related' ); ?>

					</article>
				<?php
				endwhile;
				/* End of the loop */
				?>

			</div>

			<?php Sala_Global::render_sidebar( 'right' ); ?>

		</div>

	</div>

</div>
