<?php
if ( have_posts() ) :
	$portfolio_archive_post_layout     = Sala_Helper::setting('portfolio_archive_post_layout');
	$portfolio_archive_pagination_type = Sala_Helper::setting('portfolio_archive_pagination_type');
	$portfolio_desktop_column          = Sala_Helper::setting('portfolio_desktop_column');
	$portfolio_tablet_column           = Sala_Helper::setting('portfolio_tablet_column');
	$portfolio_mobile_column           = Sala_Helper::setting('portfolio_mobile_column');
	$portfolio_content_post_gutter     = Sala_Helper::setting('portfolio_content_post_gutter');
	$portfolio_content_minimal_style   = Sala_Helper::setting('portfolio_content_minimal_style');
	$portfolio_content_modern_style    = Sala_Helper::setting('portfolio_content_modern_style');

	$sala_minimal = $sala_modern = '';

	$sala_grid = 'sala-grid';

	if( $portfolio_content_minimal_style === 'show' ){
		$sala_minimal = 'sala-minimal';
	}

	if( $portfolio_content_modern_style === 'show' ){
		$sala_modern = 'sala-modern';
	}

	$archive_class = [
		$sala_grid,
		'sala-portfolio',
		'sala-animate-zoom-in',
		$sala_minimal,
		$sala_modern,
		'sala-portfolio-' . $portfolio_archive_post_layout,
		'grid-lg-' . $portfolio_desktop_column,
		'grid-md-' . $portfolio_tablet_column,
		'grid-sm-' . $portfolio_mobile_column
	];

	$grid_options = [
		'type'          => $portfolio_archive_post_layout,
		'columns'       => $portfolio_desktop_column,
		'columnsTablet' => $portfolio_tablet_column,
		'columnsMobile' => $portfolio_mobile_column,
		'gutter'        => intval($portfolio_content_post_gutter),
		'gutterTablet'  => 30,
	];
?>

	<div class="main-content">

		<?php echo Sala_Portfolio::portfolio_taxonomy(); ?>

		<div class="sala-grid-wrapper" data-pagination="<?php echo esc_attr($portfolio_archive_pagination_type); ?>">

			<div class="<?php echo join(' ', $archive_class); ?>"  data-grid="<?php echo esc_attr( wp_json_encode( $grid_options ) ); ?>">

				<div class="grid-sizer"></div>

				<?php
				/* Start the loop */
				while ( have_posts() ) : the_post();

					/*
					* Include the Post-Format-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Format name) and that will be used instead.
					*/
					get_template_part( 'templates/loop/portfolio/content', sala_get_setting('portfolio_archive_post_layout', 'grid') );

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
