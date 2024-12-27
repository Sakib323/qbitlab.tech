<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */
get_header();

if ( is_singular( 'post' ) ):

	get_template_part( 'templates/post-single/content-single' );

elseif ( is_singular( 'portfolio' ) ):

	get_template_part( 'templates/portfolio-single/content-single' );

else:

	get_template_part( 'templates/content', 'single' );

endif;

get_footer();
