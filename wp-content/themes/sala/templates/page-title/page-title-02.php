<div id="page-title" <?php Sala_Page_Title::instance()->the_wrapper_class(); ?>>
	<div class="page-title-inner">
		<div class="page-title-bg"></div>
		<div class="container">
			<div class="row row-xs-center">
				<div class="col-md-12">
					<?php Sala_Page_Title::instance()->render_title(); ?>
				</div>
			</div>
		</div>
		<?php get_template_part( 'templates/global/breadcrumb' ); ?>
	</div>
</div>
