<?php

$panel    = 'general';
$priority = 1;

// General
Sala_Kirki::add_panel( $panel, array(
	'title'    => esc_html__( 'General', 'sala' ),
	'priority' => $priority++,
) );