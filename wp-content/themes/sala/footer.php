<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sala
 * @since   1.0.0
 */

$footer_enable = Sala_Helper::get_post_meta( 'footer_enable', 'yes' );

?>

	<?php do_action( 'sala_before_footer' ); ?>

	<?php if( $footer_enable != 'none' ) : ?>

	<footer id="footer" class="site-footer">
		<?php
		$footer_type = Sala_Global::get_footer_type();
		if ( ! function_exists( 'elementor_location_exits' ) || ! elementor_location_exits( 'footer', true ) ) {

			if( $footer_type !== '0' && !empty($footer_type) ) {
				if( defined( 'ELEMENTOR_VERSION' ) && \Elementor\Plugin::$instance->db->is_built_with_elementor($footer_type) ) {
					echo \Elementor\Plugin::$instance->frontend->get_builder_content( $footer_type );
				}else{
					$footer = get_post($footer_type);
					$footer_content = $footer->post_content;
					echo wp_kses_post($footer_content);
				}
			}

			$footer_copyright_enable = Sala_Helper::setting('footer_copyright_enable');
			if( $footer_copyright_enable == '1' ) {
				get_template_part( 'templates/footer/copyright' );
			}

		} else {

			if ( function_exists( 'elementor_theme_do_location' ) ) :

				elementor_theme_do_location( 'footer' );

			endif;
		}
		?>
	</footer>

	<?php endif; ?>

	<?php do_action( 'sala_after_footer' ); ?>

</div><!-- End #wrapper -->



<?php wp_footer(); ?>

</body>
</html>
