<!DOCTYPE html>
<!--[if lte IE 9 ]><html class="ie lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>
</head>

<body>
	<div id="wrapper">
		<main id="main">
			<?php
			if ( get_theme_mod( 'maintenance_mode_page' ) ) {
				$post = get_post( get_theme_mod( 'maintenance_mode_page' ) );
				echo do_shortcode( $post->post_content );
			} else {
				$logo_url = Sala_Helper::setting( 'logo_dark' );
				$text     = get_theme_mod( 'maintenance_mode_text' );
				?>
					<div class="maintenance">
						<img src="<?php echo esc_url($logo_url); ?>" alt="<?php esc_attr_e('Maintenance', 'sala'); ?>">
						<p><?php echo esc_html($text); ?></p>
					</div>
				<?php
			}
			?>
		</main>
	</div>
</body>

<?php wp_footer(); ?>
</html>
