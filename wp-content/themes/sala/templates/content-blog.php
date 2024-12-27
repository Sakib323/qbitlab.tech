<?php
if ( have_posts() ) :
	$blog_archive_post_layout     = Sala_Helper::setting('blog_archive_post_layout');
	$blog_archive_pagination_type = Sala_Helper::setting('blog_archive_pagination_type');
	$blog_desktop_column          = Sala_Helper::setting('blog_desktop_column');
	$blog_tablet_column           = Sala_Helper::setting('blog_tablet_column');
	$blog_mobile_column           = Sala_Helper::setting('blog_mobile_column');
	$blog_content_post_gutter     = Sala_Helper::setting('blog_content_post_gutter');

	if( $blog_archive_post_layout === 'default' || $blog_archive_post_layout === 'list' ) {
		$blog_desktop_column = $blog_tablet_column = $blog_mobile_column = 1;
	}


	$archive_class = [
		'sala-grid',
		'sala-blog',
		'sala-animate-zoom-in',
		'sala-blog-' . $blog_archive_post_layout,
		'grid-lg-' . $blog_desktop_column,
		'grid-md-' . $blog_tablet_column,
		'grid-sm-' . $blog_mobile_column
	];

	$grid_options = [
		'type'          => $blog_archive_post_layout,
		'columns'       => $blog_desktop_column,
		'columnsTablet' => $blog_tablet_column,
		'columnsMobile' => $blog_mobile_column,
		'gutter'        => intval($blog_content_post_gutter),
		'gutterTablet'  => 30,
	];

?>

	<div class="main-content">

		<?php echo Sala_Post::blog_categories(); ?>

		<?php echo Sala_Post::blog_action(); ?>

		<div class="sala-grid-wrapper sala-blog-wrapper" data-pagination="<?php echo esc_attr($blog_archive_pagination_type); ?>">

			<div <?php post_class( join(' ', $archive_class) ); ?>  data-grid="<?php echo esc_attr( wp_json_encode( $grid_options ) ); ?>">

				<div class="grid-sizer"></div>

				<?php
				/* Start the loop */
				while ( have_posts() ) : the_post();

					/*
					* Include the Post-Format-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Format name) and that will be used instead.
					*/
					get_template_part( 'templates/loop/blog/content', sala_get_setting('blog_archive_post_layout', 'grid') );

				endwhile;
				/* End of the loop */
				?>

			</div>

			<?php echo Sala_Templates::pagination(); ?>

		</div>

	</div>

<?php
else :

	get_template_part( 'templates/content', 'none' );

endif;
?>
