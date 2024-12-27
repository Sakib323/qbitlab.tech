<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 */
get_header();

$image = Sala_Helper::setting( 'page404_image' );
$title = Sala_Helper::setting( 'page404_title' );
$text  = Sala_Helper::setting( 'page404_text' );
?>
	<div class="page-404-content">
		<div class="container">
			<div class="row row-404">
				<div class="col-lg-6">
					<?php if ( $title !== '' ): ?>
						<h2 class="error-404-title">
							<?php echo wp_kses( $title, 'sala' ); ?>
						</h2>
					<?php endif; ?>

					<?php if ( $text !== '' ): ?>
						<div class="error-404-text">
							<?php echo wp_kses($text, Sala_Helper::sala_kses_allowed_html()); ?>
						</div>
					<?php endif; ?>
				</div>

				<div class="col-lg-6">
					<?php if ( $image !== '' ): ?>
						<div class="error-image">
							<img src="<?php echo esc_url( $image ); ?>"
								alt="<?php esc_attr_e( 'Not Found Image', 'sala' ); ?>"/>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
<?php
get_footer();
