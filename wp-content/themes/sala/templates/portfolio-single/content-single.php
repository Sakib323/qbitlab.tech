<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */
$single_portfolio_layout = Sala_Helper::setting('single_portfolio_layout', '01');

get_template_part( 'templates/portfolio-single/style', $single_portfolio_layout );
