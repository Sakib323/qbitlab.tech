<?php

$panel    = 'blog';
$priority = 1;

// Blog Panel
Sala_Kirki::add_panel( $panel, array(
	'title'    => esc_html__( 'Blog', 'sala' ),
	'priority' => $priority++,
) );