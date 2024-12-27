<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */
$single_post_layout = Sala_Helper::setting('single_post_layout', '01');

get_template_part( 'templates/post-single/style', $single_post_layout );
