<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section
 *
 * @link     https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package  Sala
 * @since    1.0.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php echo esc_attr( get_bloginfo( 'charset', 'display' ) ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class() ?>>

<?php do_action( 'sala_after_body_open' ); ?>

<?php wp_body_open(); ?>

	<div id="wrapper">

		<?php do_action( 'sala_before_header' ); ?>

		<?php get_template_part( 'templates/topbar/topbar' ); ?>

		<?php get_template_part( 'templates/header/header' ); ?>

		<?php do_action( 'sala_after_header' ); ?>
