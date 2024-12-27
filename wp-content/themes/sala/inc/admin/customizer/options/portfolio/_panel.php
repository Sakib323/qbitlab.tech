<?php

$panel    = 'portfolio';
$priority = 1;

// Portfolio Panel
Sala_Kirki::add_panel( $panel, array(
	'title'    => esc_html__( 'Portfolio', 'sala' ),
	'priority' => $priority++,
) );