<div id="page-title" <?php Sala_Page_Title::instance()->the_wrapper_class(); ?>>
	<div class="page-title-inner">
		<div class="page-title-bg"></div>

		<div class="container">
			<div class="row row-xs-center">
				<div class="col-md-12">
					<?php Sala_Page_Title::instance()->render_title(); ?>
					<?php
						$excerpt = get_the_excerpt();
						if(has_excerpt() && $excerpt && !is_category() && !is_blog() && !is_post_type_archive('portfolio') && !is_tax()) :
							echo '<p class="excerpt">' . esc_html( $excerpt, 'sala' ) . '</p>';
						endif;
					?>
				</div>
			</div>
		</div>
	</div>
</div>
